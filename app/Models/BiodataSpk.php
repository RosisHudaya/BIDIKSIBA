<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataSpk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'pekerjaan_ortu',
        'detail_pekerjaan',
        'gaji_ortu',
        'slip_gaji',
        'luas_tanah',
        'shm',
        'jml_kmr',
        'foto_kmr',
        'jml_kmr_mandi',
        'foto_kmr_mandi',
        'tagihan_listrik',
        'slip_tagihan',
        'pbb',
        'slip_pbb',
        'jml_hutang',
        'jml_sdr',
        'surat_ket_sdr',
        'status_ortu',
        'surat_ket_yatim',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
