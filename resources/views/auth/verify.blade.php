@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Verifikasi Email')
@push('style')
    <link rel="stylesheet" href="/assets/css/dashboard.css">
@endpush
@section('main')
    <section>
        <div class="main-verif col-md-10 mx-auto my-5 bg-white px-5 py-5">
            <h2>Silahkan Verifikasi Email Anda</h2>
            <hr>
            <div>{{ __('Verifikasi alamat email anda') }}</div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                </div>
            @endif

            {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk verifikasi lagi') }}</button>.
            </form>
    </section>
@endsection
