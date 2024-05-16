<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKamarMandi extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk',
        'kamar_mandi',
        'to_c1',
        'to_c2',
        'to_c6',
        'to_c8',
        'to_c9',
        'to_c10',
    ];
}
