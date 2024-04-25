@if ($biodatas?->id_user == null)
    <div class="alert alert-info">
        <p class="m-0 p-0">
            !!! Isi formulir BIODATA PENDAFTAR dibawah untuk mendapatkan TOKEN dan PASSWORD ujian !!!
        </p>
    </div>
@elseif ($biodatas->status == 'Blm Diverifikasi')
    <div class="alert alert-danger">
        <p class="m-0 p-0">"!!! ADA KESALAHAN DATA !!!"</p>
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
            $biodatas?->asal_sekolah != null &&
            $biodata_spk?->pekerjaan_ortu_id != null &&
            $biodata_spk?->detail_pekerjaan != null &&
            $biodata_spk?->gaji_ortu_id != null &&
            $biodata_spk?->slip_gaji != null &&
            $biodata_spk?->luas_tanah != null &&
            $biodata_spk?->shm != null &&
            $biodata_spk?->kamar != null &&
            $biodata_spk?->foto_kmr != null &&
            $biodata_spk?->kamar_mandi_id != null &&
            $biodata_spk?->foto_kmr_mandi != null &&
            $biodata_spk?->tagihan_listrik_id != null &&
            $biodata_spk?->slip_tagihan != null &&
            $biodata_spk?->pajak != null &&
            $biodata_spk?->slip_pbb != null &&
            $biodata_spk?->hutang_id != null &&
            $biodata_spk?->det_hutang != null &&
            $biodata_spk?->saudara_id != null &&
            $biodata_spk?->surat_ket_sdr != null &&
            $biodata_spk?->status_ortu_id != null &&
            $biodata_spk?->surat_ket_yatim != null)
        <div class="alert alert-warning">
            <p class="m-0 p-0">
                Data PENDAFTAR dibawah sedang menunggu proses verifikasi oleh admin...
            </p>
        </div>
    @else
        <div class="alert alert-warning">
            <p class="m-0 p-0">
                !!! Lengkapi seluruh formulir BIODATA PENDAFTAR dibawah untuk mendapatkan TOKEN dan PASSWORD ujian !!!
            </p>
        </div>
    @endif
@endif
