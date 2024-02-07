<?php

namespace App\Http\Controllers;

use App\Models\AsalJurusan;
use App\Http\Requests\StoreAsalJurusanRequest;
use App\Http\Requests\UpdateAsalJurusanRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AsalJurusanController extends Controller
{
    public function index()
    {
        $asal_jurusans = DB::table('asal_jurusans')
            ->paginate(10);
        return view('asal-jurusan.index', compact('asal_jurusans'));
    }

    public function create()
    {
        return view('asal-jurusan.create');
    }

    public function store(StoreAsalJurusanRequest $request)
    {
        AsalJurusan::create([
            'asal_jurusan' => $request->asal_jurusan,
        ]);

        return redirect()->route('asal-jurusan.index')->with('success', 'Jurusan SMA/SMK baru berhasil ditambahkan');
    }

    public function show(AsalJurusan $asalJurusan)
    {
        //
    }

    public function edit(AsalJurusan $asalJurusan)
    {
        return view('asal-jurusan.edit', compact('asalJurusan'));
    }

    public function update(UpdateAsalJurusanRequest $request, AsalJurusan $asalJurusan)
    {
        $asalJurusan->update($request->all());

        return redirect()->route('asal-jurusan.index')
            ->with('success', 'Data jurusan SMA/SMK berhasil diperbarui');
    }

    public function destroy(AsalJurusan $asalJurusan)
    {
        try {
            $asalJurusan->delete();
            return redirect()->route('asal-jurusan.index')->with('success', 'Data jurusan SMA/SMK berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if ($error_code == 1451) {
                return redirect()->route('asal-jurusan.index')
                    ->with('error', 'Data jurusan SMA/SMK digunakan pada tabel lain');
            } else {
                return redirect()->route('asal-jurusan.index')->with('success', 'Data jurusan SMA/SMK berhasil dihapus');
            }
        }
    }
}
