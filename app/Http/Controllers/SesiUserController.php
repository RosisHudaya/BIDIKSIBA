<?php

namespace App\Http\Controllers;

use App\Models\NilaiUjian;
use App\Models\SesiUjian;
use App\Models\SesiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class SesiUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:sesi-user.create')->only('create', 'store');
        $this->middleware('permission:sesi-user.destroy')->only('destroy');
    }

    public function create(SesiUjian $sesiUjian)
    {
        $biodatas = DB::table('biodatas as b')
            ->leftJoin('users as u', 'b.id_user', '=', 'u.id')
            ->where('b.status', '=', 'Diverifikasi')
            // ->whereNotExists(function ($query) use ($sesiUjian) {
            //     $query->select(DB::raw(1))
            //         ->from('sesi_users as su')
            //         ->whereRaw('su.id_user = u.id')
            //         ->where('su.id_sesi', '=', $sesiUjian->id);
            // })
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('sesi_users as su')
                    ->whereRaw('su.id_user = u.id');
            })
            ->select(
                'u.id',
                'b.id_user',
                'b.nama',
                'b.gender',
            )
            ->orderBy('b.nama', 'asc')
            ->paginate(25);

        return view('sesi-user.create', compact('sesiUjian', 'biodatas'));
    }

    public function store(Request $request, SesiUjian $sesiUjian)
    {
        foreach ($request->input('user_ids', []) as $id_user) {
            SesiUser::create([
                'id_sesi' => $sesiUjian->id,
                'id_user' => $id_user,
                'status' => 'belum',
            ]);
        }

        return redirect()->route('sesiUjian', ['sesi_ujian' => $sesiUjian->id])
            ->with('success', 'Peserta berhasil ditambahkan ke sesi ujian');
    }

    public function destroy(SesiUser $sesiUser, SesiUjian $sesiUjian)
    {
        $sesiUser->delete();

        $nilai = NilaiUjian::where('id_user', $sesiUser->id_user)->first();
        if ($nilai) {
            $nilai->delete();
        }

        return redirect()->route('sesiUjian', ['sesi_ujian' => $sesiUjian->id])
            ->with('success', 'Peserta ujian berhasil dihapus dari sesi ujian');
    }
}
