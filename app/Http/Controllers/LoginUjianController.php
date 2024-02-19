<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LoginUjianController extends Controller
{
    public function login_ujian(Request $request)
    {
        $id = Auth::id();
        $token = $request->input('token');
        $password = $request->input('password');

        $akun = AkunUjian::where('token', $token)->first();

        if ($akun && $id === $akun->id_user && $token && $password === $akun->password) {
            $request->session()->put('login_ujian', true);
            return redirect()->route('list.ujian');
        } else {
            return back()->with('error', 'Token atau password salah. Silakan coba lagi.');
        }
    }

    public function logout_ujian(Request $request)
    {
        $request->session()->forget('login_ujian');

        return redirect()->route('login.ujian');
    }

    public function list_ujian()
    {
        $id = Auth::id();
        $list_ujians = DB::table('sesi_ujians as sesi')
            ->leftJoin('ujians as ujian', 'sesi.id_ujian', '=', 'ujian.id')
            ->leftJoin('sesi_users as user', 'sesi.id', '=', 'user.id_sesi')
            ->select(
                'ujian.nama_ujian',
                'sesi.waktu_mulai',
                'sesi.waktu_akhir',
                'user.status',
            )
            ->where('user.id_user', $id)
            ->paginate(10);
        return view('ujian-user.list-ujian', compact('list_ujians'));
    }
}
