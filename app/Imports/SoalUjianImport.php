<?php

namespace App\Imports;

use App\Models\SoalUjian;
use App\Models\Ujian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Throwable;

class SoalUjianImport implements ToModel, WithHeadingRow, WithUpserts, SkipsOnError
{
    use Importable, SkipsErrors;

    public function model(array $row)
    {
        if (isset($row['nama_ujian']) && isset($row['soal']) && isset($row['jawaban_a']) && isset($row['jawaban_b']) && isset($row['jawaban_c']) && isset($row['jawaban_d']) && isset($row['jawaban_benar'])) {
            $ujian = Ujian::where('nama_ujian', $row['nama_ujian'])->first();
            if (!$ujian) {
                throw new \Exception("Ujian " . $row['nama_ujian'] . " tidak ditemukan di database");
            }
            $id_ujian = $ujian->id;

            return new SoalUjian([
                'id_ujian' => $id_ujian,
                'soal' => $row['soal'],
                'jawaban_a' => $row['jawaban_a'],
                'jawaban_b' => $row['jawaban_b'],
                'jawaban_c' => $row['jawaban_c'],
                'jawaban_d' => $row['jawaban_d'],
                'jawaban_benar' => $row['jawaban_benar'],
            ]);
        }
    }

    public function uniqueBy()
    {

    }
}