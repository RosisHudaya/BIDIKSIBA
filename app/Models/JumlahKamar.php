<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_kamar',
        'nilai',
    ];
}
