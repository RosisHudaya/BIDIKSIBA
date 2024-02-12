<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Http\Requests\StoreUjianRequest;
use App\Http\Requests\UpdateUjianRequest;

class UjianController extends Controller
{
    public function index()
    {
        return view('ujian.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreUjianRequest $request)
    {
        //
    }

    public function show(Ujian $ujian)
    {
        //
    }

    public function edit(Ujian $ujian)
    {
        //
    }

    public function update(UpdateUjianRequest $request, Ujian $ujian)
    {
        //
    }

    public function destroy(Ujian $ujian)
    {
        //
    }
}
