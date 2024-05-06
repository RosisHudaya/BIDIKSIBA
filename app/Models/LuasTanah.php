<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuasTanah extends Model
{
    use HasFactory;

    protected $fillable = [
        'luas_tanah',
        'nilai',
    ];
}
