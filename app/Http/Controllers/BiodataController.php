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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    public function index_dash()
    {
        $id = Auth::id();
        $biodatas = Biodata::where('id_user', $id)->first();
        return view('welcome')->with([
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
                'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'nama' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'asal_sekolah' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/u',
                'kota_lahir' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'nik' => 'nullable|numeric|digits:16',
                'nisn' => 'nullable|numeric|digits:10',
                'no_telp' => 'nullable|numeric',
                'asal_jurusan_id' => 'nullable',
                'jurusan_id' => 'nullable',
                'prodi_id' => 'nullable',
            ],
            [
                'foto.image' => 'File yang diunggah harus berupa gambar',
                'foto.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'foto.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
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
            $biodata = Biodata::create([
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
                'status' => 'Pending',
                'catatan' => '',
            ]);

            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->extension();
                $randomName = 'foto-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('foto')->storeAs('public/foto', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata->update(['foto' => $fotoPath]);
            }
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
                'status' => 'Pending',
                'catatan' => '',
            ]);

            if ($request->hasFile('foto')) {
                if ($idUser->foto) {
                    Storage::delete('public/' . $idUser->foto);
                }

                $extension = $request->file('foto')->extension();
                $randomName = 'foto-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('foto')->storeAs('public/foto', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idUser->update(['foto' => $fotoPath]);
            }
        }

        return redirect()->route('biodata.index')->with('success', 'success-biodata');
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
