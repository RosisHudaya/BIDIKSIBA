<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunUjian extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'token',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}