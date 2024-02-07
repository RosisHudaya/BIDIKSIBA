<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsalJurusanPivot extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_asal_jurusan',
        'id_jurusan'
    ];
}
