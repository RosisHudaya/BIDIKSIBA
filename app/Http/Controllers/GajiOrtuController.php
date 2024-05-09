<?php

namespace App\Http\Controllers;

use App\Models\GajiOrtu;
use App\Http\Requests\StoreGajiOrtuRequest;
use App\Http\Requests\UpdateGajiOrtuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GajiOrtuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:penghasilan-ortu.index')->only('index');
        $this->middleware('permission:penghasilan-ortu.edit')->only('edit', 'update');
    }

    public function index()
    {
        $gaji_ortus = DB::table('gaji_ortus')
            ->paginate(10);

        return view('kriteria-pendaftar.penghasilan-ortu.index', compact('gaji_ortus'));
    }

    public function create()
    {
        //
    }

    public function store(StoreGajiOrtuRequest $request)
    {
        //
    }

    public function show(GajiOrtu $gajiOrtu)
    {
        //
    }

    public function edit(GajiOrtu $penghasilanOrtu)
    {
        return view('kriteria-pendaftar.penghasilan-ortu.edit', compact('penghasilanOrtu'));
    }

    public function update(UpdateGajiOrtuRequest $request, GajiOrtu $penghasilanOrtu)
    {
        $penghasilanOrtu->update($request->all());

        return redirect()->route('penghasilan-ortu.index')->with('success', 'Data penghasilan orang tua berhasil diperbarui');
    }

    public function destroy(GajiOrtu $gajiOrtu)
    {
        //
    }
}
