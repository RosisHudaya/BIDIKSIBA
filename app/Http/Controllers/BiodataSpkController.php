<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\BiodataSpk;
use App\Http\Requests\StoreBiodataSpkRequest;
use App\Http\Requests\UpdateBiodataSpkRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BiodataSpkController extends Controller
{
    public function index()
    {

    }

    public function storeOrUpdate(Request $request, BiodataSpk $biodataSpk)
    {
        $id = Auth::id();
        $idBiodataSpk = BiodataSpk::where('user_id', $id)->first();
        $idBiodata = Biodata::where('id_user', $id)->first();

        $request->validate(
            [
                'detail_pekerjaan' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
            ],
            [
                'detail_pekerjaan.regex' => 'Form detail pekerjaan tidak boleh mengandung angka dan simbol',
            ]
        );

        $luas_tanah_int = str_replace('.', '', $request->luas_tanah);
        $pajak_int = str_replace('.', '', $request->pbb);

        if ($idBiodataSpk == null) {
            $biodata_spk = BiodataSpk::create([
                'user_id' => $id,
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

            if ($idBiodata == null) {
                Biodata::create([
                    'id_user' => $id,
                    'status' => 'Pending'
                ]);
            } else {
                $idBiodata->update([
                    'id_user' => $id,
                    'status' => 'Pending',
                ]);
            }

            if ($request->hasFile('slip-gaji')) {
                $extension = $request->file('slip-gaji')->extension();
                $randomName = 'slip-gaji-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('slip-gaji')->storeAs('public/slip-gaji', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['slip_gaji' => $fotoPath]);
            }

            if ($request->hasFile('shm')) {
                $extension = $request->file('shm')->extension();
                $randomName = 'shm-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('shm')->storeAs('public/shm', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['shm' => $fotoPath]);
            }

            if ($request->hasFile('foto-kmr')) {
                $extension = $request->file('foto-kmr')->extension();
                $randomName = 'foto-kmr-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('foto-kmr')->storeAs('public/foto-kmr', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['foto_kmr' => $fotoPath]);
            }

            if ($request->hasFile('kmr-mandi')) {
                $extension = $request->file('kmr-mandi')->extension();
                $randomName = 'kmr-mandi-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('kmr-mandi')->storeAs('public/kmr-mandi', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['foto_kmr_mandi' => $fotoPath]);
            }

            if ($request->hasFile('listrik')) {
                $extension = $request->file('listrik')->extension();
                $randomName = 'listrik-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('listrik')->storeAs('public/listrik', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['slip_tagihan' => $fotoPath]);
            }

            if ($request->hasFile('slip-pbb')) {
                $extension = $request->file('slip-pbb')->extension();
                $randomName = 'slip-pbb-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('slip-pbb')->storeAs('public/slip-pbb', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['slip_pbb' => $fotoPath]);
            }

            if ($request->hasFile('sdr')) {
                $extension = $request->file('sdr')->extension();
                $randomName = 'sdr-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('sdr')->storeAs('public/sdr', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['surat_ket_sdr' => $fotoPath]);
            }

            if ($request->hasFile('ket-yatim')) {
                $extension = $request->file('ket-yatim')->extension();
                $randomName = 'ket-yatim-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('ket-yatim')->storeAs('public/ket-yatim', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $biodata_spk->update(['surat_ket_yatim' => $fotoPath]);
            }
        } else {
            $luas_tanah_int = str_replace('.', '', $request->luas_tanah);
            $pajak_int = str_replace('.', '', $request->pbb);

            $idBiodataSpk->update([
                'user_id' => $id,
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

            $idBiodata->update([
                'status' => 'Pending',
            ]);

            if ($request->hasFile('slip-gaji')) {
                if ($idBiodataSpk->slip_gaji) {
                    Storage::delete('public/' . $idBiodataSpk->slip_gaji);
                }

                $extension = $request->file('slip-gaji')->extension();
                $randomName = 'slip-gaji-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('slip-gaji')->storeAs('public/slip-gaji', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['slip_gaji' => $fotoPath]);
            }

            if ($request->hasFile('shm')) {
                if ($idBiodataSpk->shm) {
                    Storage::delete('public/' . $idBiodataSpk->shm);
                }

                $extension = $request->file('shm')->extension();
                $randomName = 'shm-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('shm')->storeAs('public/shm', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['shm' => $fotoPath]);
            }

            if ($request->hasFile('foto-kmr')) {
                if ($idBiodataSpk->foto_kmr) {
                    Storage::delete('public/' . $idBiodataSpk->foto_kmr);
                }

                $extension = $request->file('foto-kmr')->extension();
                $randomName = 'foto-kmr-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('foto-kmr')->storeAs('public/foto-kmr', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['foto_kmr' => $fotoPath]);
            }

            if ($request->hasFile('kmr-mandi')) {
                if ($idBiodataSpk->foto_kmr_mandi) {
                    Storage::delete('public/' . $idBiodataSpk->foto_kmr_mandi);
                }

                $extension = $request->file('kmr-mandi')->extension();
                $randomName = 'kmr-mandi-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('kmr-mandi')->storeAs('public/kmr-mandi', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['foto_kmr_mandi' => $fotoPath]);
            }

            if ($request->hasFile('listrik')) {
                if ($idBiodataSpk->slip_tagihan) {
                    Storage::delete('public/' . $idBiodataSpk->slip_tagihan);
                }

                $extension = $request->file('listrik')->extension();
                $randomName = 'listrik-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('listrik')->storeAs('public/listrik', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['slip_tagihan' => $fotoPath]);
            }

            if ($request->hasFile('slip-pbb')) {
                if ($idBiodataSpk->slip_pbb) {
                    Storage::delete('public/' . $idBiodataSpk->slip_pbb);
                }

                $extension = $request->file('slip-pbb')->extension();
                $randomName = 'slip-pbb-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('slip-pbb')->storeAs('public/slip-pbb', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['slip_pbb' => $fotoPath]);
            }

            if ($request->hasFile('sdr')) {
                if ($idBiodataSpk->surat_ket_sdr) {
                    Storage::delete('public/' . $idBiodataSpk->surat_ket_sdr);
                }

                $extension = $request->file('sdr')->extension();
                $randomName = 'sdr-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('sdr')->storeAs('public/sdr', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['surat_ket_sdr' => $fotoPath]);
            }

            if ($request->hasFile('ket-yatim')) {
                if ($idBiodataSpk->surat_ket_yatim) {
                    Storage::delete('public/' . $idBiodataSpk->surat_ket_yatim);
                }

                $extension = $request->file('ket-yatim')->extension();
                $randomName = 'ket-yatim-' . Str::random(9) . '.' . $extension;

                $fotoPath = $request->file('ket-yatim')->storeAs('public/ket-yatim', $randomName);
                $fotoPath = str_replace('public/', '', $fotoPath);

                $idBiodataSpk->update(['surat_ket_yatim' => $fotoPath]);
            }
        }

        return redirect()->route('biodata.index_p')->with('success', 'success-biodata-spk');
    }
}
