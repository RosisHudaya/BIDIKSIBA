@if (auth()->user())
    @if ($biodatas?->id_user == null)
        <div class="alert alert-info">
            <h6 class="m-0 p-0">
                !!! Silahkan mengisi biodata anda di menu "BIODATA Pendaftar" !!!
            </h6>
        </div>
    @elseif ($biodatas->status == 'Blm Diverifikasi')
        <div class="alert alert-danger">
            <h6 class="m-0 p-0">"!!! ADA KESALAHAN DALAM PENGISIAN BIODATA !!!"</h6>
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
            <div class="alert alert-warning" id="warning-alert">
                <h6 class="m-0 p-0">
                    "DATA SUDAH LENGKAP" | sedang menunggu proses verifikasi oleh admin...
                </h6>
            </div>
        @else
            <div class="alert alert-warning">
                <h6 class="m-0 p-0">
                    !!! Silahkan melengkapi keseluruhan data pada formulir yang ada di menu "BIODATA Pendaftar" !!!
                </h6>
            </div>
        @endif
    @else
        <div class="alert alert-success" id="success-alert">
            <h6 class="m-0 p-0">
                Data BIODATA PENDAFTAR telah diverifikasi admin, silahkan cek token dan password ujian di menu
                "lihat TOKEN" !!!
            </h6>
        </div>
    @endif
@endif