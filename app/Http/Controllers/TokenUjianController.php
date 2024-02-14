<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TokenUjianController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $biodata = Biodata::where('id_user', $id)->first();
        $tokenUjians = DB::table('akun_ujians as aj')
            ->leftJoin('users as u', 'aj.id_user', '=', 'u.id')
            ->leftJoin('biodatas as b', 'u.id', '=', 'b.id_user')
            ->select(
                'aj.*',
                'b.nama',
            )
            ->where('aj.id_user', '=', $id)
            ->first();
        return view('token-ujian.index', compact('tokenUjians', 'biodata'));
    }
}
