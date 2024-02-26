<?php

namespace App\Http\Controllers;

use App\Exports\LaporanNilaiExport;
use App\Models\SesiUjian;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanNilaiController extends Controller
{
    public function index(Request $request)
    {
        $ujians = Ujian::all();
        $sesiUjians = SesiUjian::all();
        $ujianSelected = $request->input('ujian');
        $sesiSelected = $request->input('sesi');
        $nilais = DB::table('nilai_ujians as nu')
            ->leftJoin('sesi_ujians as su', 'nu.id_sesi', '=', 'su.id')
            ->leftJoin('ujians as uj', 'su.id_ujian', '=', 'uj.id')
            ->leftJoin('users as u', 'nu.id_user', '=', 'u.id')
            ->leftJoin('biodatas as b', 'u.id', '=', 'b.id_user')
            ->when($ujianSelected, function ($query, $ujian) {
                return $query->where('uj.id', '=', $ujian);
            })
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('b.nama', 'like', '%' . $name . '%');
            })
            ->when($sesiSelected, function ($query, $sesi) {
                return $query->where('su.id', '=', $sesi);
            })
            ->select(
                'su.nama_sesi',
                'b.nama',
                'uj.nama_ujian',
                'nu.nilai',
            )
            ->orderBy('uj.nama_ujian', 'asc')
            ->paginate(10);
        return view(
            'laporan-nilai.index',
            compact(
                'nilais',
                'ujians',
                'ujianSelected',
                'sesiUjians',
                'sesiSelected',
            )
        );
    }

    public function export(Request $request)
    {
        $ujianSelected = $request->input('ujian');
        $sesiSelected = $request->input('sesi');

        $query = DB::table('nilai_ujians as nu')
            ->leftJoin('sesi_ujians as su', 'nu.id_sesi', '=', 'su.id')
            ->leftJoin('ujians as uj', 'su.id_ujian', '=', 'uj.id')
            ->leftJoin('users as u', 'nu.id_user', '=', 'u.id')
            ->leftJoin('biodatas as b', 'u.id', '=', 'b.id_user')
            ->when($ujianSelected, function ($query, $ujian) {
                return $query->where('uj.id', '=', $ujian);
            })
            ->when($sesiSelected, function ($query, $sesi) {
                return $query->where('su.id', '=', $sesi);
            })
            ->select(
                'su.nama_sesi',
                'b.nama',
                'uj.nama_ujian',
                'nu.nilai',
            )
            ->orderBy('uj.nama_ujian', 'asc');

        $filename = 'laporan-nilai.xlsx';

        return Excel::download(new LaporanNilaiExport($query), $filename);
    }
}
