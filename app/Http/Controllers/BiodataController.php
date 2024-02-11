<?php

namespace App\Http\Controllers;

use App\Models\AsalJurusan;
use App\Models\AsalJurusanPivot;
use App\Models\Biodata;
use App\Http\Requests\StoreBiodataRequest;
use App\Http\Requests\UpdateBiodataRequest;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $asalJurusans = AsalJurusan::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $asalJurusanPivots = AsalJurusanPivot::all();
        $biodatas = Biodata::where('id_user', $id)->first();
        return view('biodata.index')->with([
            'asalJurusans' => $asalJurusans,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
            'asalJurusanPivots' => $asalJurusanPivots,
            'biodatas' => $biodatas,
        ]);
    }

    public function loadFilterJurusan(Request $request)
    {
        $jurusans = DB::table('jurusans as j')
            ->join('asal_jurusan_pivots as jp', 'j.id', '=', 'jp.id_jurusan')
            ->join('asal_jurusans as aj', 'jp.id_asal_jurusan', '=', 'aj.id')
            ->select(
                'j.id',
                'j.jurusan',
                'jp.id_asal_jurusan',
            )
            ->where('jp.id_asal_jurusan', $request->id)
            ->get();
        return response()->json(['jurusans' => $jurusans]);
    }

    public function getJurusans(Request $request)
    {
        $jurusans = DB::table('jurusans as j')
            ->join('asal_jurusan_pivots as jp', 'j.id', '=', 'jp.id_jurusan')
            ->join('asal_jurusans as aj', 'jp.id_asal_jurusan', '=', 'aj.id')
            ->select(
                'j.id',
                'j.jurusan',
                'jp.id_asal_jurusan',
            )
            ->where('jp.id_asal_jurusan', $request->asal_jurusan_id)
            ->get();
        return response()->json(['jurusans' => $jurusans]);
    }

    public function loadFilterProdi(Request $request)
    {
        $prodis = Prodi::all()->where('id_jurusan', $request->id);
        return response()->json(['prodis' => $prodis]);
    }

    public function getProdis(Request $request)
    {
        $prodis = Prodi::all()->where('id_jurusan', $request->jurusan_id);
        return response()->json(['prodis' => $prodis]);
    }

    public function storeOrUpdate(Request $request, Biodata $biodata)
    {
        $id = Auth::id();
        $idUser = Biodata::where('id_user', $id)->first();

        $request->validate(
            [
                'nama' => 'regex:/^[a-zA-Z\s]+$/u',
                'asal_sekolah' => 'regex:/^[a-zA-Z0-9\s]+$/u',
                'kota_lahir' => 'regex:/^[a-zA-Z\s]+$/u',
                'nik' => 'numeric|digits:16',
                'nisn' => 'numeric|digits:10',
                'no_telp' => 'numeric',
            ],
            [
                'nama.regex' => 'Form nama tidak boleh mengandung angka dan simbol',
                'asal_sekolah.regex' => 'Form asal sekolah tidak boleh mengandung simbol',
                'kota_lahir' => 'Form kota lahir tidak boleh mengandung angka dan simbol',
                'nik.numeric' => 'Form NIK harus berupa angka',
                'nik.digits' => 'NIK harus berjumlah 16 digit',
                'nisn.numeric' => 'Form NISN harus berupa angka',
                'nisn.digits' => 'NISN harus berjumlah 10',
                'no_telp.numeric' => 'Form no telepon harus berupa angka',
            ]
        );

        if ($idUser == null) {
            Biodata::create([
                'id_user' => $id,
                'id_asal_jurusan' => $request->asal_jurusan_id,
                'id_jurusan' => $request->jurusan_id,
                'id_prodi' => $request->prodi_id,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'kota_lahir' => $request->kota_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'no_telp' => $request->no_telp,
                'nisn' => $request->nisn,
                'asal_sekolah' => $request->asal_sekolah,
            ]);
        } else {
            $idUser->update([
                'id_user' => $id,
                'id_asal_jurusan' => $request->asal_jurusan_id,
                'id_jurusan' => $request->jurusan_id,
                'id_prodi' => $request->prodi_id,
                'nik' => $request->nik,
                'nama' => $request->nama,
                'kota_lahir' => $request->kota_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'gender' => $request->gender,
                'no_telp' => $request->no_telp,
                'nisn' => $request->nisn,
                'asal_sekolah' => $request->asal_sekolah,
            ]);
        }

        return redirect()->route('biodata.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreBiodataRequest $request)
    {
        //
    }

    public function show(Biodata $biodata)
    {
        //
    }

    public function edit(Biodata $biodata)
    {
        //
    }

    public function update(UpdateBiodataRequest $request, Biodata $biodata)
    {
        //
    }

    public function destroy(Biodata $biodata)
    {
        //
    }
}
