<?php

namespace App\Http\Controllers;

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
        $jurusans = DB::table('jurusans')
            ->paginate(10);
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(StoreJurusanRequest $request)
    {
        Jurusan::create([
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan baru berhasil ditambahkan');
    }

    public function show(Jurusan $jurusan)
    {
        //
    }

    public function edit(Jurusan $jurusan)
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $request->validate([
            'jurusan' => 'required|unique:jurusans,jurusan,' . $jurusan->id,
        ]);

        $jurusan->update($request->all());

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
