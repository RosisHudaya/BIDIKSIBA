<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sesi',
        'id_user',
    ];

    public function sesi_ujian()
    {
        return $this->belongsTo(SesiUjian::class, 'id_sesi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
