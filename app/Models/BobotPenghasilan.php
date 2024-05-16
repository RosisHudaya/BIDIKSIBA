<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotPenghasilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk',
        'penghasilan_ortu',
        'to_c1',
        'to_c5',
        'to_c6',
        'to_c8',
        'to_c9',
        'to_c10',
    ];
}
