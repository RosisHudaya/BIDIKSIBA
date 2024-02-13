<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Http\Requests\StoreUjianRequest;
use App\Http\Requests\UpdateUjianRequest;
use Illuminate\Support\Facades\DB;


class UjianController extends Controller
{
    public function index()
    {
        $ujians = DB::table('ujians')
            ->paginate(10);
        return view('ujian.index', compact('ujians'));
    }

    public function create()
    {
        return view('ujian.create');
    }

    public function store(StoreUjianRequest $request)
    {
        Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('soal-ujian.index')->with('success', 'Ujian baru berhasil ditambahkan');
    }

    public function show(Ujian $ujian)
    {
        //
    }

    public function edit(Ujian $soal_ujian)
    {
        return view('ujian.edit', compact('soal_ujian'));
    }

    public function update(UpdateUjianRequest $request, Ujian $soal_ujian)
    {
        $soal_ujian->update($request->all());

        return redirect()->route('soal-ujian.index')->with('success', 'Data ujian berhasil diperbarui');
    }

    public function destroy(Ujian $soal_ujian)
    {
        $soal_ujian->delete();
        return redirect()->route('soal-ujian.index')->with('success', 'Data ujian berhasil dihapus');
    }
}
