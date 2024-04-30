@if (auth()->user())
    @role('calon-mahasiswa')
        @if ($biodatas?->id_user == null)
            <div class="alert alert-info">
                <p class="m-0 p-0 p-alert">
                    !!! Silahkan mengisi biodata di "BIODATA Pendaftar" !!!
                </p>
            </div>
        @elseif ($biodatas->status == 'Blm Diverifikasi')
            <div class="alert alert-danger">
                <p class="m-0 p-0 p-alert">"!!! ADA KESALAHAN DALAM PENGISIAN BIODATA !!!"</p>
            </div>
        @elseif ($biodatas?->id_user != null && $biodatas?->status != 'Diverifikasi')
            @if (
                $biodatas?->id_asal_jurusan != null &&
                    $biodatas?->id_jurusan != null &&
                    $biodatas?->id_prodi != null &&
                    $biodatas?->foto != null &&
                    $biodatas?->ktp != null &&
                    $biodatas?->kartu_siswa != null &&
                    $biodatas?->kk != null &&
                    $biodatas?->nik != null &&
                    $biodatas?->nama != null &&
                    $biodatas?->kota_lahir != null &&
                    $biodatas?->tgl_lahir != null &&
                    $biodatas?->gender != null &&
                    $biodatas?->no_telp != null &&
                    $biodatas?->nisn != null &&
                    $biodatas?->asal_sekolah != null)
            @else
                <div class="alert alert-warning">
                    <p class="m-0 p-0 p-alert">
                        !!! Silahkan melengkapi keseluruhan data pada formulir yang ada di menu "BIODATA Pendaftar" !!!
                    </p>
                </div>
            @endif
        @else
        @endif
    @endrole
@endif
