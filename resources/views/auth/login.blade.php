<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} - Login</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
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
                        <span class="s-b">BIDIKSIBA </span><span class="s-p">POLINEMA</span>
                    </div>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-10 mx-auto mt-4">
                    <form action="{{ route('login') }}" method="POST" class="needs-validation" novalidate="">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="form-control form-auth @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <input type="password" name="password"
                                class="form-control form-auth mb-2 @error('password') is-invalid @enderror"
                                placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="text-right">
                                <a href="/forgot-password" class="text-small a-f">
                                    Forgot Password?
                                </a>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <button type="submit" class="btn btn-lg btn-block btn-auth" tabindex="4">
                                LOGIN
                            </button>
                        </div>
                    </form>
                    <p class="text-center p-d">Belum punya akun? <a class="a-href" href="/register">Buat</a>
                    </p>
                </div>
        </section>
    </div>

    <!-- General JS Scripts -->
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

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
</body>

</html>
