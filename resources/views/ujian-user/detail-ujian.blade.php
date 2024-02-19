@extends('ujian-user.app')
@section('title', 'BIDIKSIBA POLINEMA | List Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-9 mx-auto my-4">
        <div class="col-md-12 d-flex p-main-title mb-0 py-1 px-3">
            <div class="col-md-6 p-0">
                <p class="m-0 p-0">DETAIL UJIAN</p>
            </div>
        </div>
        <div class="p-main pt-1 pb-3 px-3">
            <p class="mt-1 mb-2 font-weight-bold" style="text-transform: uppercase;">
                ~ {{ $detail_ujians->nama_ujian }} ~
            </p>
            <hr class="mt-0 mb-1 p-0">
            <div class="d-flex m-0">
                <p class="col-md-1 ml-4 mr-0 my-1 p-0 p-d">NAMA</p>
                <p class="m-1 p-d" style="text-transform: uppercase;">: {{ $detail_ujians->nama }}</p>
            </div>
            <div class="d-flex">
                <p class="col-md-1 ml-4 mr-0 my-1 p-0 p-d">SESI</p>
                <p class="m-1 p-d">: {{ $detail_ujians->nama_sesi }}</p>
            </div>
            <div class="d-flex">
                <p class="col-md-1 ml-4 mr-0 my-1 p-0 p-d">MULAI</p>
                <p class="m-1 p-d">: {{ \Carbon\Carbon::parse($detail_ujians->waktu_mulai)->format('d F Y H:i:s') }}</p>
            </div>
            <div class="d-flex">
                <p class="col-md-1 ml-4 mr-0 my-1 p-0 p-d">SELESAI</p>
                <p class="m-1 p-d">: {{ \Carbon\Carbon::parse($detail_ujians->waktu_akhir)->format('d F Y H:i:s') }}</p>
            </div>
            <div class="d-flex">
                <p class="col-md-1 ml-4 mr-0 my-1 p-0 p-d">JUMLAH</p>
                <p class="m-1 p-d">: {{ $jumlah_soal_ujian }} SOAL</p>
            </div>
            <div class="d-flex">
                <p class="col-md-1 ml-4 mr-0 my-1 p-0 p-d">WAKTU</p>
                <p class="m-1 p-d">: {{ $durasi_menit }} menit</p>
            </div>
            <hr class="mt-1 p-0">
            <div class="text-right">
                <a href="{{ route('list.ujian') }}" class="px-4 btn btn-sm btn-secondary font-weight-bold">Back</a>
                <a href="" class="px-4 btn btn-sm btn-success font-weight-bold">Mulai</a>
            </div>
        </div>
    </div>
@endsection
