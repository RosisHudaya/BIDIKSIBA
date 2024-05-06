<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PekerjaanOrtu extends Model
{
    use HasFactory;

    protected $fillable = [
        'pekerjaan_ortu',
        'nilai',
    ];
}
