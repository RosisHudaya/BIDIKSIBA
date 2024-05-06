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
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Psy\Command\WhereamiCommand;
use Maatwebsite\Excel\Facades\Excel;

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
        $asal_jurusans = AsalJurusan::all();
        $jurusans = Jurusan::all();
        $prodis = Prodi::all();
    }

    public function destroy(Biodata $verifikasi_pendaftar)
    {
        $verifikasi_pendaftar->delete();

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
