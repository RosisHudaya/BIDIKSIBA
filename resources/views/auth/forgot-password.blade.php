<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Forgot Password</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/landing-page.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/auth.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <section>
            <div class="col-md-4 auth-page py-5 px-0 mx-auto my-5">
                <div class="d-flex justify-content-center">
                    <img class="img-fluid img-auth mr-3" src="{{ asset('assets/img/graduation.svg') }}">
                    <div>
                        <p class="mb-0 mt-2 p-w">Welcome</p>
                        <a href="/" class="s-b">BIDIKSIBA </a><span class="s-p">POLINEMA</span>
                    </div>
                </div>
                <div class="col-md-10 mx-auto mt-4">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <p class="p-forgot my-0">Kami akan mengirimkan tautan untuk mengatur ulang kata sandi</p>
                            <p class="p-forgot-2">Silahkan masukkan alamat email anda</p>
                            <input id="email" type="email"
                                class="form-control form-auth @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            @if (session('status'))
                                <div>
                                    <strong class="p-alert">Kami telah mengirimkan tautan melalui email</strong>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-auth">
                            Kirim Tautan Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

</body>

</html>
