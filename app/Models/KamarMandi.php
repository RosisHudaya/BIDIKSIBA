<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarMandi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kamar_mandi',
        'nilai',
    ];
}
