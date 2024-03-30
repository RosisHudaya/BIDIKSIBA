<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Support\Facades\DB;

class AllPesertaExport implements FromQuery, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function query()
    {
        return $this->query;
    }

    public function columnFormats(): array
    {
        return [
            'F' => '@',
        ];
    }

    public function headings(): array
    {
        return [
            'NAMA',
            'ASAL JURUSAN',
            'JURUSAN PILIHAN',
            'PROGRAM STUDI PILIHAN',
            'EMAIL',
            'NIK',
            'NISN',
            'ASAL SEKOLAH',
            'KOTA LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'NOMER TELEPON',
            'FOTO',
            'KTP',
            'KARTU SISWA',
            'KARTU KELUARGA',
            'PEKERJAAN ORANG TUA',
            'DETAIL PEKERJAAN',
            'PENGHASILAN ORANG TUA',
            'SLIP GAJI',
            'LUAS TANAH',
            'SHM',
            'JUMLAH KAMAR',
            'FOTO KAMAR',
            'KEPEMILIKAN KAMAR MANDI',
            'FOTO KAMAR MANDI',
            'TAGIHAN LISTRIK',
            'BUKTI TAGIHAN LISTRIK',
            'PAJAK BUMI DAN BANGUNAN',
            'BUKTI SLIP PBB',
            'HUTANG',
            'DETAIL HUTANG',
            'JUMLAH SAUDARA',
            'SURAT KET SAUDARA',
            'STATUS ORANG TUA',
            'SURAT KET YATIM',
        ];
    }
}
