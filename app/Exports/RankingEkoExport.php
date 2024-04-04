<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RankingEkoExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'RANKING',
            'NAMA',
            'SEKOLAH',
            'PEKERJAAN ORANG TUA',
            'GAJI ORANG TUA',
            'LUAS TANAH',
            'JUMLAH KAMAR',
            'KEPEMILIKAN KAMAR MANDI',
            'LISTRIK',
            'PAJAK BUMI DAN BANGUNAN',
            'JUMLAH HUTANG',
            'JUMLHA SAUDARA',
            'STATUS ORANG TUA',
            'POINT',
        ];
    }
}
