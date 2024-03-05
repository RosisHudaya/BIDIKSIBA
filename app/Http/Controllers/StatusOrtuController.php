<?php

namespace App\Http\Controllers;

use App\Models\StatusOrtu;
use App\Http\Requests\StoreStatusOrtuRequest;
use App\Http\Requests\UpdateStatusOrtuRequest;

class StatusOrtuController extends Controller
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
     * @param  \App\Http\Requests\StoreStatusOrtuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusOrtuRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusOrtu  $statusOrtu
     * @return \Illuminate\Http\Response
     */
    public function show(StatusOrtu $statusOrtu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusOrtu  $statusOrtu
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusOrtu $statusOrtu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatusOrtuRequest  $request
     * @param  \App\Models\StatusOrtu  $statusOrtu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusOrtuRequest $request, StatusOrtu $statusOrtu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusOrtu  $statusOrtu
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusOrtu $statusOrtu)
    {
        //
    }
}
