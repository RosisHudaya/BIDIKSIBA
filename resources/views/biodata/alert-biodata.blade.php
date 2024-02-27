@if ($biodatas?->id_user == null)
    <div class="alert alert-info">
        <h6 class="m-0 p-0">
            !!! Isi formulir BIODATA PENDAFTAR dibawah untuk mendapatkan TOKEN dan PASSWORD ujian !!!
        </h6>
    </div>
@elseif ($biodatas->status == 'Blm Diverifikasi')
    <div class="alert alert-danger">
        <h6 class="m-0 p-0">"!!! ADA KESALAHAN DATA !!!"</h6>
        <hr class="my-2">
        <small class="m-0 p-0" style="font-size: 14px;">{!! $biodatas->catatan ?? '' !!}</small>
        <hr class="m-0">
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
        <div class="alert alert-warning">
            <h6 class="m-0 p-0">
                Data PENDAFTAR dibawah sedang menunggu proses verifikasi oleh admin...
            </h6>
        </div>
    @else
        <div class="alert alert-warning">
            <h6 class="m-0 p-0">
                !!! Lengkapi seluruh formulir BIODATA PENDAFTAR dibawah untuk mendapatkan TOKEN dan PASSWORD ujian !!!
            </h6>
        </div>
    @endif
@endif
