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
                    @include('biodata.data-pendukung')
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
