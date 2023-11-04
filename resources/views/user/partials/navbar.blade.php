<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">KARSA MINI SOCCER</a>
        <div id="cart-icon-2" class="button-keranjang ms-auto" style="margin-right: 15px">
            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-cart-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
            </a>
        </div>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon middle-bar"></span>
            <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                <li id="cart-icon" class="nav-item item-keranjang" style="margin-right: 10px">
                    <a id="cart-icon" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-cart-fill" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                    </a>
                </li>
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
                    <button type="button" class="btn btn-login" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Login</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-register" data-bs-toggle="modal"
                        data-bs-target="#registerModal">Register</button>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- @include('user.venue.create') --}}
@include('auth.login.index')
@include('auth.register.index')
