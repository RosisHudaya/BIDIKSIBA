<?php

namespace App\Http\Controllers;

use App\Models\TagihanListrik;
use App\Http\Requests\StoreTagihanListrikRequest;
use App\Http\Requests\UpdateTagihanListrikRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TagihanListrikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:tagihan-listrik.index')->only('index');
        $this->middleware('permission:tagihan-listrik.edit')->only('edit', 'update');
    }

    public function index()
    {
        $tagihan_listriks = DB::table('tagihan_listriks')
            ->paginate(10);

        return view('kriteria-ekonomi.tagihan-listrik.index', compact('tagihan_listriks'));
    }

    public function create()
    {
        //
    }

    public function store(StoreTagihanListrikRequest $request)
    {
        //
    }

    public function show(TagihanListrik $tagihanListrik)
    {
        //
    }

    public function edit(TagihanListrik $tagihanListrik)
    {
        return view('kriteria-ekonomi.tagihan-listrik.edit', compact('tagihanListrik'));
    }

    public function update(UpdateTagihanListrikRequest $request, TagihanListrik $tagihanListrik)
    {
        $tagihanListrik->update($request->all());

        return redirect()->route('tagihan-listrik.index')->with('success', 'Data tagihan listrik berhasil diperbarui');
    }

    public function destroy(TagihanListrik $tagihanListrik)
    {
        //
    }
}
