<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Http\Requests\StoreUjianRequest;
use App\Http\Requests\UpdateUjianRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UjianController extends Controller
{
    public function index(Request $request)
    {
        $ujians = DB::table('ujians as u')
            ->leftJoin('soal_ujians as su', 'u.id', '=', 'su.id_ujian')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('u.nama_ujian', 'like', '%' . $name . '%');
            })
            ->select(
                'u.id',
                'u.nama_ujian',
                'u.deskripsi',
                DB::raw('COUNT(su.id) as jumlah_soal')
            )
            ->groupBy('u.id', 'u.nama_ujian', 'u.deskripsi')
            ->paginate(10);
        return view('ujian.index', compact('ujians'));
    }

    public function create()
    {
        return view('ujian.create');
    }

    public function store(StoreUjianRequest $request)
    {
        Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('ujian.index')->with('success', 'Ujian baru berhasil ditambahkan');
    }

    public function show(Ujian $ujian)
    {
        //
    }

    public function edit(Ujian $ujian)
    {
        return view('ujian.edit', compact('ujian'));
    }

    public function update(UpdateUjianRequest $request, Ujian $ujian)
    {
        $ujian->update($request->all());

        return redirect()->route('ujian.index')->with('success', 'Data ujian berhasil diperbarui');
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('ujian.index')->with('success', 'Data ujian berhasil dihapus');
    }

    public function soal_ujian(Request $request, Ujian $ujian)
    {
        $soal_ujians = DB::table('soal_ujians as su')
            ->leftJoin('ujians as u', 'su.id_ujian', '=', 'u.id')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('su.soal', 'like', '%' . $name . '%');
            })
            ->select(
                'su.id',
                'su.soal',
                'su.jawaban_a',
                'su.jawaban_b',
                'su.jawaban_c',
                'su.jawaban_d',
                'su.jawaban_benar',
                'u.nama_ujian',
                'u.deskripsi',
                DB::raw('COUNT(*) as jumlah_soal')
            )
            ->where('su.id_ujian', $ujian->id)
            ->groupBy(
                'su.id',
                'su.soal',
                'su.jawaban_a',
                'su.jawaban_b',
                'su.jawaban_c',
                'su.jawaban_d',
                'su.jawaban_benar',
                'u.nama_ujian',
                'u.deskripsi',
            )
            ->paginate(5);
        $jumlah_soal_ujian = $soal_ujians->total();
        return view('soal-ujian.index')->with([
            'soal_ujians' => $soal_ujians,
            'jumlah_soal_ujian' => $jumlah_soal_ujian,
            'ujian' => $ujian,
        ]);
    }
}
