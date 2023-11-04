<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container card-navbar">
        <a class="navbar-brand" href="/">KARSA MINI SOCCER</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarKarsa"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon middle-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarKarsa">
            <ul class="navbar-nav ms-auto mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ Route('index-booking') }}">Sewa Lapangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <hr>
            </ul>
            <ul class="navbar-nav navbar-btn ms-auto mb-2 mb-lg-0 mb-md-3 mb-sm-3">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="/invoice">Pemberitahuan</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ auth()->user()->first_name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile"><i class="fa fa-user" aria-hidden="true"></i>
                                Profil</a></li>
                        <li>
                            <hr class="dropdown-divider" style="margin: 0px">
                        </li>
                        <li><a id="logoutButton" class="dropdown-item" href="/logout"><i class="fa fa-sign-out"
                                    aria-hidden="true"></i> Logout</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item mb-lg-0 mb-md-2 mb-sm-2">
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