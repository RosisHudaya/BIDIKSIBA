<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerifikasiPendaftarController extends Controller
{
    public function index()
    {
        $biodatas = DB::table('biodatas as b')
            ->join('users as u', 'b.id_user', '=', 'u.id')
            ->join('asal_jurusans as jp', 'b.id_asal_jurusan', '=', 'jp.id')
            ->join('jurusans as j', 'b.id_jurusan', '=', 'j.id')
            ->join('prodis as p', 'b.id_prodi', '=', 'p.id')
            ->select(
                'b.*',
                'jp.asal_jurusan',
                'j.jurusan',
                'p.prodi',
                'u.email',
            )
            ->paginate(10);
        return view('verif-admin.index', compact('biodatas'));
    }

    public function verif(Biodata $biodata)
    {
        $biodata->update(['status' => 'Diverifikasi']);

        $token = Str::random(7);
        $password = Str::random(18);

        AkunUjian::create([
            'id_user' => $biodata->id_user,
            'token' => $token,
            'password' => $password,
        ]);

        return redirect()->route('verifikasi-pendaftar.index')->with('success', 'Verifikasi biodata pendaftar berhasil');
    }

    public function reject(Request $request, Biodata $biodata)
    {
        $biodata->update([
            'status' => 'Gagal Diverifikasi',
            'catatan' => $request->catatan,
        ]);

        $deleteAkunUjian = AkunUjian::where('id_user', $biodata->id_user)->first();
        $deleteAkunUjian->delete();

        return redirect()->route('verifikasi-pendaftar.index')->with('success', 'Data belum dapat diverifikasi dan pesan kesalahan berhasil dikirim');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
