<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">KARSA MINI SOCCER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Booking</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Jadwal Lapangan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/jadwal-lapangan">Lapangan 1</a></li>
                        <li><a class="dropdown-item" href="/jadwal-lapangan">Lapangan 2</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li>
                    <hr>
                </li>
            </ul>
            <ul class="navbar-nav navbar-btn ms-auto mb-2 mb-lg-0 mb-md-3 mb-sm-3">
                <li class="nav-item mb-lg-0 mb-md-3 mb-sm-4">
                    <button type="button" class="btn btn-login">Login</button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-regiter">Register</button>
                </li>
            </ul>
        </div>
    </div>
</nav>

@include('user.venue.create')
