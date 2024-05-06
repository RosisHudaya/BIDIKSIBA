@extends('ujian-user.app')
@section('title', 'BIDIKSIBA POLINEMA | Detail Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-det col-md-11 d-flex mx-auto my-4">
        <div class="col-md-6 mb-4 card-desc">
            <div class="col-md-12 d-flex p-main-title mb-0 py-1 px-3">
                <div class="col-md-6 p-0">
                    <p class="m-0 p-0"><i class="fas fa-folder-open"></i> DESKRIPSI UJIAN</p>
                </div>
            </div>
            <div class="p-main pt-1 pb-3 px-3">
                <p class="mt-1 mb-2 font-weight-bold" style="text-transform: uppercase;">
                    ~ {{ $detail_ujians->nama_ujian }} ~
                </p>
                <hr class="mt-0 mb-1 p-0">
                <p class="m-0 p-0 p-d">{!! $detail_ujians->deskripsi !!}</p>
            </div>
        </div>
        <div class="col-md-6 card-det">
            <div class="col-md-12 d-flex p-main-title mb-0 py-1 px-3">
                <div class="col-md-6 p-0">
                    <p class="m-0 p-0"><i class="fas fa-bars"></i> DETAIL UJIAN</p>
                </div>
            </div>
            <div class="p-main pt-1 pb-3 px-3">
                <p class="mt-1 mb-2 font-weight-bold" style="text-transform: uppercase;">
                    ~ {{ $detail_ujians->nama_ujian }} ~
                </p>
                <hr class="mt-0 mb-1 p-0">
                <div class="d-flex">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">NISN</p>
                    <p class="col-md-10 m-1 p-d">: {{ $detail_ujians->nisn }}</p>
                </div>
                <div class="d-flex m-0">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">Nama</p>
                    <p class="col-md-10 m-1 p-d" style="text-transform: uppercase;">: {{ $detail_ujians->nama }}</p>
                </div>
                <div class="d-flex">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">Sesi</p>
                    <p class="col-md-10 m-1 p-d">: {{ $detail_ujians->nama_sesi }}</p>
                </div>
                <div class="d-flex">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">MulaiI</p>
                    <p class="col-md-10 m-1 p-d">:
                        {{ \Carbon\Carbon::parse($detail_ujians->waktu_mulai)->format('d F Y H:i:s') }}</p>
                </div>
                <div class="d-flex">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">Selesai</p>
                    <p class="col-md-10 m-1 p-d">:
                        {{ \Carbon\Carbon::parse($detail_ujians->waktu_akhir)->format('d F Y H:i:s') }}</p>
                </div>
                <div class="d-flex">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">Soal</p>
                    <p class="col-md-10 m-1 p-d">: {{ $jumlah_soal_ujian }}</p>
                </div>
                <div class="d-flex">
                    <p class="p-det col-md-2 ml-4 mr-0 my-1 p-0 p-d">Waktu</p>
                    <p class="col-md-10 m-1 p-d">: {{ $durasi_menit }} menit</p>
                </div>
                <hr class="mt-1 p-0">
                <div class="d-flex justify-content-end text-right btn-det">
                    <a href="{{ route('list.ujian') }}" class="px-4 mr-1 btn btn-sm btn-secondary font-weight-bold">Back</a>
                    <a href="{{ route('ujian', $detail_ujians->id) }}"
                        class="px-4 btn btn-sm btn-success font-weight-bold">
                        Mulai
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
