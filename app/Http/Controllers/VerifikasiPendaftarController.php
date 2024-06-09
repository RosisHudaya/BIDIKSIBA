<?php

namespace App\Http\Controllers;

use App\Exports\AllPesertaExport;
use App\Exports\PesertaExport;
use App\Exports\SpkExport;
use App\Models\AkunUjian;
use App\Models\AsalJurusan;
use App\Models\Biodata;
use App\Models\BiodataSpk;
use App\Models\DataSpk;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Psy\Command\WhereamiCommand;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class VerifikasiPendaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:verif-admin.index')->only('index');
        $this->middleware('permission:verif-admin.edit')->only('edit', 'update');
        $this->middleware('permission:verif-admin.destroy')->only('destroy');
        $this->middleware('permission:verif-admin.export.biodata')->only('export_biodata');
        $this->middleware('permission:verif-admin.export.ekonomi')->only('export_ekonomi');
        $this->middleware('permission:verif-admin.export.pendaftar')->only('export_pendaftar');
        $this->middleware('permission:verif-admin.verifikasi-pendaftar.verif')->only('verif');
        $this->middleware('permission:verif-admin.verifikasi-pendaftar.reject')->only('reject');
    }

    public function index(Request $request)
    {
        setlocale(LC_ALL, 'IND');
        $statusSelected = $request->input('status');
        $biodatas = DB::table('biodatas as b')
            ->leftJoin('users as u', 'b.id_user', '=', 'u.id')
            ->leftJoin('biodata_spks as bs', 'u.id', '=', 'bs.user_id')
            ->leftJoin('pekerjaan_ortus as po', 'bs.pekerjaan_ortu_id', '=', 'po.id')
            ->leftJoin('gaji_ortus as go', 'bs.gaji_ortu_id', '=', 'go.id')
            ->leftJoin('kamar_mandis as km', 'bs.kamar_mandi_id', '=', 'km.id')
            ->leftJoin('tagihan_listriks as tl', 'bs.tagihan_listrik_id', '=', 'tl.id')
            ->leftJoin('hutangs as h', 'bs.hutang_id', '=', 'h.id')
            ->leftJoin('saudaras as s', 'bs.saudara_id', '=', 's.id')
            ->leftJoin('status_ortus as so', 'bs.status_ortu_id', '=', 'so.id')
            ->leftJoin('asal_jurusans as jp', 'b.id_asal_jurusan', '=', 'jp.id')
            ->leftJoin('jurusans as j', 'b.id_jurusan', '=', 'j.id')
            ->leftJoin('prodis as p', 'b.id_prodi', '=', 'p.id')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('b.nama', 'like', '%' . $name . '%');
            })
            ->when($statusSelected, function ($query, $status) {
                return $query->where('b.status', '=', $status);
            })
            ->select(
                'b.*',
                'bs.detail_pekerjaan',
                'bs.slip_gaji',
                'bs.luas_tanah',
                'bs.shm',
                'bs.kamar',
                'bs.foto_kmr',
                'bs.foto_kmr_mandi',
                'bs.slip_tagihan',
                'bs.pajak',
                'bs.slip_pbb',
                'bs.det_hutang',
                'bs.surat_ket_sdr',
                'bs.surat_ket_yatim',
                'po.pekerjaan_ortu',
                'go.gaji_ortu',
                'km.kamar_mandi',
                'tl.tagihan_listrik',
                'h.hutang',
                's.saudara',
                'so.status_ortu',
                'jp.asal_jurusan',
                'j.jurusan',
                'p.prodi',
                'u.email',
            )
            ->orderBy('b.status', 'asc')
            ->orderBy('b.updated_at', 'desc')
            ->orderBy('bs.updated_at', 'desc')
            ->paginate(10);
        return view('verif-admin.index', compact('biodatas', 'statusSelected'));
    }

    public function edit(Biodata $verifikasi_pendaftar)
    {
        $biodata_spk = BiodataSpk::where('user_id', $verifikasi_pendaftar->id_user)->first();

        $asal_jurusans = AsalJurusan::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
        $pekerjaan_ortus = PekerjaanOrtu::all();
        $gaji_ortus = GajiOrtu::all();
        $kamar_mandis = KamarMandi::all();
        $tagihan_listriks = TagihanListrik::all();
        $saudaras = Saudara::all();
        $status_ortus = StatusOrtu::all();
        $hutangs = Hutang::all();

        return view('verif-admin.edit', [
            'asal_jurusans' => $asal_jurusans,
            'jurusans' => $jurusans,
            'prodis' => $prodis,
            'pekerjaan_ortus' => $pekerjaan_ortus,
            'gaji_ortus' => $gaji_ortus,
            'kamar_mandis' => $kamar_mandis,
            'tagihan_listriks' => $tagihan_listriks,
            'saudaras' => $saudaras,
            'status_ortus' => $status_ortus,
            'hutangs' => $hutangs,
            'biodata' => $verifikasi_pendaftar,
            'biodata_spk' => $biodata_spk
        ]);
    }

    public function update(Request $request, Biodata $verifikasi_pendaftar)
    {
        $biodata_spk = BiodataSpk::where('user_id', $verifikasi_pendaftar->id_user)->first();

        $request->validate(
            [
                'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'ktp' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'kartu_siswa' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'kk' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'nama' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'asal_sekolah' => 'nullable|regex:/^[a-zA-Z0-9\s]+$/u',
                'kota_lahir' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'nik' => 'nullable|numeric|digits:16',
                'nisn' => 'nullable|numeric|digits:10',
                'no_telp' => 'nullable|numeric',
                'asal_jurusan_id' => 'nullable',
                'jurusan_id' => 'nullable',
                'prodi_id' => 'nullable',
                'detail_pekerjaan' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'slip-gaji' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'shm' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'foto-kmr' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'kmr-mandi' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'listrik' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'slip-pbb' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'sdr' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'ket-yatim' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'pekerjaan_ortu_id' => 'nullable',
                'gaji_ortu_id' => 'nullable',
                'luas_tanah' => 'nullable',
                'kamar' => 'nullable',
                'kamar_mandi_id' => 'nullable',
                'tagihan_listrik_id' => 'nullable',
                'pajak' => 'nullable',
                'hutang_id' => 'nullable',
                'saudara_id' => 'nullable',
                'status_ortu_id' => 'nullable',
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
                'asal_sekolah.regex' => 'Form asal sekolah tidak boleh mengandung simbol',
                'kota_lahir' => 'Form kota lahir tidak boleh mengandung angka dan simbol',
                'nik.numeric' => 'Form NIK harus berupa angka',
                'nik.digits' => 'NIK harus berjumlah 16 digit',
                'nisn.numeric' => 'Form NISN harus berupa angka',
                'nisn.digits' => 'NISN harus berjumlah 10',
                'no_telp.numeric' => 'Form no telepon harus berupa angka',
                'detail_pekerjaan.regex' => 'Form detail pekerjaan tidak boleh mengandung angka dan simbol',
                'slip-gaji.image' => 'File yang diunggah harus berupa gambar',
                'slip-gaji.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'slip-gaji.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'shm.image' => 'File yang diunggah harus berupa gambar',
                'shm.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'shm.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'foto-kmr.image' => 'File yang diunggah harus berupa gambar',
                'foto-kmr.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'foto-kmr.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'kmr-mandi.image' => 'File yang diunggah harus berupa gambar',
                'kmr-mandi.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'kmr-mandi.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'listrik.image' => 'File yang diunggah harus berupa gambar',
                'listrik.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'listrik.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'slip-pbb.image' => 'File yang diunggah harus berupa gambar',
                'slip-pbb.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'slip-pbb.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'sdr.image' => 'File yang diunggah harus berupa gambar',
                'sdr.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'sdr.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'ket-yatim.image' => 'File yang diunggah harus berupa gambar',
                'ket-yatim.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'ket-yatim.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
            ]
        );

        $verifikasi_pendaftar->update([
            'id_asal_jurusan' => $request->asal_jurusan_id,
            'id_jurusan' => $request->jurusan_id,
            'id_prodi' => $request->prodi_id,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'kota_lahir' => $request->kota_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'gender' => $request->gender,
            'no_telp' => $request->no_telp,
            'nisn' => $request->nisn,
            'asal_sekolah' => $request->asal_sekolah,
        ]);

        if ($request->hasFile('foto')) {
            if ($verifikasi_pendaftar->foto) {
                Storage::delete('public/' . $verifikasi_pendaftar->foto);
            }

            $extension = $request->file('foto')->extension();
            $randomName = 'foto-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('foto')->storeAs('public/foto', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $verifikasi_pendaftar->update(['foto' => $fotoPath]);
        }

        if ($request->hasFile('ktp')) {
            if ($verifikasi_pendaftar->ktp) {
                Storage::delete('public/' . $verifikasi_pendaftar->ktp);
            }

            $extension = $request->file('ktp')->extension();
            $randomName = 'ktp-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('ktp')->storeAs('public/ktp', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $verifikasi_pendaftar->update(['ktp' => $fotoPath]);
        }

        if ($request->hasFile('kartu_siswa')) {
            if ($verifikasi_pendaftar->kartu_siswa) {
                Storage::delete('public/' . $verifikasi_pendaftar->kartu_siswa);
            }

            $extension = $request->file('kartu_siswa')->extension();
            $randomName = 'kartu-siwa-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('kartu_siswa')->storeAs('public/kartu_siswa', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $verifikasi_pendaftar->update(['kartu_siswa' => $fotoPath]);
        }

        if ($request->hasFile('kk')) {
            if ($verifikasi_pendaftar->kk) {
                Storage::delete('public/' . $verifikasi_pendaftar->kk);
            }

            $extension = $request->file('kk')->extension();
            $randomName = 'kk-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('kk')->storeAs('public/kk', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $verifikasi_pendaftar->update(['kk' => $fotoPath]);
        }

        $luas_tanah_int = str_replace('.', '', $request->luas_tanah);
        $pajak_int = str_replace('.', '', $request->pbb);

        $biodata_spk->update([
            'pekerjaan_ortu_id' => $request->pekerjaan_ortu,
            'detail_pekerjaan' => $request->detail_pekerjaan,
            'gaji_ortu_id' => $request->gaji_ortu,
            'luas_tanah' => (int) $luas_tanah_int,
            'kamar' => $request->jml_kmr,
            'kamar_mandi_id' => $request->jml_kmr_mandi,
            'tagihan_listrik_id' => $request->tagihan_listrik,
            'pajak' => (int) $pajak_int,
            'hutang_id' => $request->jml_hutang,
            'saudara_id' => $request->jml_sdr,
            'status_ortu_id' => $request->status_ortu,
            'det_hutang' => $request->det_hutang,
        ]);

        if ($request->hasFile('slip-gaji')) {
            if ($biodata_spk->slip_gaji) {
                Storage::delete('public/' . $biodata_spk->slip_gaji);
            }

            $extension = $request->file('slip-gaji')->extension();
            $randomName = 'slip-gaji-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('slip-gaji')->storeAs('public/slip-gaji', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['slip_gaji' => $fotoPath]);
        }

        if ($request->hasFile('shm')) {
            if ($biodata_spk->shm) {
                Storage::delete('public/' . $biodata_spk->shm);
            }

            $extension = $request->file('shm')->extension();
            $randomName = 'shm-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('shm')->storeAs('public/shm', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['shm' => $fotoPath]);
        }

        if ($request->hasFile('foto-kmr')) {
            if ($biodata_spk->foto_kmr) {
                Storage::delete('public/' . $biodata_spk->foto_kmr);
            }

            $extension = $request->file('foto-kmr')->extension();
            $randomName = 'foto-kmr-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('foto-kmr')->storeAs('public/foto-kmr', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['foto_kmr' => $fotoPath]);
        }

        if ($request->hasFile('kmr-mandi')) {
            if ($biodata_spk->foto_kmr_mandi) {
                Storage::delete('public/' . $biodata_spk->foto_kmr_mandi);
            }

            $extension = $request->file('kmr-mandi')->extension();
            $randomName = 'kmr-mandi-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('kmr-mandi')->storeAs('public/kmr-mandi', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['foto_kmr_mandi' => $fotoPath]);
        }

        if ($request->hasFile('listrik')) {
            if ($biodata_spk->slip_tagihan) {
                Storage::delete('public/' . $biodata_spk->slip_tagihan);
            }

            $extension = $request->file('listrik')->extension();
            $randomName = 'listrik-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('listrik')->storeAs('public/listrik', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['slip_tagihan' => $fotoPath]);
        }

        if ($request->hasFile('slip-pbb')) {
            if ($biodata_spk->slip_pbb) {
                Storage::delete('public/' . $biodata_spk->slip_pbb);
            }

            $extension = $request->file('slip-pbb')->extension();
            $randomName = 'slip-pbb-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('slip-pbb')->storeAs('public/slip-pbb', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['slip_pbb' => $fotoPath]);
        }

        if ($request->hasFile('sdr')) {
            if ($biodata_spk->surat_ket_sdr) {
                Storage::delete('public/' . $biodata_spk->surat_ket_sdr);
            }

            $extension = $request->file('sdr')->extension();
            $randomName = 'sdr-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('sdr')->storeAs('public/sdr', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['surat_ket_sdr' => $fotoPath]);
        }

        if ($request->hasFile('ket-yatim')) {
            if ($biodata_spk->surat_ket_yatim) {
                Storage::delete('public/' . $biodata_spk->surat_ket_yatim);
            }

            $extension = $request->file('ket-yatim')->extension();
            $randomName = 'ket-yatim-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('ket-yatim')->storeAs('public/ket-yatim', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $biodata_spk->update(['surat_ket_yatim' => $fotoPath]);
        }

        return redirect()->route('verifikasi-pendaftar.index')->with('success', 'Biodata pendaftar berhasil diperbarui');
    }

    public function destroy(Biodata $verifikasi_pendaftar)
    {
        $verifikasi_pendaftar->delete();

        $biodata_spk = BiodataSpk::where('user_id', $verifikasi_pendaftar->id_user)->first();
        if ($biodata_spk) {
            $biodata_spk->delete();
        }

        $deleteAkunUjian = AkunUjian::where('id_user', $verifikasi_pendaftar->id_user)->first();
        if ($deleteAkunUjian) {
            $deleteAkunUjian->delete();
        }

        return redirect()->route('verifikasi-pendaftar.index')->with('success', 'Biodata pendaftar berhasil dihapus');
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
            'status' => 'Blm Diverifikasi',
            'catatan' => $request->catatan,
        ]);

        $deleteAkunUjian = AkunUjian::where('id_user', $biodata->id_user)->first();
        if ($deleteAkunUjian) {
            $deleteAkunUjian->delete();
        }

        return redirect()->route('verifikasi-pendaftar.index')->with('success', 'Data belum dapat diverifikasi dan pesan kesalahan berhasil dikirim');
    }

    public function export_biodata()
    {
        $baseURL = url('/');
        $query = DB::table('biodatas as b')
            ->leftJoin('users as u', 'b.id_user', '=', 'u.id')
            ->leftJoin('asal_jurusans as jp', 'b.id_asal_jurusan', '=', 'jp.id')
            ->leftJoin('jurusans as j', 'b.id_jurusan', '=', 'j.id')
            ->leftJoin('prodis as p', 'b.id_prodi', '=', 'p.id')
            ->select(
                'b.nama',
                'jp.asal_jurusan',
                'j.jurusan',
                'p.prodi',
                'u.email',
                'b.nik',
                'b.nisn',
                'b.kota_lahir',
                'b.asal_sekolah',
                'b.tgl_lahir',
                'b.gender',
                'b.no_telp',
                'b.foto',
                'b.ktp',
                'b.kartu_siswa',
                'b.kk',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.foto, '\")') AS foto"),
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.ktp, '\")') AS ktp"),
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.kartu_siswa, '\")') AS kartu_siswa"),
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.kk, '\")') AS kk"),
            )
            ->where('b.status', 'Diverifikasi')
            ->orderBy('b.nama', 'asc');

        $filename = 'list biodata pendaftar.xlsx';

        return Excel::download(new PesertaExport($query), $filename);
    }

    public function export_ekonomi()
    {
        $baseURL = url('/');
        $query = DB::table('biodatas as b')
            ->leftJoin('users as u', 'b.id_user', '=', 'u.id')
            ->leftJoin('biodata_spks as bs', 'u.id', '=', 'bs.user_id')
            ->leftJoin('pekerjaan_ortus as po', 'bs.pekerjaan_ortu_id', '=', 'po.id')
            ->leftJoin('gaji_ortus as go', 'bs.gaji_ortu_id', '=', 'go.id')
            ->leftJoin('kamar_mandis as km', 'bs.kamar_mandi_id', '=', 'km.id')
            ->leftJoin('tagihan_listriks as tl', 'bs.tagihan_listrik_id', '=', 'tl.id')
            ->leftJoin('hutangs as h', 'bs.hutang_id', '=', 'h.id')
            ->leftJoin('saudaras as s', 'bs.saudara_id', '=', 's.id')
            ->leftJoin('status_ortus as so', 'bs.status_ortu_id', '=', 'so.id')
            ->leftJoin('asal_jurusans as jp', 'b.id_asal_jurusan', '=', 'jp.id')
            ->leftJoin('jurusans as j', 'b.id_jurusan', '=', 'j.id')
            ->leftJoin('prodis as p', 'b.id_prodi', '=', 'p.id')
            ->select(
                'b.nama',
                'po.pekerjaan_ortu',
                DB::raw("IFNULL(bs.detail_pekerjaan, '-') as detail_pekerjaan"),
                'go.gaji_ortu',
                DB::raw("IF(bs.slip_gaji IS NULL OR bs.slip_gaji = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.slip_gaji , '\")')) AS slip_gaji"),
                'bs.luas_tanah',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.shm, '\")') AS shm"),
                'bs.kamar',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.foto_kmr, '\")') AS foto_kmr"),
                'km.kamar_mandi',
                DB::raw("IF(bs.foto_kmr_mandi IS NULL OR bs.foto_kmr_mandi = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.foto_kmr_mandi, '\")')) AS foto_kmr_mandi"),
                'tl.tagihan_listrik',
                DB::raw("IF(bs.slip_tagihan IS NULL OR bs.slip_tagihan = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.slip_tagihan, '\")')) AS slip_tagihan"),
                'bs.pajak',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.slip_pbb, '\")') AS slip_pbb"),
                'h.hutang',
                DB::raw("IFNULL(bs.det_hutang, '-') as det_hutang"),
                's.saudara',
                DB::raw("IF(bs.surat_ket_sdr IS NULL OR bs.surat_ket_sdr = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.surat_ket_sdr, '\")')) AS surat_ket_sdr"),
                'so.status_ortu',
                DB::raw("IF(bs.surat_ket_yatim IS NULL OR bs.surat_ket_yatim = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.surat_ket_yatim, '\")')) AS surat_ket_yatim"),
            )
            ->where('b.status', 'Diverifikasi')
            ->orderBy('b.nama', 'asc');

        $filename = 'list data spk.xlsx';

        return Excel::download(new SpkExport($query), $filename);
    }

    public function export_pendaftar()
    {
        $baseURL = url('/');
        $query = DB::table('biodatas as b')
            ->leftJoin('users as u', 'b.id_user', '=', 'u.id')
            ->leftJoin('biodata_spks as bs', 'u.id', '=', 'bs.user_id')
            ->leftJoin('pekerjaan_ortus as po', 'bs.pekerjaan_ortu_id', '=', 'po.id')
            ->leftJoin('gaji_ortus as go', 'bs.gaji_ortu_id', '=', 'go.id')
            ->leftJoin('kamar_mandis as km', 'bs.kamar_mandi_id', '=', 'km.id')
            ->leftJoin('tagihan_listriks as tl', 'bs.tagihan_listrik_id', '=', 'tl.id')
            ->leftJoin('hutangs as h', 'bs.hutang_id', '=', 'h.id')
            ->leftJoin('saudaras as s', 'bs.saudara_id', '=', 's.id')
            ->leftJoin('status_ortus as so', 'bs.status_ortu_id', '=', 'so.id')
            ->leftJoin('asal_jurusans as jp', 'b.id_asal_jurusan', '=', 'jp.id')
            ->leftJoin('jurusans as j', 'b.id_jurusan', '=', 'j.id')
            ->leftJoin('prodis as p', 'b.id_prodi', '=', 'p.id')
            ->select(
                'b.nama',
                'jp.asal_jurusan',
                'j.jurusan',
                'p.prodi',
                'u.email',
                'b.nik',
                'b.nisn',
                'b.kota_lahir',
                'b.asal_sekolah',
                'b.tgl_lahir',
                'b.gender',
                'b.no_telp',
                'b.foto',
                'b.ktp',
                'b.kartu_siswa',
                'b.kk',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.foto, '\")') AS foto"),
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.ktp, '\")') AS ktp"),
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.kartu_siswa, '\")') AS kartu_siswa"),
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', b.kk, '\")') AS kk"),
                'po.pekerjaan_ortu',
                DB::raw("IFNULL(bs.detail_pekerjaan, '-') as detail_pekerjaan"),
                'go.gaji_ortu',
                DB::raw("IF(bs.slip_gaji IS NULL OR bs.slip_gaji = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.slip_gaji , '\")')) AS slip_gaji"),
                'bs.luas_tanah',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.shm, '\")') AS shm"),
                'bs.kamar',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.foto_kmr, '\")') AS foto_kmr"),
                'km.kamar_mandi',
                DB::raw("IF(bs.foto_kmr_mandi IS NULL OR bs.foto_kmr_mandi = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.foto_kmr_mandi, '\")')) AS foto_kmr_mandi"),
                'tl.tagihan_listrik',
                DB::raw("IF(bs.slip_tagihan IS NULL OR bs.slip_tagihan = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.slip_tagihan, '\")')) AS slip_tagihan"),
                'bs.pajak',
                DB::raw("CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.slip_pbb, '\")') AS slip_pbb"),
                'h.hutang',
                DB::raw("IFNULL(bs.det_hutang, '-') as det_hutang"),
                's.saudara',
                DB::raw("IF(bs.surat_ket_sdr IS NULL OR bs.surat_ket_sdr = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.surat_ket_sdr, '\")')) AS surat_ket_sdr"),
                'so.status_ortu',
                DB::raw("IF(bs.surat_ket_yatim IS NULL OR bs.surat_ket_yatim = '', '-', CONCAT('=HYPERLINK(\"$baseURL/storage/', bs.surat_ket_yatim, '\")')) AS surat_ket_yatim"),
            )
            ->where('b.status', 'Diverifikasi')
            ->orderBy('b.nama', 'asc');

        $filename = 'list data pendaftar.xlsx';

        return Excel::download(new AllPesertaExport($query), $filename);
    }
}
