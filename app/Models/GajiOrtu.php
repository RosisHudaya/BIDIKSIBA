<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiOrtu extends Model
{
    use HasFactory;

    protected $fillable = [
        'gaji_ortu',
        'nilai',
    ];
}
