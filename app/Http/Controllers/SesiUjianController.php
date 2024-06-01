<?php

namespace App\Http\Controllers;

use App\Models\SesiUjian;
use App\Http\Requests\StoreSesiUjianRequest;
use App\Http\Requests\UpdateSesiUjianRequest;
use App\Models\Ujian;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SesiUjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:sesi-ujian.index')->only('index');
        $this->middleware('permission:sesi-ujian.create')->only('create', 'store');
        $this->middleware('permission:sesi-ujian.edit')->only('edit', 'update');
        $this->middleware('permission:sesi-ujian.destroy')->only('destroy');
        $this->middleware('permission:sesi-ujian.sesiUjian')->only('sesi_user');
    }

    public function index(Request $request)
    {
        setlocale(LC_ALL, 'IND');

        $sesiUjians = DB::table('sesi_ujians as su')
            ->leftJoin('ujians as u', 'su.id_ujian', '=', 'u.id')
            ->leftJoin('sesi_users as sj', 'su.id', '=', 'sj.id_sesi')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('su.nama_sesi', 'like', '%' . $name . '%');
            })
            ->select(
                'su.id',
                'su.nama_sesi',
                'su.waktu_mulai',
                'su.waktu_akhir',
                'u.nama_ujian',
                DB::raw('COUNT(sj.id) as jumlah_peserta')
            )
            ->groupBy(
                'su.id',
                'su.nama_sesi',
                'su.waktu_mulai',
                'su.waktu_akhir',
                'u.nama_ujian',
            )
            ->paginate(10);
        return view('sesi-ujian.index', compact('sesiUjians'));
    }

    public function create()
    {
        $ujians = Ujian::all();

        return view('sesi-ujian.create')->with(['ujians' => $ujians]);
    }

    public function store(StoreSesiUjianRequest $request)
    {
        SesiUjian::create([
            'id_ujian' => $request->id_ujian,
            'nama_sesi' => $request->nama_sesi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
        ]);

        return redirect()->route('sesi-ujian.index')
            ->with('success', 'Sesi ujian baru berhasil ditambahkan');
    }

    public function show(SesiUjian $sesiUjian)
    {
        //
    }

    public function edit(SesiUjian $sesiUjian)
    {
        $ujians = Ujian::all();
        return view('sesi-ujian.edit')->with([
            'ujians' => $ujians,
            'sesiUjian' => $sesiUjian,
        ]);
    }

    public function update(UpdateSesiUjianRequest $request, SesiUjian $sesiUjian)
    {
        $sesiUjian->update($request->all());

        return redirect()->route('sesi-ujian.index')
            ->with('success', 'Data sesi ujian berhasil diperbarui');
    }

    public function destroy(SesiUjian $sesiUjian)
    {
        try {
            $sesiUjian->delete();
            return redirect()->route('sesi-ujian.index')->with('success', 'Data sesi ujian berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('sesi-ujian.index')
                    ->with('error', 'Data sesi ujian digunakan pada tabel lain');
            } else {
                return redirect()->route('sesi-ujian.index')->with('success', 'Data sesi ujian berhasil dihapus');
            }
        }
    }

    public function sesi_user(Request $request, SesiUjian $sesiUjian)
    {
        setlocale(LC_ALL, 'IND');

        $ujian = DB::table('sesi_ujians as su')
            ->leftJoin('ujians as u', 'su.id_ujian', '=', 'u.id')
            ->select(
                'u.nama_ujian'
            )
            ->where('su.id', '=', $sesiUjian->id)
            ->first();
        $sesi_users = DB::table('sesi_users as su')
            ->leftJoin('users as u', 'su.id_user', '=', 'u.id')
            ->leftJoin('biodatas as b', 'u.id', '=', 'b.id_user')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('b.nama', 'like', '%' . $name . '%');
            })
            ->select(
                'su.id',
                'b.nama',
                'b.gender',
                DB::raw('COUNT(*) as jumlah_peserta')
            )
            ->where('su.id_sesi', $sesiUjian->id)
            ->groupBy(
                'su.id',
                'b.nama',
                'b.gender',
            )
            ->orderBy('b.nama', 'asc')
            ->paginate(25);
        $jumlah_peserta_ujian = $sesi_users->total();
        return view('sesi-user.index')->with([
            'ujian' => $ujian,
            'sesi_users' => $sesi_users,
            'sesi_ujian' => $sesiUjian,
            'jumlah_peserta_ujian' => $jumlah_peserta_ujian,
        ]);
    }
}
