<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotPajak extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk',
        'pajak',
        'to_c3',
        'to_c4',
    ];
}
