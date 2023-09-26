<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

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

    <li class="nav-item {{ Request::is('admin/jam-main*') || Request::is('admin/hari-tanggal*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-calendar"></i>
            <span>Waktu</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/jam-main*') ? 'active' : ''}}" href="/admin/jam-main">Jam Main</a>
                <a class="collapse-item {{ Request::is('admin/hari-tanggal*') ? 'active' : ''}}" href="/admin/hari-tanggal">Hari & Tanggal</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Request::is('admin/daftar-lapangan*') || Request::is('admin/jadwal-lapangan*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-futbol"></i>
            <span>Lapangan</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ Request::is('admin/daftar-lapangan*') ? 'active' : ''}}" href="/admin/daftar-lapangan">Daftar Lapangan</a>
                <a class="collapse-item {{ Request::is('admin/jadwal-lapangan*') ? 'active' : ''}}" href="/admin/jadwal-lapangan">Jadwal Lapangan</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link " href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Lapangan</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
