<?php

namespace App\Http\Controllers;

use App\Exports\RankingEkoExport;
use App\Exports\RankingSpkExport;
use App\Models\DataSpk;
use App\Http\Requests\StoreDataSpkRequest;
use App\Http\Requests\UpdateDataSpkRequest;
use App\Services\SpkService;
use Maatwebsite\Excel\Facades\Excel;

class DataSpkController extends Controller
{
    protected $spkService;

    public function __construct(SpkService $spkService)
    {
        $this->spkService = $spkService;
        $this->middleware('auth');
        $this->middleware('permission:data-ekonomi.index')->only('indexEko');
        $this->middleware('permission:data-ekonomi.export.alternative')->only('export_alternative');
        $this->middleware('permission:data-spk.index')->only('index');
        $this->middleware('permission:data-spk.export.hasil-spk')->only('export_spk');
    }

    public function index()
    {
        $getRankedAlternativeSpk = $this->spkService->getRankedAlternativeSpk();

        return view('hasil-ranking.data-spk.index', [
            'results' => $getRankedAlternativeSpk,
        ]);
    }

    public function indexEko()
    {
        $getRankedAlternative = $this->spkService->getRankedAlternative();

        return view('hasil-ranking.data-ekonomi.index', [
            'results' => $getRankedAlternative,
        ]);
    }

    public function export_alternative()
    {
        $query = $this->spkService->getRankedAlternativeExport();

        $filename = 'ranking spk.xlsx';

        return Excel::download(new RankingEkoExport($query), $filename);
    }

    public function export_spk()
    {
        $query = $this->spkService->getRankedAlternativeSpkExport();

        $filename = 'ranking bidiksiba.xlsx';

        return Excel::download(new RankingSpkExport($query), $filename);
    }
}
