<?php

namespace App\Http\Controllers;

use App\Models\GajiOrtu;
use App\Http\Requests\StoreGajiOrtuRequest;
use App\Http\Requests\UpdateGajiOrtuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GajiOrtuController extends Controller
{
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

    public function edit(GajiOrtu $gajiOrtu)
    {
        //
    }

    public function update(UpdateGajiOrtuRequest $request, GajiOrtu $gajiOrtu)
    {
        //
    }

    public function destroy(GajiOrtu $gajiOrtu)
    {
        //
    }
}
