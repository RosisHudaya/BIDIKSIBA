<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jurusan',
        'prodi',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
