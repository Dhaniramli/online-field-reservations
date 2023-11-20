@extends('admin.layouts.main')

@section('content')
<link href="/css/admin/dashboard.css" rel="stylesheet">

<div class="container-fluid">
    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <div class="card shadow border-0 p-4 mb-4">
        <div class="title text-center">
            <h1>Selamat Datang</h1>
        </div>
        <div class="subtitle text-center">
            <h2>Di Website Karsa Mini Soccer</h2>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-1 font-weight-bold text-primary text-uppercase mb-1">
                                Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user ? $user->count() : 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-1 font-weight-bold text-danger text-uppercase mb-1">
                                Jadwal Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $jadwalTersedia ? $jadwalTersedia->count() : 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thumbs-down fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-1 font-weight-bold text-success text-uppercase mb-1">
                                Jadwal Terjual</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $jadwalTerjual ? $jadwalTerjual->count() : 0}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-1 font-weight-bold text-warning text-uppercase mb-1">
                                Permintaan Pembatalan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $permintaanPembatalan ? $permintaanPembatalan->count() : 0}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ban fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
