@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Biodata Pendaftar')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto text-justify my-4">
        @include('biodata.alert-biodata')
        <p class="p-main-title mb-0 py-1 px-3">BIODATA PENDAFTAR</p>
        <div class="p-main py-1 px-3">
            <form action="{{ route('biodata.storeOrUpdate') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="py-3">
                    @include('biodata.data-diri')
                    @include('biodata.jurusan')
                    <div class="mr-4 text-right">
                        <button class="btn btn-save px-5" {{ $biodatas?->status == 'Diverifikasi' ? 'disabled' : '' }}>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <div class="pb-3">
                <p class="my-0 p-title">DATA PENDUKUNG</p>
                <hr>
                <form action="{{ route('biodata.storeOrUpdateSpk') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Pekerjaan Orang Tua</label>
                            <select class="form-control select2" name="pekerjaan_ortu" id="pekerjaan_ortu">
                                <option value="">-- Pilih pekerjaan orang tua --</option>
                                <option value="Tidak Bekerja"
                                    {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Tidak Bekerja' ? 'selected' : '' }}>
                                    Tidak Bekerja
                                </option>
                                <option value="Honorer"
                                    {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Honorer' ? 'selected' : '' }}>
                                    Honorer
                                </option>
                                <option value="Serabutan"
                                    {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Serabutan' ? 'selected' : '' }}>
                                    Serabutan
                                </option>
                                <option value="Wiraswasta"
                                    {{ isset($biodata_spk) && $biodata_spk->pekerjaan_ortu === 'Wiraswasta' ? 'selected' : '' }}>
                                    Wiraswasta
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Detail Pekerjaan</label>
                            <input type="text"
                                value="{{ old('detail_pekerjaan', $biodata_spk ? $biodata_spk->detail_pekerjaan : '') }}"
                                class="form-control @error('detail_pekerjaan') is-invalid @enderror" name="detail_pekerjaan"
                                id="detail_pekerjaan" placeholder="e.g pemilik toko">
                            @error('detail_pekerjaan')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Penghasilan Orang Tua</label>
                            <input type="text"
                                value="{{ old('gaji_ortu', $biodata_spk ? $biodata_spk->gaji_ortu : '') }}"
                                class="form-control" name="gaji_ortu" id="gaji_ortu" placeholder="e.g 1.000.000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Luas Tanah</label>
                            <input type="text"
                                value="{{ old('luas_tanah', $biodata_spk ? $biodata_spk->luas_tanah : '') }}"
                                class="form-control" name="luas_tanah" id="luas_tanah" placeholder="e.g 200 (satuan meter)">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Slip Gaji</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti SHM (Surat Hak Milik) Tanah</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Jumlah Kamar</label>
                            <input type="text" value="{{ old('jml_kmr', $biodata_spk ? $biodata_spk->jml_kmr : '') }}"
                                class="form-control @error('jml_kmr') is-invalid @enderror" name="jml_kmr" id="jml_kmr"
                                placeholder="masukkan jumlah kamar">
                            @error('jml_kmr')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Kepemilikan Kamar Mandi</label>
                            <select class="form-control select2" name="jml_kmr_mandi" id="jml_kmr_mandi">
                                <option value="">-- Pilih --</option>
                                <option value="Memiliki"
                                    {{ isset($biodata_spk) && $biodata_spk->jml_kmr_mandi === 'Memiliki' ? 'selected' : '' }}>
                                    Memiliki
                                </option>
                                <option value="Tidak Memiliki"
                                    {{ isset($biodata_spk) && $biodata_spk->jml_kmr_mandi === 'Tidak Memiliki' ? 'selected' : '' }}>
                                    Tidak Memilki
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Foto Kamar</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti Foto Kamar Mandi</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Listrik yang digunakan</label>
                            <select class="form-control select2" name="tagihan_listrik" id="tagihan_listrik">
                                <option value="">-- Pilih --</option>
                                <option value="Tidak Memiliki"
                                    {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === 'Tidak Memilki' ? 'selected' : '' }}>
                                    Tidak Memiliki
                                </option>
                                <option value="450 Watt"
                                    {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === '450 Watt' ? 'selected' : '' }}>
                                    Listrik 450 watt
                                </option>
                                <option value="900 Watt"
                                    {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === '900 Watt' ? 'selected' : '' }}>
                                    Listrik 900 watt
                                </option>
                                <option value="1300 Watt"
                                    {{ isset($biodata_spk) && $biodata_spk->tagihan_listrik === '1300 Watt' ? 'selected' : '' }}>
                                    Listrik 1300 watt
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Pajak Bumi dan Bangunan</label>
                            <input type="text" value="{{ old('pbb', $biodata_spk ? $biodata_spk->pbb : '') }}"
                                class="form-control" name="pbb" id="pbb" placeholder="e.g 450.000">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Tagihan Listrik</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti Slip Pajak Bumi dan Bangunan</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Jumlah Saudara</label>
                            <input type="text" value="{{ old('jml_sdr', $biodata_spk ? $biodata_spk->jml_sdr : '') }}"
                                class="form-control @error('jml_sdr') is-invalid @enderror" name="jml_sdr" id="jml_sdr"
                                placeholder="masukkan jumlah saudara">
                            @error('jml_sdr')
                                <div class="invalid-feedback feed ml-3">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Status Orang Tua</label>
                            <select class="form-control select2" name="status_ortu" id="status_ortu">
                                <option value="">-- Pilih --</option>
                                <option value="Yatim Piatu"
                                    {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Yatim Piatu' ? 'selected' : '' }}>
                                    Yatim Piatu
                                </option>
                                <option value="Yatim"
                                    {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Yatim' ? 'selected' : '' }}>
                                    Yatim
                                </option>
                                <option value="Piatu"
                                    {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Piatu' ? 'selected' : '' }}>
                                    Piatu
                                </option>
                                <option value="Tidak Semuanya"
                                    {{ isset($biodata_spk) && $biodata_spk->status_ortu === 'Tidak Semuanya' ? 'selected' : '' }}>
                                    Tidak Semuanya
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex">
                        <div class="form-group col-md-6">
                            <label for="">Bukti Surat Ket Saudara</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Bukti Surat Ket Yatim</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex mb-4">
                        <div class="form-group col-md-6">
                            <label for="">Jumlah Hutang</label>
                            <input type="text"
                                value="{{ old('jml_hutang', $biodata_spk ? $biodata_spk->jml_hutang : '') }}"
                                class="form-control" name="jml_hutang" id="jml_hutang" placeholder="e.g 500.000">
                        </div>
                    </div>
                    <div class="mr-4 mb-5 text-right">
                        <button class="btn btn-save px-5">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        @if (session('success') === 'success-biodata')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Biodata pendaftar berhasil disimpan.',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-alert',
                },
            });
        @elseif ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menyimpan Data',
                text: 'Ada kesalahan dalam pengisian form silahkan cek kembali !',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-wrong',
                },
            });
        @endif
    </script>
    <script>
        @if (session('success') === 'success-biodata-spk')
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data pendukung berhasil disimpan.',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-alert',
                },
            });
        @endif
    </script>
@endsection

@push('customScript')
@endpush

@push('style')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
