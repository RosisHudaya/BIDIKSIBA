<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use App\Models\Biodata;
use App\Models\BiodataSpk;
use App\Models\DataSpk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Psy\Command\WhereamiCommand;

class VerifikasiPendaftarController extends Controller
{
    public function index(Request $request)
    {
        $statusSelected = $request->input('status');
        $biodatas = DB::table('biodatas as b')
            ->leftJoin('users as u', 'b.id_user', '=', 'u.id')
            ->leftJoin('biodata_spks as bs', 'u.id', '=', 'bs.user_id')
            ->leftJoin('pekerjaan_ortus as po', 'bs.pekerjaan_ortu_id', '=', 'po.id')
            ->leftJoin('gaji_ortus as go', 'bs.gaji_ortu_id', '=', 'go.id')
            ->leftJoin('luas_tanahs as lt', 'bs.luas_tanah_id', '=', 'lt.id')
            ->leftJoin('jumlah_kamars as jk', 'bs.kamar_id', '=', 'jk.id')
            ->leftJoin('kamar_mandis as km', 'bs.kamar_mandi_id', '=', 'km.id')
            ->leftJoin('tagihan_listriks as tl', 'bs.tagihan_listrik_id', '=', 'tl.id')
            ->leftJoin('pajaks as pj', 'bs.pajak_id', '=', 'pj.id')
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
                'bs.shm',
                'bs.foto_kmr',
                'bs.foto_kmr_mandi',
                'bs.slip_tagihan',
                'bs.slip_pbb',
                'bs.det_hutang',
                'bs.surat_ket_sdr',
                'bs.surat_ket_yatim',
                'po.pekerjaan_ortu',
                'go.gaji_ortu',
                'lt.luas_tanah',
                'jk.jumlah_kamar',
                'km.kamar_mandi',
                'tl.tagihan_listrik',
                'pj.pajak',
                'h.hutang',
                's.saudara',
                'so.status_ortu',
                'jp.asal_jurusan',
                'j.jurusan',
                'p.prodi',
                'u.email',
            )
            ->orderBy('b.status', 'asc')
            ->paginate(10);
        return view('verif-admin.index', compact('biodatas', 'statusSelected'));
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
