<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk',
        'jumlah_kamar',
        'to_c3',
        'to_c7',
    ];
}
