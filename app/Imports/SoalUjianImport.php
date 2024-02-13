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
        if (isset($row['Nama Ujian']) && isset($row['Soal']) && isset($row['Jawaban A']) && isset($row['Jawaban B']) && isset($row['Jawaban C']) && isset($row['Jawaban D']) && isset($row['Jawaban Benar'])) {
            $ujian = Ujian::where('nama_ujian', $row['Nama Ujian'])->first();
            if (!$ujian) {
                throw new \Exception("Ujian " . $row['Nama Ujian'] . " tidak ditemukan di database");
            }
            $id_ujian = $ujian->id;

            return new SoalUjian([
                'id_ujian' => $id_ujian,
                'soal' => $row['Soal'],
                'jawaban_a' => $row['Jawaban A'],
                'jawaban_b' => $row['Jawaban B'],
                'jawaban_c' => $row['Jawaban C'],
                'jawaban_d' => $row['Jawaban D'],
                'jawaban_benar' => $row['Jawaban Benar'],
            ]);
        }
    }

    public function uniqueBy()
    {

    }
}