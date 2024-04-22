<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Jadwal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $verifUser = DB::table('biodatas')
            ->select(
                DB::raw('COUNT(CASE WHEN biodatas.status = "Diverifikasi" THEN 1 END) as peserta_verif')
            )
            ->first();

        $peserta = User::whereHas('roles', function ($query) {
            $query->where('name', 'calon-mahasiswa');
        })
            ->with('roles')
            ->get();
        $totalCalonMahasiswa = $peserta->count();

        $adminB = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin-bidiksiba');
        })
            ->with('roles')
            ->get();
        $totalAdminBidiksiba = $adminB->count();

        $files = DB::table('berkas')
            ->select('berkas.*')
            ->get();

        $jadwal = DB::table('jadwals')
            ->select('jadwals.*')
            ->first();

        $d_start = null;
        $m_start = null;
        $y_start = null;
        $t_start = null;
        $d_end = null;
        $m_end = null;
        $y_end = null;
        $t_end = null;

        if ($jadwal) {
            $start = Carbon::parse($jadwal->start);
            $end = Carbon::parse($jadwal->end);

            $d_start = $start->format('d');
            $m_start = $start->formatLocalized('%B');
            $y_start = $start->format('Y');
            $t_start = $start->format('H:i:s');

            $d_end = $end->format('d');
            $m_end = $end->formatLocalized('%B');
            $y_end = $end->format('Y');
            $t_end = $end->format('H:i:s');
        }

        return view(
            'home',
            compact(
                'verifUser',
                'totalAdminBidiksiba',
                'totalCalonMahasiswa',
                'files',
                'jadwal',
                'd_start',
                'm_start',
                'y_start',
                't_start',
                'd_end',
                'm_end',
                'y_end',
                't_end',
            )
        );
    }

    public function jadwal(Request $request)
    {
        $idJadwal = Jadwal::all()->first();

        if ($idJadwal == null) {
            Jadwal::create([
                'start' => $request->start,
                'end' => $request->end,
            ]);
        } else {
            $idJadwal->update([
                'start' => $request->start,
                'end' => $request->end,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'pendaftaran berhasil dijadwalkan');
    }

    public function upload_file(Request $request)
    {
        $request->validate(
            [
                'file' => 'required|file|mimes:pdf|max:2048',
                'foto' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            ],
            [
                'file.required' => 'Form harus diisi',
                'file.mimes' => 'Format file yang diunggah harus PDF',
                'file.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
                'foto.image' => 'File yang diunggah harus berupa gambar',
                'foto.mimes' => 'Format gambar yang diunggah adalah PNG, JPG, atau JPEG',
                'foto.max' => 'Ukuran file tidak boleh melebihi 2048 KB (2 MB)',
            ]
        );

        if ($request->hasFile('file')) {

            $extension = $request->file('file')->extension();
            $randomName = 'file-' . Str::random(9) . '.' . $extension;

            $filePath = $request->file('file')->storeAs('public/pdf', $randomName);
            $filePath = str_replace('public/', '', $filePath);
        }

        $berkas = Berkas::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file' => $filePath,
        ]);

        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->extension();
            $randomName = 'foto-' . Str::random(9) . '.' . $extension;

            $fotoPath = $request->file('foto')->storeAs('public/foto-file', $randomName);
            $fotoPath = str_replace('public/', '', $fotoPath);

            $berkas->update(['foto' => $fotoPath]);
        }

        return redirect()->route('dashboard')->with('success', 'file berhasil diupload');
    }

    public function delete(Berkas $berkas)
    {
        $berkas->delete();
        if ($berkas->foto) {
            Storage::delete('public/' . $berkas->foto);
        }

        if ($berkas->file) {
            Storage::delete('public/' . $berkas->file);
        }

        return redirect()->route('dashboard')->with('success', 'file berhasil dihapus');
    }
}
