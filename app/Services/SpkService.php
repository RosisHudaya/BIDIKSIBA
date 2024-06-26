<?php

namespace App\Services;

use App\Models\Bobot;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class SpkService
{
    public function getValues(Request $request)
    {
        $datas = DB::table('biodata_spks')
            ->leftJoin('users', 'biodata_spks.user_id', '=', 'users.id')
            ->leftJoin('biodatas', 'users.id', '=', 'biodatas.id_user')
            ->leftJoin('nilai_ujians', 'users.id', '=', 'nilai_ujians.id_user')
            ->leftJoin('pekerjaan_ortus', 'biodata_spks.pekerjaan_ortu_id', '=', 'pekerjaan_ortus.id')
            ->leftJoin('gaji_ortus', 'biodata_spks.gaji_ortu_id', '=', 'gaji_ortus.id')
            ->leftJoin('kamar_mandis', 'biodata_spks.kamar_mandi_id', '=', 'kamar_mandis.id')
            ->leftJoin('tagihan_listriks', 'biodata_spks.tagihan_listrik_id', '=', 'tagihan_listriks.id')
            ->leftJoin('hutangs', 'biodata_spks.hutang_id', '=', 'hutangs.id')
            ->leftJoin('saudaras', 'biodata_spks.saudara_id', '=', 'saudaras.id')
            ->leftJoin('status_ortus', 'biodata_spks.status_ortu_id', '=', 'status_ortus.id')
            ->select(
                'biodata_spks.id',
                'nilai_ujians.nilai as nilai',
                'pekerjaan_ortus.nilai as pekerjaan_ortu',
                'gaji_ortus.nilai as penghasilan_ortu',
                'biodata_spks.luas_tanah as luas_tanah',
                'biodata_spks.kamar as kamar',
                'kamar_mandis.nilai as kamar_mandi',
                'tagihan_listriks.nilai as tagihan_listrik',
                'biodata_spks.pajak as pajak',
                'hutangs.nilai as hutang',
                'saudaras.nilai as saudara',
                'status_ortus.nilai as status_ortu',
                'biodatas.nama as nama',
                'biodatas.asal_sekolah as sekolah',
                'pekerjaan_ortus.pekerjaan_ortu as det_pekerjaan_ortu',
                'gaji_ortus.gaji_ortu as det_gaji_ortu',
                'kamar_mandis.kamar_mandi as det_kamar_mandi',
                'tagihan_listriks.tagihan_listrik as det_tagihan_listrik',
                'biodata_spks.det_hutang as det_hutang',
                'saudaras.saudara as det_saudara',
                'status_ortus.status_ortu as det_status_ortu',
            )
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('biodatas.nama', 'like', '%' . $name . '%');
            })
            ->where('biodatas.status', 'Diverifikasi')
            ->get();

        $dataValues = $datas->map(function ($data) {
            return [
                'id' => $data->id,
                'nilai' => $data->nilai,
                'nama' => $data->nama,
                'sekolah' => $data->sekolah,
                'pekerjaan_ortu' => $data->det_pekerjaan_ortu,
                'gaji_ortu' => $data->det_gaji_ortu,
                'luas_tanah' => $data->luas_tanah,
                'kamar' => $data->kamar,
                'kamar_mandi' => $data->det_kamar_mandi,
                'tagihan_listrik' => $data->det_tagihan_listrik,
                'pajak' => $data->pajak,
                'hutang' => $data->det_hutang,
                'saudara' => $data->det_saudara,
                'status_ortu' => $data->det_status_ortu,
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

    public function getNormalizedValues(Request $request)
    {
        $dataValues = $this->getValues($request);

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

    public function getOptimizedValues(Request $request)
    {
        $normalizedValues = $this->getNormalizedValues($request);
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

    public function getRankedAlternativeSpk(Request $request)
    {
        $optimizedValues = $this->getOptimizedValues($request);

        $rankedAlternatives = collect($optimizedValues)->map(function ($item) {
            $min = collect($item['spk'])
                ->only(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $max = collect($item['spk'])
                ->except(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $difference = $max - $min;

            $item['max_y'] = $max;
            $item['min_y'] = $min;
            $item['difference'] = $difference;

            return $item;
        });

        $sortedAlternatives = $rankedAlternatives->filter(function ($item) {
            return $item['nilai'] >= 0;
        })->sortByDesc('difference')->sortByDesc('nilai')->values();

        $rank = 1;
        $rankedAlternatives = $sortedAlternatives->map(function ($item) use (&$rank) {
            $item['rank'] = $rank++;

            return $item;
        });

        $rankedAlternatives = $rankedAlternatives->map(function ($item) {
            return [
                'id' => $item['id'],
                'nilai' => $item['nilai'],
                'nama' => $item['nama'],
                'sekolah' => $item['sekolah'],
                'pekerjaan_ortu' => $item['pekerjaan_ortu'],
                'gaji_ortu' => $item['gaji_ortu'],
                'luas_tanah' => $item['luas_tanah'],
                'kamar' => $item['kamar'],
                'kamar_mandi' => $item['kamar_mandi'],
                'tagihan_listrik' => $item['tagihan_listrik'],
                'pajak' => $item['pajak'],
                'hutang' => $item['hutang'],
                'saudara' => $item['saudara'],
                'status_ortu' => $item['status_ortu'],
                'difference' => $item['difference'],
                'rank' => $item['rank'],
            ];
        });

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 25;
        $currentPageItems = $rankedAlternatives->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rankedAlternatives = new LengthAwarePaginator($currentPageItems, count($rankedAlternatives), $perPage);
        $rankedAlternatives->withPath('data-spk');

        return $rankedAlternatives;
    }

    public function getRankedAlternative(Request $request)
    {
        $optimizedValues = $this->getOptimizedValues($request);

        $rankedAlternatives = collect($optimizedValues)->map(function ($item) {
            $min = collect($item['spk'])
                ->only(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $max = collect($item['spk'])
                ->except(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $difference = $max - $min;

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

        $rankedAlternatives = $rankedAlternatives->map(function ($item) {
            return [
                'id' => $item['id'],
                'nilai' => $item['nilai'],
                'nama' => $item['nama'],
                'sekolah' => $item['sekolah'],
                'pekerjaan_ortu' => $item['pekerjaan_ortu'],
                'gaji_ortu' => $item['gaji_ortu'],
                'luas_tanah' => $item['luas_tanah'],
                'kamar' => $item['kamar'],
                'kamar_mandi' => $item['kamar_mandi'],
                'tagihan_listrik' => $item['tagihan_listrik'],
                'pajak' => $item['pajak'],
                'hutang' => $item['hutang'],
                'saudara' => $item['saudara'],
                'status_ortu' => $item['status_ortu'],
                'difference' => $item['difference'],
                'rank' => $item['rank'],
            ];
        });

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 25;
        $currentPageItems = $rankedAlternatives->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $rankedAlternatives = new LengthAwarePaginator($currentPageItems, count($rankedAlternatives), $perPage);
        $rankedAlternatives->withPath('data-spk');

        return $rankedAlternatives;
    }

    public function getRankedAlternativeExport(Request $request)
    {
        $optimizedValues = $this->getOptimizedValues($request);

        $rankedAlternatives = collect($optimizedValues)->map(function ($item) {
            $min = collect($item['spk'])
                ->only(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $max = collect($item['spk'])
                ->except(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $difference = $max - $min;

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

        $rankedAlternatives = $rankedAlternatives->map(function ($item) {
            return [
                'rank' => $item['rank'],
                'nama' => $item['nama'],
                'sekolah' => $item['sekolah'],
                'pekerjaan_ortu' => $item['pekerjaan_ortu'],
                'gaji_ortu' => $item['gaji_ortu'],
                'luas_tanah' => $item['luas_tanah'],
                'kamar' => $item['kamar'],
                'kamar_mandi' => $item['kamar_mandi'],
                'tagihan_listrik' => $item['tagihan_listrik'],
                'pajak' => $item['pajak'],
                'hutang' => $item['hutang'],
                'saudara' => $item['saudara'],
                'status_ortu' => $item['status_ortu'],
                'difference' => $item['difference'],
            ];
        });

        return $rankedAlternatives;
    }

    public function getRankedAlternativeSpkExport(Request $request)
    {
        $optimizedValues = $this->getOptimizedValues($request);

        $rankedAlternatives = collect($optimizedValues)->map(function ($item) {
            $min = collect($item['spk'])
                ->only(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $max = collect($item['spk'])
                ->except(['Luas Tanah', 'Jumlah Kamar', 'Pajak Bumi dan Bangunan'])
                ->sum();

            $difference = $max - $min;

            $item['max_y'] = $max;
            $item['min_y'] = $min;
            $item['difference'] = $difference;

            return $item;
        });

        $sortedAlternatives = $rankedAlternatives->filter(function ($item) {
            return $item['nilai'] >= 100;
        })->sortByDesc('difference')->sortByDesc('nilai')->values();

        $rank = 1;
        $rankedAlternatives = $sortedAlternatives->map(function ($item) use (&$rank) {
            $item['rank'] = $rank++;

            return $item;
        });

        $rankedAlternatives = $rankedAlternatives->map(function ($item) {
            return [
                'rank' => $item['rank'],
                'nama' => $item['nama'],
                'sekolah' => $item['sekolah'],
                'nilai' => $item['nilai'],
                'difference' => $item['difference'],
            ];
        });

        return $rankedAlternatives;
    }
}