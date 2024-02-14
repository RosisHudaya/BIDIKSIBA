<?php

namespace App\Http\Controllers;

use App\Models\SesiUjian;
use App\Http\Requests\StoreSesiUjianRequest;
use App\Http\Requests\UpdateSesiUjianRequest;
use App\Models\Ujian;
use Illuminate\Support\Facades\DB;

class SesiUjianController extends Controller
{
    public function index()
    {
        $sesiUjians = DB::table('sesi_ujians as su')
            ->leftJoin('ujians as u', 'su.id_ujian', '=', 'u.id')
            ->select(
                'su.*',
                'u.nama_ujian',
            )
            ->paginate(10);
        return view('sesi-ujian.index', compact('sesiUjians'));
    }

    public function create()
    {
        $ujians = Ujian::all();

        return view('sesi-ujian.create')->with(['ujians' => $ujians]);
    }

    public function store(StoreSesiUjianRequest $request)
    {
        SesiUjian::create([
            'id_ujian' => $request->id_ujian,
            'nama_sesi' => $request->nama_sesi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
        ]);

        return redirect()->route('sesi-ujian.index')
            ->with('success', 'Sesi ujian baru berhasil ditambahkan');
    }

    public function show(SesiUjian $sesiUjian)
    {
        //
    }

    public function edit(SesiUjian $sesiUjian)
    {
        $ujians = Ujian::all();
        return view('sesi-ujian.edit')->with([
            'ujians' => $ujians,
            'sesiUjian' => $sesiUjian,
        ]);
    }

    public function update(UpdateSesiUjianRequest $request, SesiUjian $sesiUjian)
    {
        $sesiUjian->update($request->all());

        return redirect()->route('sesi-ujian.index')
            ->with('success', 'Data sesi ujian berhasil diperbarui');
    }

    public function destroy(SesiUjian $sesiUjian)
    {
        try {
            $sesiUjian->delete();
            return redirect()->route('sesi-ujian.index')->with('success', 'Data sesi ujian berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('sesi-ujian.index')
                    ->with('error', 'Data sesi ujian digunakan pada tabel lain');
            } else {
                return redirect()->route('sesi-ujian.index')->with('success', 'Data sesi ujian berhasil dihapus');
            }
        }
    }
}
