<?php

namespace App\Http\Controllers;

use App\Models\JumlahKamar;
use App\Http\Requests\StoreJumlahKamarRequest;
use App\Http\Requests\UpdateJumlahKamarRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JumlahKamarController extends Controller
{
    public function index()
    {
        $kamars = DB::table('jumlah_kamars')
            ->paginate(10);

        return view('kriteria-ekonomi.kamar.index', compact('kamars'));
    }

    public function create()
    {
        //
    }

    public function store(StoreJumlahKamarRequest $request)
    {
        //
    }

    public function show(JumlahKamar $jumlahKamar)
    {
        //
    }

    public function edit(JumlahKamar $jumlahKamar)
    {
        //
    }

    public function update(UpdateJumlahKamarRequest $request, JumlahKamar $jumlahKamar)
    {
        //
    }

    public function destroy(JumlahKamar $jumlahKamar)
    {
        //
    }
}
