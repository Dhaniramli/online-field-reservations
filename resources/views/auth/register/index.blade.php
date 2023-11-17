<!DOCTYPE html>
<html lang="en">

<head>
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{ asset('/img/karsa_logo.png') }}">
    

    <title>Karsa Mini Soccer | Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/colors.css">
    <link rel="stylesheet" href="/css/register.css">

</head>

<body class="d-flex align-items-center">

    <div class="container content-register">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block"
                        style="background-image: url('{{ asset('/img/login_img.jpeg') }}'); background-size: cover;">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat akun!</h1>
                            </div>
                            <form class="user" action="/register" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="first_name" type="text"
                                            class="form-control form-control-user @error('first_name') is-invalid @enderror"
                                            id="first_name" placeholder="Nama Depan" value="{{ old('first_name') }}">
                                        @error('first_name')
                                        <div class="invalid-feedback ml-4">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="last_name" type="text"
                                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                                            id="last_name" placeholder="Nama Belakang" value="{{ old('last_name') }}">
                                        @error('last_name')
                                        <div class="invalid-feedback ml-4">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="phone_number" type="number"
                                            class="form-control form-control-user @error('phone_number') is-invalid @enderror"
                                            id="phone_number" placeholder="Nomor Telpon"
                                            value="{{ old('phone_number') }}">
                                        @error('phone_number')
                                        <div class="invalid-feedback ml-4">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="team_name" type="team_name"
                                            class="form-control form-control-user @error('team_name') is-invalid @enderror"
                                            id="team_name" placeholder="Nama Tim" value="{{ old('team_name') }}">
                                        @error('team_name')
                                        <div class="invalid-feedback ml-4">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input name="email" type="email"
                                        class="form-control form-control-user @error('email') is-invalid @enderror"
                                        id="email" placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback ml-4">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            id="password" placeholder="Kata Sandi">
                                        @error('password')
                                        <div class="invalid-feedback ml-4">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="password_confirm" type="password"
                                            class="form-control form-control-user @error('password_confirm') is-invalid @enderror"
                                            id="password_confirm" placeholder="Konfirmasi Kata Sandi">
                                        @error('password_confirm')
                                        <div class="invalid-feedback ml-4">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-register btn-user btn-block mt-5">
                                    Daftar
                                </button>
                                {{-- <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> --}}
                            </form>
                            <hr>
                            <div class="text-center">
                                {{-- <a class="small" href="forgot-password.html">Forgot Password?</a> --}}
                            </div>
                            <div class="text-center teks-toLogin">
                                Sudah punya akun? <a class="btn-toLogin" href="/login">Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
        (registration) => {
            console.log("Service worker registration succeeded:", registration);
        },
        (error) => {
            console.error(`Service worker registration failed: ${error}`);
        },
        );
    } else {
        console.error("Service workers are not supported.");
    }
    </script>

</body>

</html>
