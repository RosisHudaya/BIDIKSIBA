<?php

namespace App\Http\Controllers;

use App\Models\KamarMandi;
use App\Http\Requests\StoreKamarMandiRequest;
use App\Http\Requests\UpdateKamarMandiRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KamarMandiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:kamar-mandi.index')->only('index');
    }

    public function index()
    {
        $kamar_mandis = DB::table('kamar_mandis')
            ->paginate(10);

        return view('kriteria-ekonomi.kamar-mandi.index', compact('kamar_mandis'));
    }

    public function create()
    {
        //
    }

    public function store(StoreKamarMandiRequest $request)
    {
        //
    }

    public function show(KamarMandi $kamarMandi)
    {
        //
    }

    public function edit(KamarMandi $kamarMandi)
    {
        //
    }

    public function update(UpdateKamarMandiRequest $request, KamarMandi $kamarMandi)
    {
        //
    }

    public function destroy(KamarMandi $kamarMandi)
    {
        //
    }
}
