<?php

namespace App\Http\Controllers;

use App\Models\AkunUjian;
use App\Models\Biodata;
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
            ->leftJoin('biodata_spks as bs', 'u.id', '=', 'bs.id_user')
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
                'bs.pekerjaan_ortu',
                'bs.detail_pekerjaan',
                'bs.gaji_ortu',
                'bs.slip_gaji',
                'bs.luas_tanah',
                'bs.shm',
                'bs.jml_kmr',
                'bs.foto_kmr',
                'bs.jml_kmr_mandi',
                'bs.foto_kmr_mandi',
                'bs.tagihan_listrik',
                'bs.slip_tagihan',
                'bs.pbb',
                'bs.slip_pbb',
                'bs.jml_hutang',
                'bs.jml_sdr',
                'bs.surat_ket_sdr',
                'bs.status_ortu',
                'bs.surat_ket_yatim',
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
