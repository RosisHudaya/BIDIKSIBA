<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Http\Requests\StoreHutangRequest;
use App\Http\Requests\UpdateHutangRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HutangController extends Controller
{
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
        //
    }

    public function update(UpdateHutangRequest $request, Hutang $hutang)
    {
        //
    }

    public function destroy(Hutang $hutang)
    {
        //
    }
}
