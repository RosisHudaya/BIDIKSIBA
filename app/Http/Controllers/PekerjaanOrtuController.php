<?php

namespace App\Http\Controllers;

use App\Models\PekerjaanOrtu;
use App\Http\Requests\StorePekerjaanOrtuRequest;
use App\Http\Requests\UpdatePekerjaanOrtuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PekerjaanOrtuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:pekerjaan-ortu.index')->only('index');
    }

    public function index()
    {
        $pekerjaan_ortus = DB::table('pekerjaan_ortus')
            ->paginate(10);

        return view('kriteria-pendaftar.pekerjaan-ortu.index', compact('pekerjaan_ortus'));
    }

    public function create()
    {
        //
    }

    public function store(StorePekerjaanOrtuRequest $request)
    {
        //
    }

    public function show(PekerjaanOrtu $pekerjaanOrtu)
    {
        //
    }

    public function edit(PekerjaanOrtu $pekerjaanOrtu)
    {
        //
    }

    public function update(UpdatePekerjaanOrtuRequest $request, PekerjaanOrtu $pekerjaanOrtu)
    {
        //
    }

    public function destroy(PekerjaanOrtu $pekerjaanOrtu)
    {
        //
    }
}
