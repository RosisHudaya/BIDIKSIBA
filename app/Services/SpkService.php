<?php

namespace App\Services;

use App\Models\Bobot;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SpkService
{
    public function getValues()
    {
        $datas = DB::table('biodata_spks')
            ->leftJoin('users', 'biodata_spks.user_id', '=', 'users.id')
            ->leftJoin('biodatas', 'users.id', '=', 'biodatas.id_user')
            ->leftJoin('pekerjaan_ortus', 'biodata_spks.pekerjaan_ortu_id', '=', 'pekerjaan_ortus.id')
            ->leftJoin('gaji_ortus', 'biodata_spks.gaji_ortu_id', '=', 'gaji_ortus.id')
            ->leftJoin('luas_tanahs', 'biodata_spks.luas_tanah_id', '=', 'luas_tanahs.id')
            ->leftJoin('jumlah_kamars', 'biodata_spks.kamar_id', '=', 'jumlah_kamars.id')
            ->leftJoin('kamar_mandis', 'biodata_spks.kamar_mandi_id', '=', 'kamar_mandis.id')
            ->leftJoin('tagihan_listriks', 'biodata_spks.tagihan_listrik_id', '=', 'tagihan_listriks.id')
            ->leftJoin('pajaks', 'biodata_spks.pajak_id', '=', 'pajaks.id')
            ->leftJoin('hutangs', 'biodata_spks.hutang_id', '=', 'hutangs.id')
            ->leftJoin('saudaras', 'biodata_spks.saudara_id', '=', 'saudaras.id')
            ->leftJoin('status_ortus', 'biodata_spks.status_ortu_id', '=', 'status_ortus.id')
            ->select(
                'biodata_spks.id',
                'pekerjaan_ortus.nilai as pekerjaan_ortu',
                'gaji_ortus.nilai as penghasilan_ortu',
                'luas_tanahs.nilai as luas_tanah',
                'jumlah_kamars.nilai as kamar',
                'kamar_mandis.nilai as kamar_mandi',
                'tagihan_listriks.nilai as tagihan_listrik',
                'pajaks.nilai as pajak',
                'hutangs.nilai as hutang',
                'saudaras.nilai as saudara',
                'status_ortus.nilai as status_ortu'
            )
            ->where('biodatas.status', 'Diverifikasi')
            ->get();

        $dataValues = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'spk' => [
                    'Pekerjaan Orang Tua' => $data->pekerjaan_ortu,
                    'Penghasilan Orang Tua' => $data->penghasilan_ortu,
                    'Luas Tanah' => $data->luas_tanah,
                    'Jumlah Kamar' => $data->kamar,
                    'Kepemilikan Kamar Mandi' => $data->kamar_mandi,
                    'Tagihan Listrik' => $data->tagihan_listrik,
                    'Pajak Bumi dan Bangunan' => $data->pajak,
                    'Jumlah Hutang' => $data->hutang,
                    'Jumlah Saudara' => $data->saudara,
                    'Status Orang Tua' => $data->status_ortu,
                ]
            ];
        });

        return $dataValues;
    }

    public function getWights()
    {
        $bobots = Bobot::all()->pluck('bobot', 'kriteria')->toArray();

        return $bobots;
    }

    public function getNormalizedValues()
    {
        $dataValues = $this->getValues();

        $sumOfSquares = $dataValues->reduce(function ($carry, $item) {
            foreach ($item['spk'] as $key => $value) {
                if (!is_numeric($value)) {
                    throw new \Exception("Nilai non-numerik ditemui untuk data {$key}: {$value}");
                }
                $carry[$key] = ($carry[$key] ?? 0) + pow($value, 2);
            }
            return $carry;
        }, []);

        $eculideanLength = collect($sumOfSquares)->map(function ($value, $key) {
            return sqrt($value);
        })->all();

        $normalizedValues = $dataValues->map(function ($item) use ($eculideanLength) {
            $normalizedSpk = collect($item['spk'])->map(function ($value, $key) use ($eculideanLength) {
                if ($eculideanLength[$key] == 0) {
                    throw new \Exception("Pembagian dengan nol ditemukan untuk data {$key}");
                }
                return $value / $eculideanLength[$key];
            })->all();

            $item['spk'] = $normalizedSpk;

            return $item;
        });

        return $normalizedValues;
    }

    public function getOptimizedValues()
    {
        $normalizedValues = $this->getNormalizedValues();
        $bobots = $this->getWights();

        $optimizedValues = $normalizedValues->map(function ($item) use ($bobots) {
            $optimizedSpk = collect($item['spk'])->map(function ($value, $key) use ($bobots, $item) {
                if (!isset ($bobots[$key])) {
                    throw new \Exception("Tidak ditemukan bobot untuk data {$key}");
                }
                return $value * $bobots[$key];
            })->all();
            $item['spk'] = $optimizedSpk;

            return $item;
        });
        return $optimizedValues;
    }

    public function getRankedAlternative()
    {
        $optimizedValues = $this->getOptimizedValues();

        $rankedAlternatives = collect($optimizedValues)->map(function ($item) {
            $max = collect($item['spk'])
                ->only(['Pajak Bumi dan Bangunan', 'Jumlah Hutang', 'Jumlah Saudara'])
                ->sum();

            $min = collect($item['spk'])
                ->except(['Pajak Bumi dan Bangunan', 'Jumlah Hutang', 'Jumlah Saudara'])
                ->sum();

            $difference = $min - $max;

            $item['max_y'] = $max;
            $item['min_y'] = $min;
            $item['difference'] = $difference;

            return $item;
        });

        $sortedAlternatives = $rankedAlternatives->sortByDesc('difference')->values();

        $rank = 1;
        $rankedAlternatives = $sortedAlternatives->map(function ($item) use (&$rank) {
            $item['rank'] = $rank++;

            return $item;
        });

        return $rankedAlternatives;
    }
}