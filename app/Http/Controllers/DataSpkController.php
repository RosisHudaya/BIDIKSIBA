<?php

namespace App\Http\Controllers;

use App\Models\DataSpk;
use App\Http\Requests\StoreDataSpkRequest;
use App\Http\Requests\UpdateDataSpkRequest;
use App\Services\SpkService;

class DataSpkController extends Controller
{
    protected $spkService;

    public function __construct(SpkService $spkService)
    {
        $this->spkService = $spkService;
    }
    public function index()
    {
        $datas = $this->spkService->getValues();
        $bobots = $this->spkService->getWights();
        $getNormalizedValues = $this->spkService->getNormalizedValues();
        $getOptimizedValues = $this->spkService->getOptimizedValues();
        $getRankedAlternative = $this->spkService->getRankedAlternative();
        dd($getRankedAlternative);

        return view('hasil-ranking.data-spk.index');
    }

    public function create()
    {
        //
    }

    public function store(StoreDataSpkRequest $request)
    {
        //
    }

    public function show(DataSpk $dataSpk)
    {
        //
    }

    public function edit(DataSpk $dataSpk)
    {
        //
    }

    public function update(UpdateDataSpkRequest $request, DataSpk $dataSpk)
    {
        //
    }

    public function destroy(DataSpk $dataSpk)
    {
        //
    }
}
