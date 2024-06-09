<?php

namespace App\Http\Controllers;

use App\Models\AsalJurusan;
use App\Models\AsalJurusanPivot;
use App\Models\Biodata;
use App\Http\Requests\StoreBiodataRequest;
use App\Http\Requests\UpdateBiodataRequest;
use App\Models\BiodataSpk;
use App\Models\GajiOrtu;
use App\Models\Hutang;
use App\Models\Jurusan;
use App\Models\KamarMandi;
use App\Models\PekerjaanOrtu;
use App\Models\Prodi;
use App\Models\Saudara;
use App\Models\StatusOrtu;
use App\Models\TagihanListrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Str;

class BiodataController extends Controller
{
    public function index_dash()
    {
        App::setLocale('id');

        $id = Auth::id();
        $biodatas = Biodata::where('id_user', $id)->first();

        $berkass = DB::table('berkas')
            ->select('berkas.*')
            ->get();

        $jadwal = DB::table('jadwals')
            ->select('jadwals.*')
            ->first();

        $jadwalSId = null;
        $jadwalEId = null;
        if ($jadwal) {
            $start = Carbon::parse($jadwal->start);
            $jadwalSId = $start->translatedFormat('l, d F Y H:i:s');

            $end = Carbon::parse($jadwal->end);
            $jadwalEId = $end->translatedFormat('l, d F Y H:i:s');
        }

        return view('welcome')->with([
            'biodatas' => $biodatas,
            'berkass' => $berkass,
            'jadwal' => $jadwal,
            'jadwalSId' => $jadwalSId,
            'jadwalEId' => $jadwalEId,
        ]);
    }

    public function index()
    {
        $id = Auth::id();
        $asalJurusans = AsalJurusan::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $asalJurusanPivots = AsalJurusanPivot::all();
        $biodatas = Biodata::where('id_user', $id)->first();
        $pekerjaan_ortus = PekerjaanOrtu::all();
        $gaji_ortus = GajiOrtu::all();
        $kamar_mandis = KamarMandi::all();
        $tagihan_listriks = TagihanListrik::all();
        $saudaras = Saudara::all();
        $status_ortus = StatusOrtu::all();
        $hutangs = Hutang::all();
        $biodata_spk = BiodataSpk::where('user_id', $id)->first();
        return view('biodata.index')->with([
            'asalJurusans' => $asalJurusans,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
            'asalJurusanPivots' => $asalJurusanPivots,
            'biodatas' => $biodatas,
            'pekerjaan_ortus' => $pekerjaan_ortus,
            'gaji_ortus' => $gaji_ortus,
            'kamar_mandis' => $kamar_mandis,
            'tagihan_listriks' => $tagihan_listriks,
            'saudaras' => $saudaras,
            'status_ortus' => $status_ortus,
            'hutangs' => $hutangs,
            'biodata_spk' => $biodata_spk,
        ]);
    }

    public function index_pendukung()
    {
        $id = Auth::id();
        $asalJurusans = AsalJurusan::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $asalJurusanPivots = AsalJurusanPivot::all();
        $biodatas = Biodata::where('id_user', $id)->first();
        $pekerjaan_ortus = PekerjaanOrtu::all();
        $gaji_ortus = GajiOrtu::all();
        $kamar_mandis = KamarMandi::all();
        $tagihan_listriks = TagihanListrik::all();
        $saudaras = Saudara::all();
        $status_ortus = StatusOrtu::all();
        $hutangs = Hutang::all();
        $biodata_spk = BiodataSpk::where('user_id', $id)->first();
        return view('biodata.index-pendukung')->with([
            'asalJurusans' => $asalJurusans,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
            'asalJurusanPivots' => $asalJurusanPivots,
            'biodatas' => $biodatas,
            'pekerjaan_ortus' => $pekerjaan_ortus,
            'gaji_ortus' => $gaji_ortus,
            'kamar_mandis' => $kamar_mandis,
            'tagihan_listriks' => $tagihan_listriks,
            'saudaras' => $saudaras,
            'status_ortus' => $status_ortus,
            'hutangs' => $hutangs,
            'biodata_spk' => $biodata_spk,
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
                'ktp' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'kartu_siswa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'kk' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'nama' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'asal_sekolah' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/u',
                'alamat' => 'nullable|regex:/^[^0-9]*$/',
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
                'ktp.image' => 'File yang diunggah harus berupa gambar',
                'ktp.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'ktp.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'kartu_siswa.image' => 'File yang diunggah harus berupa gambar',
                'kartu_siswa.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'kartu_siswa.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'kk.image' => 'File yang diunggah harus berupa gambar',
                'kk.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'kk.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'nama.regex' => 'Form nama tidak boleh mengandung angka dan simbol',
                'alamat.regex' => 'Form alamat tidak boleh mengandung angka',
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
                'alamat' => $request->alamat,
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

            if ($request->hasFile('ktp')) {
                $extension = $request->file('ktp')->extension();
                $randomName = 'ktp-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('ktp')->storeAs('public/ktp', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata->update(['ktp' => $fotoPath]);
            }

            if ($request->hasFile('kartu_siswa')) {
                $extension = $request->file('kartu_siswa')->extension();
                $randomName = 'kartu-siswa-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('kartu_siswa')->storeAs('public/kartu_siswa', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata->update(['kartu_siswa' => $fotoPath]);
            }

            if ($request->hasFile('kk')) {
                $extension = $request->file('kk')->extension();
                $randomName = 'kk-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('kk')->storeAs('public/kk', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata->update(['kk' => $fotoPath]);
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
                'alamat' => $request->alamat,
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

            if ($request->hasFile('ktp')) {
                if ($idUser->ktp) {
                    Storage::delete('public/' . $idUser->ktp);
                }

                $extension = $request->file('ktp')->extension();
                $randomName = 'ktp-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('ktp')->storeAs('public/ktp', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idUser->update(['ktp' => $fotoPath]);
            }

            if ($request->hasFile('kartu_siswa')) {
                if ($idUser->kartu_siswa) {
                    Storage::delete('public/' . $idUser->kartu_siswa);
                }

                $extension = $request->file('kartu_siswa')->extension();
                $randomName = 'kartu-siwa-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('kartu_siswa')->storeAs('public/kartu_siswa', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idUser->update(['kartu_siswa' => $fotoPath]);
            }

            if ($request->hasFile('kk')) {
                if ($idUser->kk) {
                    Storage::delete('public/' . $idUser->kk);
                }

                $extension = $request->file('kk')->extension();
                $randomName = 'kk-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('kk')->storeAs('public/kk', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idUser->update(['kk' => $fotoPath]);
            }
        }

        return redirect()->route('biodata.index')->with('success', 'success-biodata');
    }
}
