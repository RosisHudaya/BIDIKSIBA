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
        //
    }

    public function update(UpdateTagihanListrikRequest $request, TagihanListrik $tagihanListrik)
    {
        //
    }

    public function destroy(TagihanListrik $tagihanListrik)
    {
        //
    }
}
