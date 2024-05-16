<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotTanah extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk',
        'luas_tanah',
        'to_c4',
        'to_c7',
    ];
}
