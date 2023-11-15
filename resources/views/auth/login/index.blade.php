<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/img/soccer-ball.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('/img/soccer-ball.png') }}">

    <title>Karsa Mini Soccer | Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/colors.css">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body class="d-flex align-items-center">

    <div class="container content-login">
        @if(session('loginError'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{!! session('
                loginError ') !!}',
                showConfirmButton: false,
                timer: 1000
            });

        </script>
        @endif
        @if(session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{!! session('
                success ') !!}',
                showConfirmButton: false,
                timer: 1000
            });

        </script>
        @endif

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block"
                                style="background-image: url('{{ asset('/img/login_img.jpeg') }}'); background-size: cover;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Silahkan Login</h1>
                                    </div>
                                    <form class="user" action="/login" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <input name="email" type="email"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Masukkan Alamat Email..." value="{{ old('email') }}">
                                            @error('email')
                                            <div class="invalid-feedback ml-4">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password"
                                                class="form-control form-control-user @error('password') is-invalid @enderror"
                                                id="password" placeholder="Kata Sandi">
                                            @error('password')
                                            <div class="invalid-feedback ml-4">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {{-- <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div> --}}
                                        </div>
                                        <button type="submit" class="btn btn-login btn-user btn-block mt-5">
                                            Masuk
                                        </button>
                                        {{-- <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> --}}
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        {{-- <a class="small" href="forgot-password.html">Forgot Password?</a> --}}
                                    </div>
                                    <div class="text-center teks-buatAkun">
                                        Belum punya akun? <a class="btn-toRegister" href="/register">Daftar!</a>
                                    </div>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>
