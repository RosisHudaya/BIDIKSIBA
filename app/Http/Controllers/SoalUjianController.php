<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSoalUjianRequest;
use App\Imports\SoalUjianImport;
use App\Models\SoalUjian;
use App\Http\Requests\StoreSoalUjianRequest;
use App\Http\Requests\UpdateSoalUjianRequest;
use App\Models\Ujian;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SoalUjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:soal-ujian.create')->only('create', 'store');
        $this->middleware('permission:soal-ujian.edit')->only('edit', 'update');
        $this->middleware('permission:soal-ujian.destroy')->only('destroy');
        $this->middleware('permission:soal-ujian.destroyAll')->only('destroy_all');
        $this->middleware('permission:soal-ujian.import')->only('import');
    }

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
            'gambar' => $request->gambar,
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

    public function edit(SoalUjian $soalUjian, Ujian $ujian)
    {
        return view('soal-ujian.edit', compact('soalUjian', 'ujian'));
    }

    public function update(UpdateSoalUjianRequest $request, SoalUjian $soalUjian, Ujian $ujian)
    {
        $soalUjian->update($request->all());

        return redirect()->route('soalUjian', ['ujian' => $ujian->id])->with('success', 'Soal ujian berhasil diperbarui');
    }

    public function destroy(SoalUjian $soalUjian, Ujian $ujian)
    {
        $soalUjian->delete();
        return redirect()->route('soalUjian', ['ujian' => $ujian->id])->with('success', 'Soal ujian berhasil dihapus');
    }

    public function destroy_all(Ujian $ujian)
    {
        SoalUjian::where('id_ujian', $ujian->id)->delete();
        return redirect()->route('soalUjian', ['ujian' => $ujian->id])->with('success', 'Semua soal ujian berhasil dihapus');
    }

    public function import(ImportSoalUjianRequest $request, Ujian $ujian)
    {
        try {
            $file = $request->file('import-file');
            Excel::import(new SoalUjianImport, $file);
            return redirect()->route('soalUjian', ['ujian' => $ujian->id])->with('success', 'File soal ujian berhasil diimport');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
