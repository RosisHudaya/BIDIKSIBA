@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Token Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto my-4">
        <p class="p-main-title mb-0 py-1 px-3">TOKEN UJIAN</p>
        <div class="p-main pt-1 pb-4 px-3">
            <div class="card c-token col-md-7 mx-auto my-4 px-5 py-3">
                <div class="col-token m-0 p-0">
                    <div class="d-flex">
                        <div class="col-md-4 m-0 p-0">
                            <p class="text-pre">NAMA </p>
                        </div>
                        <div class="col-md-8 m-0 p-0">
                            <p class="s-pre-n"> : {{ $biodata->nama ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-4 m-0 p-0">
                            <p class="text-pre">TOKEN UJIAN </p>
                        </div>
                        <div class="col-md-8 m-0 p-0">
                            <p class="s-pre"> : {{ $tokenUjians ? $tokenUjians->token : '-' }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-4 m-0 p-0">
                            <p class="text-pre">PASSWORD </p>
                        </div>
                        <div class="col-md-8 m-0 p-0">
                            <p class="s-pre"> : {{ $tokenUjians ? $tokenUjians->password : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
