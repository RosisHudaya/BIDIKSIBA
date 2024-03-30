<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class SpkExport implements FromQuery, WithHeadings, ShouldAutoSize
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

    public function headings(): array
    {
        return [
            'NAMA',
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
