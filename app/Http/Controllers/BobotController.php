<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Http\Requests\StoreBobotRequest;
use App\Http\Requests\UpdateBobotRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:bobot-kriteria.index')->only('index');
        $this->middleware('permission:bobot-kriteria.edit')->only('edit', 'update');
    }

    public function index()
    {
        $bobots = DB::table('bobots')
            ->paginate(10);

        return view('hasil-ranking.bobot-kriteria.index', compact('bobots'));
    }

    public function create()
    {
        //
    }

    public function store(StoreBobotRequest $request)
    {
        //
    }

    public function show(Bobot $bobot)
    {
        //
    }

    public function edit(Bobot $bobot_kriterium)
    {
        return view('hasil-ranking.bobot-kriteria.edit', compact('bobot_kriterium'));
    }

    public function update(UpdateBobotRequest $request, Bobot $bobot_kriterium)
    {
        $bobot_kriterium->update($request->all());

        return redirect()->route('bobot-kriteria.index')->with('success', 'Data bobot berhasil diperbarui');
    }

    public function destroy(Bobot $bobot)
    {
        //
    }
}
