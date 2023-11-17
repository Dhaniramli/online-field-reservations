<link rel="stylesheet" href="/css/user/navbar.css">

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container card-navbar">
        <div class="logo-dan-title d-flex align-items-center">
            <div class="navbar-logo">
                <img src="{{ asset('/img/karsa_logo_2.png') }}" alt="Logo">
            </div>
            <a class="navbar-brand" href="/">KARSA MINI SOCCER</a>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKarsa"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon middle-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarKarsa">
            {{-- <ul class="navbar-nav ms-auto mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('sewa-lapangan*') ? 'active' : '' }}" href="{{ Route('index-booking') }}">Sewa Lapangan</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <hr>
            </ul> --}}
            <ul class="navbar-nav navbar-btn ms-auto mb-2 mb-lg-0 mb-md-3 mb-sm-3">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('sewa-lapangan*') ? 'active' : '' }}" href="{{ Route('index-booking') }}">Sewa Lapangan</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('kontak-kami*') ? 'active' : '' }}" href="/kontak-kami">Kontak Kami</a>
                </li>
                <hr class="vertical-line">
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link mx-2 dropdown-toggle {{ Request::is('profile*') || Request::is('pembelian*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hai, {{ auth()->user()->first_name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('profile*') ? 'active' : '' }}" href="/profile"><i class="fa fa-user" aria-hidden="true"></i>
                                Profil</a></li>
                        <li>
                        <li><a class="dropdown-item {{ Request::is('pembelian*') ? 'active' : '' }}" href="/pembelian"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Pembelian</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a id="logoutButton" class="dropdown-item" href="/logout"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item mb-lg-0 mb-md-2 mb-sm-2 mx-2">
                    <a class="nav-link btn-login" href="/login">Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-register btn ml-lg-2 pl-lg-3 pr-lg-3" href="/register">Daftar</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>