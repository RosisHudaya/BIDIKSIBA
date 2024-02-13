<?php

namespace App\Http\Controllers;

use App\Models\SoalUjian;
use App\Http\Requests\StoreSoalUjianRequest;
use App\Http\Requests\UpdateSoalUjianRequest;
use App\Models\Ujian;
use Illuminate\Support\Facades\DB;

class SoalUjianController extends Controller
{
    public function index()
    {
    }

    public function create(Ujian $ujian)
    {
        return view('soal-ujian.create', compact('ujian'));
    }

    public function store(StoreSoalUjianRequest $request, Ujian $ujian)
    {
        SoalUjian::create([
            'id_ujian' => $ujian->id,
            'soal' => $request->soal,
            'jawaban_a' => $request->jawaban_a,
            'jawaban_b' => $request->jawaban_b,
            'jawaban_c' => $request->jawaban_c,
            'jawaban_d' => $request->jawaban_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('soalUjian', ['ujian' => $ujian->id])->with('success', 'Soal ujian berhasil ditambahkan');
    }

    public function show(SoalUjian $soalUjian)
    {
        //
    }

    public function edit(SoalUjian $soalUjian)
    {
        //
    }

    public function update(UpdateSoalUjianRequest $request, SoalUjian $soalUjian)
    {
        //
    }

    public function destroy(SoalUjian $soalUjian)
    {
        //
    }
}
