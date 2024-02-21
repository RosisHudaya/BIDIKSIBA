<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use App\Models\Jawaban;
use App\Models\SesiUjian;
use App\Models\SesiUser;
use App\Models\SoalUjian;
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
                'sesi.id',
            )
            ->where('user.id_user', $id)
            ->paginate(10);
        return view('ujian-user.list-ujian', compact('list_ujians'));
    }

    public function show_ujian(SesiUjian $sesiUjian)
    {
        $id = Auth::id();
        $detail_ujians = DB::table('sesi_users as pivot')
            ->leftJoin('sesi_ujians as sesi', 'pivot.id_sesi', '=', 'sesi.id')
            ->leftJoin('users as user', 'pivot.id_user', '=', 'user.id')
            ->leftJoin('biodatas as biodata', 'user.id', '=', 'biodata.id_user')
            ->leftJoin('ujians as ujian', 'sesi.id_ujian', '=', 'ujian.id')
            ->leftJoin('soal_ujians as soal', 'ujian.id', '=', 'soal.id_ujian')
            ->select(
                'sesi.id',
                'ujian.nama_ujian',
                'ujian.deskripsi',
                'biodata.nama',
                'biodata.nisn',
                'sesi.nama_sesi',
                'sesi.waktu_mulai',
                'sesi.waktu_akhir',
                DB::raw('COUNT(*) as jumlah_soal'),
                DB::raw("TIMESTAMPDIFF(MINUTE, sesi.waktu_mulai, sesi.waktu_akhir) as durasi_menit"),
            )
            ->where('pivot.id_user', $id)
            ->where('pivot.id_sesi', $sesiUjian->id)
            ->groupBy(
                'sesi.id',
                'ujian.nama_ujian',
                'ujian.deskripsi',
                'biodata.nama',
                'biodata.nisn',
                'sesi.nama_sesi',
                'sesi.waktu_mulai',
                'sesi.waktu_akhir',
            )
            ->first();
        $jumlah_soal_ujian = $detail_ujians->jumlah_soal;
        $durasi_menit = $detail_ujians->durasi_menit;

        return view('ujian-user.detail-ujian')->with([
            'detail_ujians' => $detail_ujians,
            'jumlah_soal_ujian' => $jumlah_soal_ujian,
            'durasi_menit' => $durasi_menit,
            'sesiUjian' => $sesiUjian,
        ]);
    }

    public function soal(SesiUjian $sesiUjian)
    {
        $id = Auth::id();
        $soals = DB::table('sesi_users as pivot')
            ->leftJoin('sesi_ujians as sesi', 'pivot.id_sesi', '=', 'sesi.id')
            ->leftJoin('ujians as ujian', 'sesi.id_ujian', '=', 'ujian.id')
            ->leftJoin('soal_ujians as soal', 'ujian.id', '=', 'soal.id_ujian')
            ->select(
                'pivot.id_sesi',
                'soal.id',
                'soal.soal',
                'soal.jawaban_a',
                'soal.jawaban_b',
                'soal.jawaban_c',
                'soal.jawaban_d',
                'soal.jawaban_benar',
            )
            ->where('pivot.id_user', $id)
            ->where('pivot.id_sesi', $sesiUjian->id)
            ->get();

        $jawabans = DB::table('jawabans')
            ->where('id_user', $id)
            ->whereIn('id_soal', $soals->pluck('id'))
            ->pluck('jawaban', 'id_soal');

        return view('ujian-user.soal')->with([
            'soals' => $soals,
            'jawabans' => $jawabans,
        ]);
    }

    public function jawab(Request $request, SoalUjian $soalUjian, SesiUjian $sesiUjian)
    {
        $id = Auth::id();
        $jawaban = Jawaban::where('id_user', $id)
            ->where('id_soal', $soalUjian->id)
            ->first();

        $soal = SoalUjian::where('id', $soalUjian->id)->first();
        $jawabanBenar = $soal->jawaban_benar;

        if ($jawaban == null) {
            $skor = ($request->jawab == $jawabanBenar) ? 4 : -2;
            $jawabans = Jawaban::create([
                'id_user' => $id,
                'id_soal' => $soalUjian->id,
                'jawaban' => $request->jawab,
                'skor' => $skor,
            ]);
        } else {
            $skor = ($request->jawab == $jawabanBenar) ? 4 : -2;
            $jawaban->update([
                'jawaban' => $request->jawab,
                'skor' => $skor,
            ]);
        }

        return redirect()->route('ujian', ['sesiUjian' => $sesiUjian->id]);
    }

}
