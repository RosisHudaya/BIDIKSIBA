<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use App\Http\Requests\StorePajakRequest;
use App\Http\Requests\UpdatePajakRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PajakController extends Controller
{
    public function index()
    {
        $pajaks = DB::table('pajaks')
            ->paginate(10);

        return view('kriteria-ekonomi.pajak.index', compact('pajaks'));
    }

    public function create()
    {
        //
    }

    public function store(StorePajakRequest $request)
    {
        //
    }

    public function show(Pajak $pajak)
    {
        //
    }

    public function edit(Pajak $pajak)
    {
        //
    }

    public function update(UpdatePajakRequest $request, Pajak $pajak)
    {
        //
    }

    public function destroy(Pajak $pajak)
    {
        //
    }
}
