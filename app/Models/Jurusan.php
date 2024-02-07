<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan',
    ];

    public function asal_jurusan()
    {
        return $this->belongsToMany(AsalJurusan::class, 'asal_jurusan_pivots', 'id_jurusan', 'id_asal_jurusan');
    }
}
