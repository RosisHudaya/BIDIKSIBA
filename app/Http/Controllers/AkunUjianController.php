<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AkunUjianController extends Controller
{
    public function index(Request $request)
    {
        $akunUjians = DB::table('akun_ujians as aj')
            ->join('users as u', 'aj.id_user', '=', 'u.id')
            ->join('biodatas as b', 'u.id', '=', 'b.id_user')
            ->select(
                'aj.*',
                'b.nama',
            )
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('b.nama', 'like', '%' . $name . '%');
            })
            ->paginate(10);
        return view('akun-ujian.index', compact('akunUjians'));
    }
}
