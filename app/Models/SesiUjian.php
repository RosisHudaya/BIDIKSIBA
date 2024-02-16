<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ujian',
        'nama_sesi',
        'waktu_mulai',
        'waktu_akhir',
    ];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function sesi_user()
    {
        return $this->hasMany(SesiUser::class, 'id_sesi');
    }
}
