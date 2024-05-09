<?php

namespace App\Http\Controllers;

use App\Models\StatusOrtu;
use App\Http\Requests\StoreStatusOrtuRequest;
use App\Http\Requests\UpdateStatusOrtuRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatusOrtuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:status-ortu.index')->only('index');
        $this->middleware('permission:status-ortu.edit')->only('edit', 'update');
    }

    public function index()
    {
        $status_ortus = DB::table('status_ortus')
            ->paginate(10);

        return view('kriteria-pendaftar.status-ortu.index', compact('status_ortus'));
    }

    public function create()
    {
        //
    }

    public function store(StoreStatusOrtuRequest $request)
    {
        //
    }

    public function show(StatusOrtu $statusOrtu)
    {
        //
    }

    public function edit(StatusOrtu $statusOrtu)
    {
        return view('kriteria-pendaftar.status-ortu.edit', compact('statusOrtu'));
    }

    public function update(UpdateStatusOrtuRequest $request, StatusOrtu $statusOrtu)
    {
        $statusOrtu->update($request->all());

        return redirect()->route('status-ortu.index')->with('success', 'Data status orang tua berhasil diperbarui');
    }

    public function destroy(StatusOrtu $statusOrtu)
    {
        //
    }
}
