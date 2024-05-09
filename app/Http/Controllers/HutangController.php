<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Http\Requests\StoreHutangRequest;
use App\Http\Requests\UpdateHutangRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:hutang.index')->only('index');
        $this->middleware('permission:hutang.edit')->only('edit', 'update');
    }

    public function index()
    {
        $hutangs = DB::table('hutangs')
            ->paginate(10);

        return view('kriteria-ekonomi.hutang.index', compact('hutangs'));
    }

    public function create()
    {
        //
    }

    public function store(StoreHutangRequest $request)
    {
        //
    }

    public function show(Hutang $hutang)
    {
        //
    }

    public function edit(Hutang $hutang)
    {
        return view('kriteria-ekonomi.hutang.edit', compact('hutang'));
    }

    public function update(UpdateHutangRequest $request, Hutang $hutang)
    {
        $hutang->update($request->all());

        return redirect()->route('hutang.index')->with('success', 'Data hutang berhasil diperbarui');
    }

    public function destroy(Hutang $hutang)
    {
        //
    }
}
