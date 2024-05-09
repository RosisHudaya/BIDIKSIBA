<?php

namespace App\Http\Controllers;

use App\Models\Saudara;
use App\Http\Requests\StoreSaudaraRequest;
use App\Http\Requests\UpdateSaudaraRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaudaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:saudara.index')->only('index');
        $this->middleware('permission:saudara.edit')->only('edit', 'update');
    }

    public function index()
    {
        $saudaras = DB::table('saudaras')
            ->paginate(10);

        return view('kriteria-pendaftar.saudara.index', compact('saudaras'));
    }

    public function create()
    {
        //
    }

    public function store(StoreSaudaraRequest $request)
    {
        //
    }

    public function show(Saudara $saudara)
    {
        //
    }

    public function edit(Saudara $saudara)
    {
        return view('kriteria-pendaftar.saudara.edit', compact('saudara'));
    }

    public function update(UpdateSaudaraRequest $request, Saudara $saudara)
    {
        $saudara->update($request->all());

        return redirect()->route('saudara.index')->with('success', 'Data saudara berhasil diperbarui');
    }

    public function destroy(Saudara $saudara)
    {
        //
    }
}
