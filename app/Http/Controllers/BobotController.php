<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use App\Http\Requests\StoreBobotRequest;
use App\Http\Requests\UpdateBobotRequest;
use App\Models\BobotHutang;
use App\Models\BobotKamar;
use App\Models\BobotKamarMandi;
use App\Models\BobotListrik;
use App\Models\BobotPajak;
use App\Models\BobotPekerjaan;
use App\Models\BobotPenghasilan;
use App\Models\BobotSaudara;
use App\Models\BobotStatusOrtus;
use App\Models\BobotTanah;
use App\Services\BobotService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    protected $bobotService;

    public function __construct(BobotService $bobotService)
    {
        $this->bobotService = $bobotService;
        $this->middleware('auth');
        $this->middleware('permission:bobot-kriteria.index')->only('index');
        $this->middleware('permission:bobot-kriteria.edit')->only('edit', 'update');
        $this->middleware('permission:bobot-kriteria.menu-ranking.matriks')->only('matriks');
        $this->middleware('permission:bobot-kriteria.update.matriks')->only('update_matriks');
    }

    public function index()
    {
        $bobots = DB::table('bobots')
            ->paginate(10);

        return view('hasil-ranking.bobot-kriteria.index', compact('bobots'));
    }

    public function matriks()
    {
        $bobot_pekerjaan = DB::table('bobot_pekerjaans')
            ->first();

        $bobot_penghasilan = DB::table('bobot_penghasilans')
            ->first();

        $bobot_tanah = DB::table('bobot_tanahs')
            ->first();

        $bobot_kamar = DB::table('bobot_kamars')
            ->first();

        $bobot_kamar_mandi = DB::table('bobot_kamar_mandis')
            ->first();

        $bobot_listrik = DB::table('bobot_listriks')
            ->first();

        $bobot_pajak = DB::table('bobot_pajaks')
            ->first();

        $bobot_hutang = DB::table('bobot_hutangs')
            ->first();

        $bobot_saudara = DB::table('bobot_saudaras')
            ->first();

        $bobot_status_ortu = DB::table('bobot_status_ortuses')
            ->first();

        return view('hasil-ranking.bobot-kriteria.matriks')->with([
            'bobot_pekerjaan' => $bobot_pekerjaan,
            'bobot_penghasilan' => $bobot_penghasilan,
            'bobot_tanah' => $bobot_tanah,
            'bobot_kamar' => $bobot_kamar,
            'bobot_kamar_mandi' => $bobot_kamar_mandi,
            'bobot_listrik' => $bobot_listrik,
            'bobot_pajak' => $bobot_pajak,
            'bobot_hutang' => $bobot_hutang,
            'bobot_saudara' => $bobot_saudara,
            'bobot_status_ortu' => $bobot_status_ortu,
        ]);
    }

    public function update_matriks(Request $request)
    {
        $bobotPekerjaan = BobotPekerjaan::first();
        $bobotPekerjaan->update([
            'to_c2' => $request->bobot_penghasilan_1,
            'to_c5' => $request->bobot_kamar_mandi_1,
            'to_c6' => $request->bobot_listrik_1,
            'to_c8' => $request->bobot_hutang_1,
            'to_c9' => $request->bobot_saudara_1,
            'to_c10' => $request->bobot_status_ortu_1,
        ]);

        $bobotPenghasilan = BobotPenghasilan::first();
        $bobotPenghasilan->update([
            $hasil2_1 = 1 / $request->bobot_penghasilan_1,
            'to_c1' => number_format($hasil2_1, 2),
            'to_c5' => $request->bobot_kamar_mandi_2,
            'to_c6' => $request->bobot_listrik_2,
            'to_c8' => $request->bobot_hutang_2,
            'to_c9' => $request->bobot_saudara_2,
            'to_c10' => $request->bobot_status_ortu_2,
        ]);

        $bobotTanah = BobotTanah::first();
        $bobotTanah->update([
            'to_c4' => $request->bobot_kamar_3,
            'to_c7' => $request->bobot_pajak_3,
        ]);

        $bobotKamar = BobotKamar::first();
        $bobotKamar->update([
            $hasil4_3 = 1 / $request->bobot_kamar_3,
            'to_c3' => number_format($hasil4_3, 2),
            'to_c7' => $request->bobot_pajak_4
        ]);

        $bobotKamarMandi = BobotKamarMandi::first();
        $bobotKamarMandi->update([
            $hasil5_1 = 1 / $request->bobot_kamar_mandi_1,
            $hasil5_2 = 1 / $request->bobot_kamar_mandi_2,
            'to_c1' => number_format($hasil5_1, 2),
            'to_c2' => number_format($hasil5_2, 2),
            'to_c6' => $request->bobot_listrik_5,
            'to_c8' => $request->bobot_hutang_5,
            'to_c9' => $request->bobot_saudara_5,
            'to_c10' => $request->bobot_status_ortu_5,
        ]);

        $bobotListrik = BobotListrik::first();
        $bobotListrik->update([
            $hasil6_1 = 1 / $request->bobot_listrik_1,
            $hasil6_2 = 1 / $request->bobot_listrik_2,
            $hasil6_5 = 1 / $request->bobot_listrik_5,
            'to_c1' => number_format($hasil6_1, 2),
            'to_c2' => number_format($hasil6_2, 2),
            'to_c5' => number_format($hasil6_5, 2),
            'to_c8' => $request->bobot_hutang_6,
            'to_c9' => $request->bobot_saudara_6,
            'to_c10' => $request->bobot_status_ortu_6,
        ]);

        $bobotPajak = BobotPajak::first();
        $bobotPajak->update([
            $hasil7_3 = 1 / $request->bobot_pajak_3,
            $hasil7_4 = 1 / $request->bobot_pajak_4,
            'to_c3' => number_format($hasil7_3, 2),
            'to_c4' => number_format($hasil7_4, 2),
        ]);

        $bobotHutang = BobotHutang::first();
        $bobotHutang->update([
            $hasil8_1 = 1 / $request->bobot_hutang_1,
            $hasil8_2 = 1 / $request->bobot_hutang_2,
            $hasil8_5 = 1 / $request->bobot_hutang_5,
            $hasil8_6 = 1 / $request->bobot_hutang_6,
            'to_c1' => number_format($hasil8_1, 2),
            'to_c2' => number_format($hasil8_2, 2),
            'to_c5' => number_format($hasil8_5, 2),
            'to_c6' => number_format($hasil8_6, 2),
            'to_c9' => $request->bobot_saudara_8,
            'to_c10' => $request->bobot_status_ortu_8,
        ]);

        $bobotSaudara = BobotSaudara::first();
        $bobotSaudara->update([
            $hasil9_1 = 1 / $request->bobot_saudara_1,
            $hasil9_2 = 1 / $request->bobot_saudara_2,
            $hasil9_5 = 1 / $request->bobot_saudara_5,
            $hasil9_6 = 1 / $request->bobot_saudara_6,
            $hasil9_8 = 1 / $request->bobot_saudara_8,
            'to_c1' => number_format($hasil9_1, 2),
            'to_c2' => number_format($hasil9_2, 2),
            'to_c5' => number_format($hasil9_5, 2),
            'to_c6' => number_format($hasil9_6, 2),
            'to_c8' => number_format($hasil9_8, 2),
            'to_c10' => $request->bobot_status_ortu_9
        ]);

        $bobotStatus = BobotStatusOrtus::first();
        $bobotStatus->update(([
            $hasil10_1 = 1 / $request->bobot_status_ortu_1,
            $hasil10_2 = 1 / $request->bobot_status_ortu_2,
            $hasil10_5 = 1 / $request->bobot_status_ortu_5,
            $hasil10_6 = 1 / $request->bobot_status_ortu_6,
            $hasil10_8 = 1 / $request->bobot_status_ortu_8,
            $hasil10_9 = 1 / $request->bobot_status_ortu_9,
            'to_c1' => number_format($hasil10_1, 2),
            'to_c2' => number_format($hasil10_2, 2),
            'to_c5' => number_format($hasil10_5, 2),
            'to_c6' => number_format($hasil10_6, 2),
            'to_c8' => number_format($hasil10_8, 2),
            'to_c9' => number_format($hasil10_9, 2),
        ]));
        $results = $this->bobotService->getWeightValues();

        return redirect()->route('menu-ranking.matriks')->with('success', 'Data matriks perbandingan pasangan dan bobot berhasil diperbarui');
    }

    public function create()
    {
        //
    }

    public function store(StoreBobotRequest $request)
    {
        //
    }

    public function show(Bobot $bobot)
    {
        //
    }

    public function edit(Bobot $bobot_kriterium)
    {
        return view('hasil-ranking.bobot-kriteria.edit', compact('bobot_kriterium'));
    }

    public function update(UpdateBobotRequest $request, Bobot $bobot_kriterium)
    {
        $bobot_kriterium->update($request->all());

        return redirect()->route('bobot-kriteria.index')->with('success', 'Data bobot berhasil diperbarui');
    }

    public function destroy(Bobot $bobot)
    {
        //
    }
}
