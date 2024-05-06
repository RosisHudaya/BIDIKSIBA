<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataSpk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pekerjaan_ortu_id',
        'detail_pekerjaan',
        'gaji_ortu_id',
        'slip_gaji',
        'luas_tanah',
        'shm',
        'kamar',
        'foto_kmr',
        'kamar_mandi_id',
        'foto_kmr_mandi',
        'tagihan_listrik_id',
        'slip_tagihan',
        'pajak',
        'slip_pbb',
        'hutang_id',
        'det_hutang',
        'saudara_id',
        'surat_ket_sdr',
        'status_ortu_id',
        'surat_ket_yatim',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pekerjaan_ortu()
    {
        return $this->belongsTo(PekerjaanOrtu::class);
    }

    public function gaji_ortu()
    {
        return $this->belongsTo(GajiOrtu::class);
    }

    public function luas_tanah()
    {
        return $this->belongsTo(LuasTanah::class);
    }

    public function jumlah_kamar()
    {
        return $this->belongsTo(JumlahKamar::class);
    }

    public function kamar_mandi()
    {
        return $this->belongsTo(KamarMandi::class);
    }

    public function tagihan_listrik()
    {
        return $this->belongsTo(TagihanListrik::class);
    }

    public function pajak()
    {
        return $this->belongsTo(Pajak::class);
    }

    public function hutang()
    {
        return $this->belongsTo(Hutang::class);
    }

    public function saudara()
    {
        return $this->belongsTo(Saudara::class);
    }

    public function status_ortu()
    {
        return $this->belongsTo(StatusOrtu::class);
    }
}
