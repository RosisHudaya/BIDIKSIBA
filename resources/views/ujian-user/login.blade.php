@extends('landing-page.app')
@section('title', 'BIDIKSIBA POLINEMA | Token Ujian')
@push('style')
    <link rel="stylesheet" href="/assets/css/public.css">
@endpush
@section('main')
    <div class="col-md-11 mx-auto my-4">
        <p class="p-main-title mb-0 py-1 px-3">LOGIN UJIAN
        </p>
        <div class="p-main pt-1 pb-4 px-3">
            <div class="card col-md-7 mx-auto my-4 px-5 py-3">
                <h6 class="mx-auto my-3">!!! Masukkan token dan password ujian !!!</h6>
                <form method="POST" action="{{ route('login.ujian.post') }}">
                    @csrf
                    @if (session('error'))
                        <p id="p-error" class="text-c m-0 p-0">{{ session('error') }}</p>
                    @endif
                    <div class="d-flex form-group my-2">
                        <i class="fas fa-user my-auto f-icon"></i>
                        <input type="text" name="token" value="{{ old('token') }}" class="form-control form-login"
                            placeholder="Token...">
                    </div>
                    <div class="d-flex form-group my-2">
                        <i class="fas fa-key my-auto f-icon"></i>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control form-login"
                            placeholder="Password...">
                    </div>
                    <div class="form-group my-2 text-right">
                        <button type="submit" class="btn btn-save px-4">
                            LOGIN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('customScript')
    <script>
        setTimeout(function() {
            document.getElementById('p-error').style.display = 'none';
        }, 3000);
    </script>
@endpush
