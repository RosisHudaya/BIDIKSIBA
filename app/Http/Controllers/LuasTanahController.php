<?php

namespace App\Http\Controllers;

use App\Models\LuasTanah;
use App\Http\Requests\StoreLuasTanahRequest;
use App\Http\Requests\UpdateLuasTanahRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LuasTanahController extends Controller
{
    public function index()
    {
        $luas_tanahs = DB::table('luas_tanahs')
            ->paginate(10);

        return view('kriteria-ekonomi.luas-tanah.index', compact('luas_tanahs'));
    }

    public function create()
    {
        //
    }

    public function store(StoreLuasTanahRequest $request)
    {
        //
    }

    public function show(LuasTanah $luasTanah)
    {
        //
    }

    public function edit(LuasTanah $luasTanah)
    {
        //
    }

    public function update(UpdateLuasTanahRequest $request, LuasTanah $luasTanah)
    {
        //
    }

    public function destroy(LuasTanah $luasTanah)
    {
        //
    }
}
