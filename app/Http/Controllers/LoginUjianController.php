<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
