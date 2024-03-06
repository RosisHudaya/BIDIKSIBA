<?php

namespace App\Http\Controllers;

use App\Models\Saudara;
use App\Http\Requests\StoreSaudaraRequest;
use App\Http\Requests\UpdateSaudaraRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaudaraController extends Controller
{
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
        //
    }

    public function update(UpdateSaudaraRequest $request, Saudara $saudara)
    {
        //
    }

    public function destroy(Saudara $saudara)
    {
        //
    }
}
