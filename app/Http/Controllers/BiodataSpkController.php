<?php

namespace App\Http\Controllers;

use App\Models\BiodataSpk;
use App\Http\Requests\StoreBiodataSpkRequest;
use App\Http\Requests\UpdateBiodataSpkRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BiodataSpkController extends Controller
{
    public function index()
    {

    }

    public function storeOrUpdate(Request $request, BiodataSpk $biodataSpk)
    {
        $id = Auth::id();
        $iduser = BiodataSpk::where('id_user', $id)->first();

        $request->validate(
            [
                'detail_pekerjaan' => 'nullable|regex:/^[a-zA-Z\s]+$/u',
                'gaji_ortu' => 'nullable',
                'luas_tanah' => 'nullable',
                'jml_kmr' => 'nullable|numeric',
                'pbb' => 'nullable',
                'jml_sdr' => 'nullable|numeric',
            ],
            [
                'detail_pekerjaan.regex' => 'Form detail pekerjaan tidak boleh mengandung angka dan simbol',
                'jml_kmr.numeric' => 'Form jumlah kamar harus berupa angka',
                'jml_sdr.numeric' => 'Form jumlah saudara harus berupa angka',
            ]
        );

        if ($iduser == null) {
            BiodataSpk::create([
                'id_user' => $id,
                'pekerjaan_ortu' => $request->pekerjaan_ortu,
                'detail_pekerjaan' => $request->detail_pekerjaan,
                'gaji_ortu' => $request->gaji_ortu,
                'luas_tanah' => $request->luas_tanah,
                'jml_kmr' => $request->jml_kmr,
                'jml_kmr_mandi' => $request->jml_kmr_mandi,
                'tagihan_listrik' => $request->tagihan_listrik,
                'pbb' => $request->pbb,
                'jml_hutang' => $request->jml_hutang,
                'jml_sdr' => $request->jml_sdr,
                'status_ortu' => $request->status_ortu,
            ]);
        } else {
            $iduser->update([
                'id_user' => $id,
                'pekerjaan_ortu' => $request->pekerjaan_ortu,
                'detail_pekerjaan' => $request->detail_pekerjaan,
                'gaji_ortu' => $request->gaji_ortu,
                'luas_tanah' => $request->luas_tanah,
                'jml_kmr' => $request->jml_kmr,
                'jml_kmr_mandi' => $request->jml_kmr_mandi,
                'tagihan_listrik' => $request->tagihan_listrik,
                'pbb' => $request->pbb,
                'jml_hutang' => $request->jml_hutang,
                'jml_sdr' => $request->jml_sdr,
                'status_ortu' => $request->status_ortu,
            ]);
        }

        return redirect()->route('biodata.index')->with('success', 'success-biodata-spk');
    }

    public function create()
    {

    }

    public function store(StoreBiodataSpkRequest $request)
    {

    }

    public function show(BiodataSpk $biodataSpk)
    {

    }

    public function edit(BiodataSpk $biodataSpk)
    {

    }

    public function update(UpdateBiodataSpkRequest $request, BiodataSpk $biodataSpk)
    {

    }

    public function destroy(BiodataSpk $biodataSpk)
    {

    }
}
