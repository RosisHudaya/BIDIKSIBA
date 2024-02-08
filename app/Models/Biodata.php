<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_asal_jurusan',
        'id_jurusan',
        'id_prodi',
        'nik',
        'kota_lahir',
        'gender',
        'no_telp',
        'nisn',
        'asal_sekolah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function asal_jurusan()
    {
        return $this->belongsTo(AsalJurusan::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
