<?php

namespace App\Http\Controllers;

use App\Exports\RankingEkoExport;
use App\Exports\RankingSpkExport;
use App\Models\DataSpk;
use App\Http\Requests\StoreDataSpkRequest;
use App\Http\Requests\UpdateDataSpkRequest;
use App\Services\SpkService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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

    public function index(Request $request)
    {
        $getRankedAlternativeSpk = $this->spkService->getRankedAlternativeSpk($request);

        return view('hasil-ranking.data-spk.index', [
            'results' => $getRankedAlternativeSpk,
        ]);
    }

    public function indexEko(Request $request)
    {
        $getRankedAlternative = $this->spkService->getRankedAlternative($request);

        return view('hasil-ranking.data-ekonomi.index', [
            'results' => $getRankedAlternative,
        ]);
    }

    public function export_alternative(Request $request)
    {
        $query = $this->spkService->getRankedAlternativeExport($request);

        $filename = 'ranking spk.xlsx';

        return Excel::download(new RankingEkoExport($query), $filename);
    }

    public function export_spk(Request $request)
    {
        $query = $this->spkService->getRankedAlternativeSpkExport($request);

        $filename = 'ranking bidiksiba.xlsx';

        return Excel::download(new RankingSpkExport($query), $filename);
    }
}
