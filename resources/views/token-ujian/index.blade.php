@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Token Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto my-4">
        <p class="p-main-title mb-0 py-1 px-3">TOKEN UJIAN</p>
        <div class="p-main pt-1 pb-4 px-3">
            <div class="card col-md-9 mx-auto my-4 px-5 py-3">
                <pre class="m-1 text-pre">NAMA        : <span class="s-pre-n">{{ $tokenUjians ? $tokenUjians->nama : '-' }}</span></pre>
                <pre class="m-1 text-pre">TOKEN UJIAN : <span class="s-pre">{{ $tokenUjians ? $tokenUjians->token : '-' }}</span></pre>
                <pre class="m-1 text-pre">PASSWORD    : <span class="s-pre">{{ $tokenUjians ? $tokenUjians->password : '-' }}</span></pre>
            </div>
        </div>
    </div>
@endsection
