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

        $biodata_spk = BiodataSpk::where('id_user', $biodata->id_user)->first();
        $pekerjaan_ortu = ($biodata_spk->pekerjaan_ortu == 'Tidak Bekerja') ? 5 : (($biodata_spk->pekerjaan_ortu == 'Honorer') ? 4 : (($biodata_spk->pekerjaan_ortu == 'Serabutan') ? 3 : (($biodata_spk->pekerjaan_ortu == 'Outsourcing' ? 2 : 1))));
        $int_gaji_ortu = (int) str_replace('.', '', $biodata_spk->gaji_ortu);
        $gaji_ortu = ($int_gaji_ortu <= 1000000) ? 5 : (($int_gaji_ortu <= 2000000) ? 4 : (($int_gaji_ortu <= 3000000) ? 3 : (($int_gaji_ortu <= 4000000) ? 2 : 1)));
        $int_luas_tanah = (int) str_replace('.', '', $biodata_spk->luas_tanah);
        $luas_tanah = ($int_luas_tanah <= 50) ? 5 : (($int_luas_tanah <= 100) ? 4 : (($int_luas_tanah <= 150) ? 3 : (($int_luas_tanah <= 200) ? 2 : 1)));
        $jumlah_kamar = ($biodata_spk->jml_kmr == 1) ? 5 : (($biodata_spk->jml_kmr == 2) ? 4 : (($biodata_spk->jml_kmr == 3) ? 3 : (($biodata_spk->jml_kmr == 4) ? 2 : 1)));
        $kamar_mandi = ($biodata_spk->jml_kmr_mandi == 'Memiliki') ? 5 : 1;
        $listrik = ($biodata_spk->tagihan_listrik == 'Tidak Memiliki') ? 5 : (($biodata_spk->tagihan_listrik == '450 Watt' || $biodata_spk->tagihan_listrik == '900 Watt') ? 3 : 1);
        $int_pbb = (int) str_replace('.', '', $biodata_spk->pbb);
        $pbb = ($int_pbb < 500000) ? 5 : (($int_pbb < 1000000) ? 3 : 1);
        $int_hutang = (int) str_replace('.', '', $biodata_spk->jml_hutang);
        $hutang = ($int_hutang < 1000000) ? 5 : (($int_hutang >= 1000000) ? 1 : 3);
        $jml_sdr = ($biodata_spk->jml_sdr > 4) ? 5 : (($biodata_spk->jml_sdr > 0) ? 3 : 1);
        $status_ortu = ($biodata_spk->status_ortu == 'Yatim Piatu') ? 5 : (($biodata_spk->status_ortu == 'Yatim') ? 4 : (($biodata_spk->status_ortu == 'Piatu') ? 3 : 1));

        DataSpk::create([
            'id_user' => $biodata->id_user,
            'C1' => $pekerjaan_ortu,
            'C2' => $gaji_ortu,
            'C3' => $luas_tanah,
            'C4' => $jumlah_kamar,
            'C5' => $kamar_mandi,
            'C6' => $listrik,
            'C7' => $pbb,
            'C8' => $hutang,
            'C9' => $jml_sdr,
            'C10' => $status_ortu,
        ]);

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
