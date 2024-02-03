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
            ->paginate(10);
        return view('prodi.index')->with([
            'prodis' => $query,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(StoreProdiRequest $request)
    {
        //
    }

    public function show(Prodi $prodi)
    {
        //
    }

    public function edit(Prodi $prodi)
    {
        //
    }

    public function update(UpdateProdiRequest $request, Prodi $prodi)
    {
        //
    }

    public function destroy(Prodi $prodi)
    {
        //
    }
}
