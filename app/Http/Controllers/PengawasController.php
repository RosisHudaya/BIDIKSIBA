<?php

namespace App\Http\Controllers;

use App\Models\SesiUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengawasController extends Controller
{
    public function index(Request $request)
    {
        $list_ujians = DB::table('sesi_ujians')
            ->leftJoin('ujians', 'sesi_ujians.id_ujian', '=', 'ujians.id')
            ->select(
                'sesi_ujians.id',
                'sesi_ujians.nama_sesi',
                'sesi_ujians.waktu_mulai',
                'sesi_ujians.waktu_akhir',
                'ujians.nama_ujian',
            )
            ->paginate(10);
        return view('pengawas.index', compact('list_ujians'));
    }

    public function detail(Request $request, SesiUjian $sesiUjian)
    {
        $sesi_users = DB::table('sesi_users')
            ->leftJoin('users', 'sesi_users.id_user', '=', 'users.id')
            ->leftJoin('biodatas', 'users.id', '=', 'biodatas.id_user')
            ->select(
                'sesi_users.id',
                'sesi_users.id_sesi',
                'sesi_users.status',
                'biodatas.nama',
                'biodatas.gender',
            )
            ->where('sesi_users.id_sesi', $sesiUjian->id)
            ->orderBy('biodatas.nama', 'asc')
            ->paginate(25);
        return view('pengawas.detail')->with(['sesi_users' => $sesi_users]);
    }
}
