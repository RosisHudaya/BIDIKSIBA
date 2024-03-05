<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrtu extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_ortu',
        'nilai',
    ];
}
