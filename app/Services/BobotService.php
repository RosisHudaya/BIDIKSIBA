<?php

namespace App\Services;

use App\Models\Bobot;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class BobotService
{
    public function getValues()
    {
        $datas = DB::table('bobot_pekerjaans')
            ->leftJoin('bobot_penghasilans', 'bobot_pekerjaans.id', '=', 'bobot_penghasilans.fk')
            ->leftJoin('bobot_tanahs', 'bobot_pekerjaans.id', '=', 'bobot_tanahs.fk')
            ->leftJoin('bobot_kamars', 'bobot_pekerjaans.id', '=', 'bobot_kamars.fk')
            ->leftJoin('bobot_kamar_mandis', 'bobot_pekerjaans.id', '=', 'bobot_kamar_mandis.fk')
            ->leftJoin('bobot_listriks', 'bobot_pekerjaans.id', '=', 'bobot_listriks.fk')
            ->leftJoin('bobot_pajaks', 'bobot_pekerjaans.id', '=', 'bobot_pajaks.fk')
            ->leftJoin('bobot_hutangs', 'bobot_pekerjaans.id', '=', 'bobot_hutangs.fk')
            ->leftJoin('bobot_saudaras', 'bobot_pekerjaans.id', '=', 'bobot_saudaras.fk')
            ->leftJoin('bobot_status_ortuses', 'bobot_pekerjaans.id', '=', 'bobot_status_ortuses.fk')
            ->select(
                'bobot_pekerjaans.pekerjaan_ortu as pekerjaan_c1',
                'bobot_pekerjaans.to_c2 as pekerjaan_c2',
                'bobot_pekerjaans.to_c5 as pekerjaan_c5',
                'bobot_pekerjaans.to_c6 as pekerjaan_c6',
                'bobot_pekerjaans.to_c8 as pekerjaan_c8',
                'bobot_pekerjaans.to_c9 as pekerjaan_c9',
                'bobot_pekerjaans.to_c10 as pekerjaan_c10',
                'bobot_penghasilans.penghasilan_ortu as penghasilan_c2',
                'bobot_penghasilans.to_c1 as penghasilan_c1',
                'bobot_penghasilans.to_c5 as penghasilan_c5',
                'bobot_penghasilans.to_c6 as penghasilan_c6',
                'bobot_penghasilans.to_c8 as penghasilan_c8',
                'bobot_penghasilans.to_c9 as penghasilan_c9',
                'bobot_penghasilans.to_c10 as penghasilan_c10',
                'bobot_tanahs.luas_tanah as tanah_c3',
                'bobot_tanahs.to_c4 as tanah_c4',
                'bobot_tanahs.to_c7 as tanah_c7',
                'bobot_kamars.jumlah_kamar as kamar_c4',
                'bobot_kamars.to_c3 as kamar_c3',
                'bobot_kamars.to_c7 as kamar_c7',
                'bobot_kamar_mandis.kamar_mandi as mandi_c5',
                'bobot_kamar_mandis.to_c1 as mandi_c1',
                'bobot_kamar_mandis.to_c2 as mandi_c2',
                'bobot_kamar_mandis.to_c6 as mandi_c6',
                'bobot_kamar_mandis.to_c8 as mandi_c8',
                'bobot_kamar_mandis.to_c9 as mandi_c9',
                'bobot_kamar_mandis.to_c10 as mandi_c10',
                'bobot_listriks.tagihan_listrik as listrik_c6',
                'bobot_listriks.to_c1 as listrik_c1',
                'bobot_listriks.to_c2 as listrik_c2',
                'bobot_listriks.to_c5 as listrik_c5',
                'bobot_listriks.to_c8 as listrik_c8',
                'bobot_listriks.to_c9 as listrik_c9',
                'bobot_listriks.to_c10 as listrik_c10',
                'bobot_pajaks.pajak as pajak_c7',
                'bobot_pajaks.to_c3 as pajak_c3',
                'bobot_pajaks.to_c4 as pajak_c4',
                'bobot_hutangs.hutang as hutang_c8',
                'bobot_hutangs.to_c1 as hutang_c1',
                'bobot_hutangs.to_c2 as hutang_c2',
                'bobot_hutangs.to_c5 as hutang_c5',
                'bobot_hutangs.to_c6 as hutang_c6',
                'bobot_hutangs.to_c9 as hutang_c9',
                'bobot_hutangs.to_c10 as hutang_c10',
                'bobot_saudaras.saudara as saudara_c9',
                'bobot_saudaras.to_c1 as saudara_c1',
                'bobot_saudaras.to_c2 as saudara_c2',
                'bobot_saudaras.to_c5 as saudara_c5',
                'bobot_saudaras.to_c6 as saudara_c6',
                'bobot_saudaras.to_c8 as saudara_c8',
                'bobot_saudaras.to_c10 as saudara_c10',
                'bobot_status_ortuses.status_ortu as ortus_c10',
                'bobot_status_ortuses.to_c1 as ortus_c1',
                'bobot_status_ortuses.to_c2 as ortus_c2',
                'bobot_status_ortuses.to_c5 as ortus_c5',
                'bobot_status_ortuses.to_c6 as ortus_c6',
                'bobot_status_ortuses.to_c8 as ortus_c8',
                'bobot_status_ortuses.to_c9 as ortus_c9',
            )
            ->get();

        $dataValues = $datas->map(function ($data) {
            return [
                'bobot_pekerjaan' => [
                    'kriteria 1' => $data->pekerjaan_c1,
                    'kriteria 2' => $data->pekerjaan_c2,
                    'kriteria 5' => $data->pekerjaan_c5,
                    'kriteria 6' => $data->pekerjaan_c6,
                    'kriteria 8' => $data->pekerjaan_c8,
                    'kriteria 9' => $data->pekerjaan_c9,
                    'kriteria 10' => $data->pekerjaan_c10,
                ],
                'bobot_penghasilan' => [
                    'kriteria 1' => $data->penghasilan_c1,
                    'kriteria 2' => $data->penghasilan_c2,
                    'kriteria 5' => $data->penghasilan_c5,
                    'kriteria 6' => $data->penghasilan_c6,
                    'kriteria 8' => $data->penghasilan_c8,
                    'kriteria 9' => $data->penghasilan_c9,
                    'kriteria 10' => $data->penghasilan_c10,
                ],
                'bobot_tanah' => [
                    'kriteria 3' => $data->tanah_c3,
                    'kriteria 4' => $data->tanah_c4,
                    'kriteria 7' => $data->tanah_c7,
                ],
                'bobot_jumlah_kamar' => [
                    'kriteria 3' => $data->kamar_c3,
                    'kriteria 4' => $data->kamar_c4,
                    'kriteria 7' => $data->kamar_c7,
                ],
                'bobot_kamar_mandi' => [
                    'kriteria 1' => $data->mandi_c1,
                    'kriteria 2' => $data->mandi_c2,
                    'kriteria 5' => $data->mandi_c5,
                    'kriteria 6' => $data->mandi_c6,
                    'kriteria 8' => $data->mandi_c8,
                    'kriteria 9' => $data->mandi_c9,
                    'kriteria 10' => $data->mandi_c10,
                ],
                'bobot_tagihan_listrik' => [
                    'kriteria 1' => $data->listrik_c1,
                    'kriteria 2' => $data->listrik_c2,
                    'kriteria 5' => $data->listrik_c5,
                    'kriteria 6' => $data->listrik_c6,
                    'kriteria 8' => $data->listrik_c8,
                    'kriteria 9' => $data->listrik_c9,
                    'kriteria 10' => $data->listrik_c10,
                ],
                'bobot_pajak' => [
                    'kriteria 3' => $data->pajak_c3,
                    'kriteria 4' => $data->pajak_c4,
                    'kriteria 7' => $data->pajak_c7,
                ],
                'bobot_hutang' => [
                    'kriteria 1' => $data->hutang_c1,
                    'kriteria 2' => $data->hutang_c2,
                    'kriteria 5' => $data->hutang_c5,
                    'kriteria 6' => $data->hutang_c6,
                    'kriteria 8' => $data->hutang_c8,
                    'kriteria 9' => $data->hutang_c9,
                    'kriteria 10' => $data->hutang_c10,
                ],
                'bobot_saudara' => [
                    'kriteria 1' => $data->saudara_c1,
                    'kriteria 2' => $data->saudara_c2,
                    'kriteria 5' => $data->saudara_c5,
                    'kriteria 6' => $data->saudara_c6,
                    'kriteria 8' => $data->saudara_c8,
                    'kriteria 9' => $data->saudara_c9,
                    'kriteria 10' => $data->saudara_c10,
                ],
                'bobot_status_ortus' => [
                    'kriteria 1' => $data->ortus_c1,
                    'kriteria 2' => $data->ortus_c2,
                    'kriteria 5' => $data->ortus_c5,
                    'kriteria 6' => $data->ortus_c6,
                    'kriteria 8' => $data->ortus_c8,
                    'kriteria 9' => $data->ortus_c9,
                    'kriteria 10' => $data->ortus_c10,
                ],
            ];
        });

        return $dataValues;
    }

    public function sumOfEachCriteria()
    {
        $dataValues = $this->getValues();

        // Inisialisasi array untuk menyimpan jumlah setiap kriteria
        $sums = [
            'kelompok1' => [
                3 => 0,
                4 => 0,
                7 => 0,
            ],
            'kelompok2' => [
                1 => 0,
                2 => 0,
                5 => 0,
                6 => 0,
                8 => 0,
                9 => 0,
                10 => 0,
            ]
        ];

        // Loop melalui setiap data
        foreach ($dataValues as $data) {
            foreach ($data as $key => $values) {
                foreach ($values as $kriteriaKey => $value) {
                    $kriteriaNumber = (int) filter_var($kriteriaKey, FILTER_SANITIZE_NUMBER_INT);
                    if (isset($sums['kelompok1'][$kriteriaNumber])) {
                        $sums['kelompok1'][$kriteriaNumber] += $value;
                    } elseif (isset($sums['kelompok2'][$kriteriaNumber])) {
                        $sums['kelompok2'][$kriteriaNumber] += $value;
                    }
                }
            }
        }

        return $sums;
    }

    public function getNormalizedValues()
    {
        $dataValues = $this->getValues();
        $sumValues = $this->sumOfEachCriteria();

        $normalizedValues = $dataValues->map(function ($data) use ($sumValues) {
            $normalizedData = [];

            foreach ($data as $key => $values) {
                foreach ($values as $kriteriaKey => $value) {
                    $kriteriaNumber = (int) filter_var($kriteriaKey, FILTER_SANITIZE_NUMBER_INT);
                    if (isset ($sumValues['kelompok1'][$kriteriaNumber])) {
                        $normalizedData[$key][$kriteriaKey] = $value / $sumValues['kelompok1'][$kriteriaNumber];
                    } elseif (isset ($sumValues['kelompok2'][$kriteriaNumber])) {
                        $normalizedData[$key][$kriteriaKey] = $value / $sumValues['kelompok2'][$kriteriaNumber];
                    }
                }
            }
            return $normalizedData;
        });

        return $normalizedValues;
    }

    public function getWeightValues()
    {
        $normalizedValues = $this->getNormalizedValues();

        $totals = [
            'bobot_pekerjaan' => 0,
            'bobot_penghasilan' => 0,
            'bobot_tanah' => 0,
            'bobot_jumlah_kamar' => 0,
            'bobot_kamar_mandi' => 0,
            'bobot_tagihan_listrik' => 0,
            'bobot_pajak' => 0,
            'bobot_hutang' => 0,
            'bobot_saudara' => 0,
            'bobot_status_ortus' => 0,
        ];

        $counts = [
            'bobot_pekerjaan' => 0,
            'bobot_penghasilan' => 0,
            'bobot_tanah' => 0,
            'bobot_jumlah_kamar' => 0,
            'bobot_kamar_mandi' => 0,
            'bobot_tagihan_listrik' => 0,
            'bobot_pajak' => 0,
            'bobot_hutang' => 0,
            'bobot_saudara' => 0,
            'bobot_status_ortus' => 0,
        ];

        foreach ($normalizedValues as $data) {
            foreach ($data as $key => $values) {
                foreach ($values as $value) {
                    $totals[$key] += $value;
                    $counts[$key]++;
                }
            }
        }

        $averages = [];

        foreach ($totals as $key => $total) {
            $averages[$key] = $counts[$key] != 0 ? $total / $counts[$key] : 0;
        }

        $kriteriaMap = [
            'bobot_pekerjaan' => 'Pekerjaan Orang Tua',
            'bobot_penghasilan' => 'Penghasilan Orang Tua',
            'bobot_tanah' => 'Luas Tanah',
            'bobot_jumlah_kamar' => 'Jumlah Kamar',
            'bobot_kamar_mandi' => 'Kepemilikan Kamar Mandi',
            'bobot_tagihan_listrik' => 'Tagihan Listrik',
            'bobot_pajak' => 'Pajak Bumi dan Bangunan',
            'bobot_hutang' => 'Jumlah Hutang',
            'bobot_saudara' => 'Jumlah Saudara',
            'bobot_status_ortus' => 'Status Orang Tua',
        ];

        foreach ($averages as $key => $average) {
            if (in_array($key, ['bobot_tanah', 'bobot_jumlah_kamar', 'bobot_pajak'])) {
                $averages[$key] = $average * 0.3;
            } else {
                $averages[$key] = $average * 0.7;
            }
        }

        foreach ($averages as $key => $average) {
            Bobot::where('kriteria', $kriteriaMap[$key])->update(['bobot' => $average]);
        }

        return $averages;
    }
}
