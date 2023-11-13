<link href="/css/admin/sidebar.css" rel="stylesheet">

<ul class="navbar-nav sidebar accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        {{-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> --}}
        <div class="sidebar-brand-text mx-3">Karsa Mini Soccer</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item {{ Request::is('admin/lapangan*') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('index-lapangan') }}">
            <i class="fas fa-futbol"></i>
            <span>Lapangan</span></a>
    </li>
    <li class="nav-item {{ Request::is('admin/permintaan-pembatalan*') ? 'active' : '' }}">
        <a class="nav-link " href="{{ Route('index-cancel') }}">
            <i class="fas fa-fw fa-ban"></i>
            <span>Permintaan Pembatalan</span></a>
    </li>

    <li class="nav-item {{ (Request::is('admin/kontak-kami*') || Request::is('admin/kebijakan-privasi*') || Request::is('admin/cara-booking*') || Request::is('admin/pembayaran*') || Request::is('admin/pembatalan*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-asterisk"></i>
            <span>Lainnya</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/kontak-kami*') ? 'active' : '' }}" href="/admin/kontak-kami">Kontak Kami</a>
                <a class="collapse-item {{ Request::is('admin/kebijakan-privasi*') ? 'active' : '' }}" href="/admin/kebijakan-privasi">Kebijakan Privasi</a>
                <a class="collapse-item {{ Request::is('admin/cara-booking*') ? 'active' : '' }}" href="/admin/cara-booking">Cara Booking</a>
                <a class="collapse-item {{ Request::is('admin/pembayaran*') ? 'active' : '' }}" href="/admin/pembayaran">Pembayaran</a>
                <a class="collapse-item {{ Request::is('admin/pembatalan*') ? 'active' : '' }}" href="/admin/pembatalan">Pembatalan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
