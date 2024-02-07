<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsalJurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'asal_jurusan',
    ];

    public function jurusan()
    {
        return $this->belongsToMany(Jurusan::class, 'asal_jurusan_pivots', 'id_asal_jurusan', 'id_jurusan');
    }
}
