<?php

namespace App\Http\Controllers;

use App\Models\DataSpk;
use App\Http\Requests\StoreDataSpkRequest;
use App\Http\Requests\UpdateDataSpkRequest;

class DataSpkController extends Controller
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
     * @param  \App\Http\Requests\StoreDataSpkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataSpkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DataSpk  $dataSpk
     * @return \Illuminate\Http\Response
     */
    public function show(DataSpk $dataSpk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DataSpk  $dataSpk
     * @return \Illuminate\Http\Response
     */
    public function edit(DataSpk $dataSpk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataSpkRequest  $request
     * @param  \App\Models\DataSpk  $dataSpk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataSpkRequest $request, DataSpk $dataSpk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DataSpk  $dataSpk
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataSpk $dataSpk)
    {
        //
    }
}
