<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Prodi;
use App\Http\Requests\StoreProdiRequest;
use App\Http\Requests\UpdateProdiRequest;

class ProdiController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        $query = Prodi::select('prodis.id', 'prodis.id_jurusan', 'prodis.prodi', 'jurusans.jurusan')
            ->join('jurusans', 'prodis.id_jurusan', '=', 'jurusans.id')
            ->orderBy('jurusans.jurusan', 'asc')
            ->paginate(10);
        return view('prodi.index')->with([
            'prodis' => $query,
        ]);
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        return view('prodi.create')->with(['jurusans' => $jurusans]);
    }

    public function store(StoreProdiRequest $request)
    {
        Prodi::create([
            'id_jurusan' => $request->id_jurusan,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('program-studi.index')
            ->with('success', 'Program studi berhasil ditambahkan');
    }

    public function show(Prodi $prodi)
    {
        //
    }

    public function edit(Prodi $program_studi)
    {
        $jurusans = Jurusan::all();
        return view('prodi.edit')->with([
            'jurusans' => $jurusans,
            'prodi' => $program_studi,
        ]);
    }

    public function update(UpdateProdiRequest $request, Prodi $program_studi)
    {
        $program_studi->update($request->all());

        return redirect()->route('program-studi.index')->with('success', 'Data program studi berhasil diperbarui');
    }

    public function destroy(Prodi $program_studi)
    {
        try {
            $program_studi->delete();
            return redirect()->route('program-studi.index')->with('success', 'Data program studi berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('program-studi.index')
                    ->with('error', 'Data Program studi digunakan pada tabel lain');
            } else {
                return redirect()->route('program-studi.index')->with('success', 'Data program studi berhasil dihapus');
            }
        }
    }
}
