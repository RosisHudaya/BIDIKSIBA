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
        function processUrl($url)
        {
            $googleDriveFilePattern = '/https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view\?usp=sharing/';
            if (preg_match($googleDriveFilePattern, $url, $matches)) {
                $fileId = $matches[1];
                return "https://drive.google.com/thumbnail?id={$fileId}";
            }
            return $url;
        }

        $gambar = processUrl($request->gambar);
        $jawaban_a = processUrl($request->jawaban_a);
        $jawaban_b = processUrl($request->jawaban_b);
        $jawaban_c = processUrl($request->jawaban_c);
        $jawaban_d = processUrl($request->jawaban_d);

        SoalUjian::create([
            'id_ujian' => $ujian->id,
            'gambar' => $gambar,
            'soal' => $request->soal,
            'jawaban_a' => $jawaban_a,
            'jawaban_b' => $jawaban_b,
            'jawaban_c' => $jawaban_c,
            'jawaban_d' => $jawaban_d,
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
        function processUrl($url)
        {
            $googleDriveFilePattern = '/https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view\?usp=sharing/';
            if (preg_match($googleDriveFilePattern, $url, $matches)) {
                $fileId = $matches[1];
                return "https://drive.google.com/thumbnail?id={$fileId}";
            }
            return $url;
        }

        $gambar = processUrl($request->gambar);
        $jawaban_a = processUrl($request->jawaban_a);
        $jawaban_b = processUrl($request->jawaban_b);
        $jawaban_c = processUrl($request->jawaban_c);
        $jawaban_d = processUrl($request->jawaban_d);

        // $soalUjian->update($request->all());
        $soalUjian->update([
            'gambar' => $gambar,
            'soal' => $request->soal,
            'jawaban_a' => $jawaban_a,
            'jawaban_b' => $jawaban_b,
            'jawaban_c' => $jawaban_c,
            'jawaban_d' => $jawaban_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

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
