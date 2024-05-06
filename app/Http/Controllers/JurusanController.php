<?php

namespace App\Http\Controllers;

use App\Models\AsalJurusan;
use App\Models\Jurusan;
use App\Http\Requests\StoreJurusanRequest;
use App\Http\Requests\UpdateJurusanRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:jurusan.index')->only('index');
        $this->middleware('permission:jurusan.create')->only('create', 'store');
        $this->middleware('permission:jurusan.edit')->only('edit', 'update');
        $this->middleware('permission:jurusan.destroy')->only('destroy');
    }

    public function index(Request $request)
    {
        $asal_jurusans = AsalJurusan::all();
        $asalJurusanSelected = $request->input('asal_jurusan');
        $jurusans = DB::table('jurusans as j')
            ->join('asal_jurusan_pivots as jp', 'j.id', '=', 'jp.id_jurusan')
            ->join('asal_jurusans as aj', 'jp.id_asal_jurusan', '=', 'aj.id')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('j.jurusan', 'like', '%' . $name . '%');
            })
            ->when($asalJurusanSelected, function ($query, $name) {
                return $query->where('jp.id_asal_jurusan', 'like', '%' . $name . '%');
            })
            ->select(
                'j.id',
                'j.jurusan',
                DB::raw("GROUP_CONCAT(aj.asal_jurusan SEPARATOR ', ') as asal"),
            )
            ->groupBy('j.id', 'j.jurusan')
            ->paginate(10);
        return view('jurusan.index', compact('jurusans', 'asal_jurusans', 'asalJurusanSelected'));
    }

    public function create()
    {
        $asal_jurusans = AsalJurusan::all();

        return view('jurusan.create', [
            'asal_jurusans' => $asal_jurusans,
        ])->with(['asal_jurusans' => $asal_jurusans]);
    }

    public function store(StoreJurusanRequest $request)
    {
        $jurusan = Jurusan::create([
            'jurusan' => $request->jurusan,
        ]);

        $jurusan->asal_jurusan()->attach($request->id_asal_jurusan);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan baru berhasil ditambahkan');
    }

    public function show(Jurusan $jurusan)
    {
        //
    }

    public function edit(Jurusan $jurusan)
    {
        $asal_jurusans = AsalJurusan::all();

        return view('jurusan.edit', [
            'jurusan' => $jurusan,
            'asal_jurusans' => $asal_jurusans,
        ])->with(['asal_jurusans' => $asal_jurusans]);
    }

    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update($request->all());

        $jurusan->asal_jurusan()->sync($request->id_asal_jurusan);

        return redirect()->route('jurusan.index')
            ->with('success', 'Data jurusan berhasil diperbarui');
    }

    public function destroy(Jurusan $jurusan)
    {
        try {
            $jurusan->delete();
            return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('jurusan.index')
                    ->with('error', 'Data jurusan digunakan pada tabel lain');
            } else {
                return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus');
            }
        }
    }
}
