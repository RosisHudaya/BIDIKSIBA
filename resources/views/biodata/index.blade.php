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
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Pekerjaan Orang Tua</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih pekerjaan orang tua --</option>
                            <option value="">Tidak Bekerja</option>
                            <option value="">Honorer</option>
                            <option value="">Serabutan</option>
                            <option value="">Wiraswasta</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Detail Pekerjaan</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 d-flex">
                    <div class="form-group col-md-6">
                        <label for="">Penghasilan Orang Tua</label>
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Luas Tanah</label>
                        <input type="number" class="form-control">
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
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Kepemilikan Kamar Mandi</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Memiliki</option>
                            <option value="">Tidak Memilki</option>
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
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Tidak Memiliki</option>
                            <option value="">Listrik 450 watt</option>
                            <option value="">Listrik 900 watt</option>
                            <option value="">Listrik 1300 watt</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Pajak Bumi dan Bangunan</label>
                        <input type="number" class="form-control">
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
                        <input type="number" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Status Orang Tua</label>
                        <select class="form-control select2" name="" id="">
                            <option value="">-- Pilih --</option>
                            <option value="">Yatim Piatu</option>
                            <option value="">Yatim</option>
                            <option value="">Piatu</option>
                            <option value="">Tidak Semuanya</option>
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
                        <input type="number" class="form-control">
                    </div>
                </div>
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
@endsection

@push('customScript')
@endpush

@push('style')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
@endpush
