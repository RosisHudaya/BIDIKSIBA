@extends('layouts.app')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Biodata Pendaftar</h1>
        </div>
        <div class="p-main p-3">
            <form action="{{ route('verifikasi-pendaftar.update', $biodata) }}" method="POST" enctype="multipart/form-data">
                <p class="text-primary font-weight-bold" style="font-size: 16px;">
                    Validasi Edit Data Biodata Pendaftar
                </p>
                <div class="card-body m-0 p-0">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-md-12 justify-content-start">
                        <label for="">Foto</label><br>
                        @if ($biodata)
                            @if ($biodata->foto)
                                <img id="foto-preview" class="ml-3" src="{{ asset('storage/' . $biodata->foto) }}"
                                    alt="foto" style="width: 150px; height: 200px; object-fit: cover;">
                            @else
                                <img id="foto-preview" class="ml-3" src="{{ asset('assets/img/profile.jpg') }}"
                                    alt="foto-default" style="width: 150px; height: 200px; object-fit: cover;">
                            @endif
                        @else
                            <img id="foto-preview" class="ml-3" src="{{ asset('assets/img/profile.jpg') }}"
                                alt="foto-default" style="width: 150px; height: 200px; object-fit: cover;">
                        @endif
                        <br><br>
                        <input class="form-control @error('foto') is-invalid @enderror" name="foto" id="foto"
                            type="file">
                        @error('foto')
                            <div class="invalid-feedback feed ml-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">KTP</label><br>
                            @if ($biodata)
                                @if ($biodata->ktp)
                                    <img id="ktp-preview" class="ml-3" src="{{ asset('storage/' . $biodata->ktp) }}"
                                        alt="ktp" style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="ktp-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                        alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="ktp-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                    alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('ktp') is-invalid @enderror" name="ktp" id="ktp"
                                type="file">
                            @error('ktp')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Kartu Siswa</label><br>
                            @if ($biodata)
                                @if ($biodata->ktp)
                                    <img id="kartu-siswa-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata->kartu_siswa) }}" alt="kartu siswa"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="kartu-siswa-preview" class="ml-3"
                                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="kartu-siswa-preview" class="ml-3"
                                    src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                    style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('kartu_siswa') is-invalid @enderror" name="kartu_siswa"
                                id="kartu_siswa" type="file">
                            @error('kartu_siswa')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Kartu Keluarga</label><br>
                        @if ($biodata)
                            @if ($biodata->kk)
                                <img id="kk-preview" class="ml-3" src="{{ asset('storage/' . $biodata->kk) }}"
                                    alt="kk" style="width: 250px; height: 100px; object-fit: contain;">
                            @else
                                <img id="kk-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                    alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                        @else
                            <img id="kk-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                        @endif
                        <br><br>
                        <input class="form-control @error('kk') is-invalid @enderror" name="kk" id="kk"
                            type="file">
                        @error('kk')
                            <div class="invalid-feedback feed ml-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div><br>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Nama Lengkap Pendaftar</label><br>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                                value="{{ $biodata ? $biodata->nama : '' }}" placeholder="masukkan nama lengkap peserta">
                            @error('nama')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Asal Sekolah</label><br>
                            <input class="form-control @error('asal_sekolah') is-invalid @enderror" type="text"
                                name="asal_sekolah" value="{{ $biodata ? $biodata->asal_sekolah : '' }}"
                                placeholder="masukkan asal sekolah peserta">
                            @error('asal_sekolah')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Kota Lahir</label><br>
                            <input class="form-control @error('kota_lahir') is-invalid @enderror" type="text"
                                name="kota_lahir" value="{{ $biodata ? $biodata->kota_lahir : '' }}"
                                placeholder="masukkan kota lahir peserta">
                            @error('kota_lahir')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tanggal Lahir</label><br>
                            <input class="form-control" type="date" name="tgl_lahir"
                                value="{{ $biodata ? $biodata->tgl_lahir : '' }}">
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">NIK</label><br>
                            <input class="form-control @error('nik') is-invalid @enderror" type="text" name="nik"
                                value="{{ $biodata ? $biodata->nik : '' }}" placeholder="masukkan nik peserta">
                            @error('nik')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">NISN</label><br>
                            <input class="form-control @error('nisn') is-invalid @enderror" type="text" name="nisn"
                                value="{{ $biodata ? $biodata->nisn : '' }}" placeholder="masukkan nisn peserta">
                            @error('nisn')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">No Telepon</label><br>
                            <input class="form-control @error('no_telp') is-invalid @enderror" type="text"
                                name="no_telp" value="{{ $biodata ? $biodata->no_telp : '' }}"
                                placeholder="masukkan nomer telepon peserta">
                            @error('no_telp')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Jenis Kelamin</label><br>
                            <select class="form-control select2" name="gender">
                                <option value="">Jenis Kelamin</option>
                                <option value="Laki-laki"
                                    {{ isset($biodata) && $biodata->gender === 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="Perempuan"
                                    {{ isset($biodata) && $biodata->gender === 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr class="mt-0 p-0">
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Pekerjaan Orang Tua</label><br>
                            <select class="form-control select2" name="pekerjaan_ortu">
                                <option value="" selected disabled>Pekerjaan Orang Tua</option>
                                @foreach ($pekerjaan_ortus as $pekerjaan_ortu)
                                    @if (!empty($biodata_spk->pekerjaan_ortu_id))
                                        <option @selected($biodata_spk->pekerjaan_ortu_id == $pekerjaan_ortu->id) value="{{ $pekerjaan_ortu->id }}">
                                            {{ $pekerjaan_ortu->pekerjaan_ortu }}
                                        </option>
                                    @else
                                        <option value="{{ $pekerjaan_ortu->id }}">
                                            {{ $pekerjaan_ortu->pekerjaan_ortu }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Detail Pekerjaan</label><br>
                            <input class="form-control @error('detail_pekerjaan') is-invalid @enderror" type="text"
                                name="detail_pekerjaan" value="{{ $biodata_spk ? $biodata_spk->detail_pekerjaan : '' }}"
                                placeholder="detail pekerjaan peserta">
                            @error('detail_pekerjaan')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Penghasilan Orang Tua</label><br>
                            <select class="form-control select2" name="gaji_ortu">
                                <option value="" selected disabled>Penghasilan Orang Tua</option>
                                @foreach ($gaji_ortus as $gaji_ortu)
                                    @if (!empty($biodata_spk->gaji_ortu_id))
                                        <option @selected($biodata_spk->gaji_ortu_id == $gaji_ortu->id) value="{{ $gaji_ortu->id }}">
                                            {{ $gaji_ortu->gaji_ortu }}
                                        </option>
                                    @else
                                        <option value="{{ $gaji_ortu->id }}">
                                            {{ $gaji_ortu->gaji_ortu }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Luas Tanah</label><br>
                            <input class="form-control" type="text" name="luas_tanah" id="luas_tanah"
                                value="{{ $biodata_spk ? number_format($biodata_spk->luas_tanah, 0, ',', '.') : '' }}"
                                placeholder="masukkan luas tanah peserta">
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Slip Gaji</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->slip_gaji)
                                    <img id="slip-gaji-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->slip_gaji) }}" alt="slip-gaji"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="slip-gaji-preview" class="ml-3"
                                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="slip-gaji-preview" class="ml-3"
                                    src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                    style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('slip-gaji') is-invalid @enderror" name="slip-gaji"
                                id="slip-gaji" type="file">
                            @error('slip-gaji')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti SHM</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->shm)
                                    <img id="shm-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->shm) }}" alt="shm"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="shm-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                        alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="shm-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                    alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('shm') is-invalid @enderror" name="shm" id="shm"
                                type="file">
                            @error('shm')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Jumlah Kamar</label><br>
                            <input class="form-control" type="number" name="jml_kmr"
                                value="{{ $biodata_spk ? $biodata_spk->kamar : '' }}"
                                placeholder="masukkan jumlah kamar peserta">
                        </div>
                        <div class="form-group col-md-6 mr-0 pr-0">
                            <label for="">Kepemilikan Kamar Mandi</label><br>
                            <select class="form-control select2" name="jml_kmr_mandi">
                                <option value="" selected disabled>Kepemilikan Kamar Mandi</option>
                                @foreach ($kamar_mandis as $kamar_mandi)
                                    @if (!empty($biodata_spk->kamar_mandi_id))
                                        <option @selected($biodata_spk->kamar_mandi_id == $kamar_mandi->id) value="{{ $kamar_mandi->id }}">
                                            {{ $kamar_mandi->kamar_mandi }}
                                        </option>
                                    @else
                                        <option value="{{ $kamar_mandi->id }}">
                                            {{ $kamar_mandi->kamar_mandi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Foto Kamar</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->foto_kmr)
                                    <img id="foto-kmr-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->foto_kmr) }}" alt="foto-kamar"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="foto-kmr-preview" class="ml-3"
                                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="foto-kmr-preview" class="ml-3"
                                    src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                    style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('foto-kmr') is-invalid @enderror" name="foto-kmr"
                                id="foto-kmr" type="file">
                            @error('foto-kmr')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti Foto Kamar Mandi</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->foto_kmr_mandi)
                                    <img id="kmr-mandi-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->foto_kmr_mandi) }}" alt="shm"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="kmr-mandi-preview" class="ml-3"
                                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="kmr-mandi-preview" class="ml-3"
                                    src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                    style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('kmr-mandi') is-invalid @enderror" name="kmr-mandi"
                                id="kmr-mandi" type="file">
                            @error('kmr-mandi')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Listrik yang digunakan</label><br>
                            <select class="form-control select2" name="tagihan_listrik">
                                <option value="" selected disabled>Listrik yang digunakan</option>
                                @foreach ($tagihan_listriks as $tagihan_listrik)
                                    @if (!empty($biodata_spk->tagihan_listrik_id))
                                        <option @selected($biodata_spk->tagihan_listrik_id == $tagihan_listrik->id) value="{{ $tagihan_listrik->id }}">
                                            {{ $tagihan_listrik->tagihan_listrik }}
                                        </option>
                                    @else
                                        <option value="{{ $tagihan_listrik->id }}">
                                            {{ $tagihan_listrik->tagihan_listrik }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Pajak Bumi dan Bangunan</label><br>
                            <input class="form-control" type="text" name="pbb" id="pbb"
                                value="{{ $biodata_spk ? number_format($biodata_spk->pajak, 0, ',', '.') : '' }}"
                                placeholder="masukkan jumlah tagihan pajak bumi dan bangunan peserta">
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Tagihan Listrik</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->slip_tagihan)
                                    <img id="listrik-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->slip_tagihan) }}" alt="slip-tagihan"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="listrik-preview" class="ml-3"
                                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="listrik-preview" class="ml-3" src="{{ asset('assets/img/default-img.jpg') }}"
                                    alt="foto-default" style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('listrik') is-invalid @enderror" name="listrik"
                                id="listrik" type="file">
                            @error('listrik')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti Slip Pajak Bumi dan Bangunan</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->slip_pbb)
                                    <img id="slip-pbb-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->slip_pbb) }}" alt="slip-pbb"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @else
                                    <img id="slip-pbb-preview" class="ml-3"
                                        src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                        style="width: 250px; height: 100px; object-fit: contain;">
                                @endif
                            @else
                                <img id="slip-pbb-preview" class="ml-3"
                                    src="{{ asset('assets/img/default-img.jpg') }}" alt="foto-default"
                                    style="width: 250px; height: 100px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('slip-pbb') is-invalid @enderror" name="slip-pbb"
                                id="slip-pbb" type="file">
                            @error('slip-pbb')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Jumlah Saudara</label><br>
                            <select class="form-control select2" name="jml_sdr">
                                <option value="" selected disabled>Jumlah Saudara</option>
                                @foreach ($saudaras as $saudara)
                                    @if (!empty($biodata_spk->saudara_id))
                                        <option @selected($biodata_spk->saudara_id == $saudara->id) value="{{ $saudara->id }}">
                                            {{ $saudara->saudara }}
                                        </option>
                                    @else
                                        <option value="{{ $saudara->id }}">
                                            {{ $saudara->saudara }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Status Orang Tua</label><br>
                            <select class="form-control select2" name="status_ortu">
                                <option value="" selected disabled>Status Orang Tua</option>
                                @foreach ($status_ortus as $status_ortu)
                                    @if (!empty($biodata_spk->status_ortu_id))
                                        <option @selected($biodata_spk->status_ortu_id == $status_ortu->id) value="{{ $status_ortu->id }}">
                                            {{ $status_ortu->status_ortu }}
                                        </option>
                                    @else
                                        <option value="{{ $status_ortu->id }}">
                                            {{ $status_ortu->status_ortu }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Surat Ket Saudara</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->surat_ket_sdr)
                                    <img id="sdr-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->surat_ket_sdr) }}" alt="ket-sdr"
                                        style="width: 150px; height: 200px; object-fit: contain;">
                                @else
                                    <img id="sdr-preview" class="ml-3"
                                        src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="foto-default"
                                        style="width: 150px; height: 200px; object-fit: contain;">
                                @endif
                            @else
                                <img id="sdr-preview" class="ml-3"
                                    src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="foto-default"
                                    style="width: 150px; height: 200px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('sdr') is-invalid @enderror" name="sdr" id="sdr"
                                type="file">
                            @error('sdr')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti Surat Ket Yatim</label><br>
                            @if ($biodata_spk)
                                @if ($biodata_spk->surat_ket_yatim)
                                    <img id="ket-yatim-preview" class="ml-3"
                                        src="{{ asset('storage/' . $biodata_spk->surat_ket_yatim) }}" alt="ket-yatim"
                                        style="width: 150px; height: 200px; object-fit: contain;">
                                @else
                                    <img id="ket-yatim-preview" class="ml-3"
                                        src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="foto-default"
                                        style="width: 150px; height: 200px; object-fit: contain;">
                                @endif
                            @else
                                <img id="ket-yatim-preview" class="ml-3"
                                    src="{{ asset('assets/img/blank-img-portrait.png') }}" alt="foto-default"
                                    style="width: 150px; height: 200px; object-fit: contain;">
                            @endif
                            <br><br>
                            <input class="form-control @error('ket-yatim') is-invalid @enderror" name="ket-yatim"
                                id="ket-yatim" type="file">
                            @error('ket-yatim')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-12 d-flex justify-content-start">
                        <div class="form-group col-md-6">
                            <label for="">Jumlah Hutang</label><br>
                            <select class="form-control select2" name="jml_hutang">
                                <option value="" selected disabled>Jumlah Hutang</option>
                                @foreach ($hutangs as $hutang)
                                    @if (!empty($biodata_spk->hutang_id))
                                        <option @selected($biodata_spk->hutang_id == $hutang->id) value="{{ $hutang->id }}">
                                            {{ $hutang->hutang }}
                                        </option>
                                    @else
                                        <option value="{{ $hutang->id }}">
                                            {{ $hutang->hutang }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Detail Jumlah Hutang</label><br>
                            <input class="form-control" type="text" name="det_hutang" id="det_hutang"
                                value="{{ $biodata_spk ? $biodata_spk->det_hutang : '' }}"
                                placeholder="detail jumlah hutang peserta">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('verifikasi-pendaftar.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('customStyle')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endpush

@push('customScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#foto').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#ktp').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#ktp-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#kartu_siswa').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#kartu-siswa-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#kk').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#kk-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#slip-gaji').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#slip-gaji-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#shm').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#shm-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#foto-kmr').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#foto-kmr-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#kmr-mandi').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#kmr-mandi-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#listrik').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#listrik-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#slip-pbb').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#slip-pbb-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#sdr').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#sdr-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
        $(document).ready(function() {
            $('#ket-yatim').change(function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#ket-yatim-preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>

    <script>
        function formatRupiah(angka) {
            var formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            var formatted = formatter.format(angka);
            formatted = formatted.replace("Rp", "");
            return formatted;
        }

        document.getElementById('luas_tanah').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('pbb').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });

        document.getElementById('det_hutang').addEventListener('input', function() {
            var value = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiah(value);
        });
    </script>
@endpush
