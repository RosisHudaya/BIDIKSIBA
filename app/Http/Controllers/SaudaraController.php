<?php

namespace App\Http\Controllers;

use App\Models\Saudara;
use App\Http\Requests\StoreSaudaraRequest;
use App\Http\Requests\UpdateSaudaraRequest;

class SaudaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaudaraRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaudaraRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saudara  $saudara
     * @return \Illuminate\Http\Response
     */
    public function show(Saudara $saudara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saudara  $saudara
     * @return \Illuminate\Http\Response
     */
    public function edit(Saudara $saudara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaudaraRequest  $request
     * @param  \App\Models\Saudara  $saudara
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaudaraRequest $request, Saudara $saudara)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saudara  $saudara
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saudara $saudara)
    {
        //
    }
}
