<?php

namespace App\Http\Controllers;

use App\Exports\LaporanNilaiExport;
use App\Models\NilaiUjian;
use App\Models\SesiUjian;
use App\Models\SesiUser;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanNilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:laporan-nilai.index')->only('index');
        $this->middleware('permission:laporan-nilai.export')->only('export');
        $this->middleware('permission:list-nilai.show')->only('show');
    }

    public function index(Request $request)
    {
        $ujians = Ujian::all();
        $ujianSelected = $request->input('ujian');
        $nilais = DB::table('sesi_ujians as su')
            ->leftJoin('ujians as uj', 'su.id_ujian', '=', 'uj.id')
            ->when($ujianSelected, function ($query, $ujian) {
                return $query->where('uj.id', '=', $ujian);
            })
            ->select(
                'su.id',
                'su.nama_sesi',
                'uj.nama_ujian',
            )
            ->orderBy('uj.created_at', 'asc')
            ->paginate(10);
        return view(
            'laporan-nilai.index',
            compact(
                'nilais',
                'ujians',
                'ujianSelected',
            )
        );
    }

    public function show(SesiUser $sesiUser, Request $request)
    {
        $ujian = DB::table('sesi_ujians as su')
            ->leftJoin('ujians as u', 'su.id_ujian', '=', 'u.id')
            ->select(
                'su.id',
                'u.nama_ujian',
                'su.nama_sesi',
                'su.waktu_mulai',
                'su.waktu_akhir',
            )
            ->where('su.id', $sesiUser->id)
            ->first();
        $nilai_ujians = DB::table('sesi_users as su')
            ->leftJoin('nilai_ujians as nj', function ($join) {
                $join->on('su.id_user', '=', 'nj.id_user')
                    ->on('su.id_sesi', '=', 'nj.id_sesi');
            })
            ->leftJoin('users as u', 'su.id_user', '=', 'u.id')
            ->leftJoin('biodatas as b', 'u.id', '=', 'b.id_user')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('b.nama', 'like', '%' . $name . '%');
            })
            ->select(
                'b.nama',
                'nj.nilai',
                'su.status'
            )
            ->where('su.id_sesi', $sesiUser->id)
            ->orderBy('b.nama')
            ->paginate(25);
        return view('laporan-nilai.detail')->with([
            'ujian' => $ujian,
            'nilai_ujians' => $nilai_ujians,
        ]);
    }

    public function export(SesiUser $sesiUser)
    {
        $query = DB::table('sesi_users as su')
            ->leftJoin('nilai_ujians as nu', function ($join) {
                $join->on('su.id_user', '=', 'nu.id_user')
                    ->on('su.id_sesi', '=', 'nu.id_sesi');
            })
            ->leftJoin('sesi_ujians as suj', 'su.id_sesi', '=', 'suj.id')
            ->leftJoin('ujians as uj', 'suj.id_ujian', '=', 'uj.id')
            ->leftJoin('users as u', 'su.id_user', '=', 'u.id')
            ->leftJoin('biodatas as b', 'u.id', '=', 'b.id_user')
            ->select(
                'suj.nama_sesi',
                'b.nama',
                'uj.nama_ujian',
                DB::raw("IFNULL(nu.nilai, '-') as nilai"),
                'su.status'
            )
            ->where('su.id_sesi', $sesiUser->id)
            ->orderBy('b.nama');

        $filename = 'laporan-nilai.xlsx';

        return Excel::download(new LaporanNilaiExport($query), $filename);
    }
}
