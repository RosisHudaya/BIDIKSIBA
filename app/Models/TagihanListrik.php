<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanListrik extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagihan_listrik',
        'nilai',
    ];
}
