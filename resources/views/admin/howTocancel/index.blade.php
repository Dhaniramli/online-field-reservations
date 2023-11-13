@extends('admin.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/admin/privacy.css">

<div class="container content mt-4">
    <h1 class="h3 mb-2 text-gray-800 text-center">Cara & Syarat Pembatalan</h1>
    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <div class="card shadow">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="tombol-tambah ms-auto">
                        @if ($item)
                        <a class="btn btn-danger" href="{{ url('/admin/pembatalan/hapus/' . $item->id) }}"
                            id="deleteButton">Hapus</a>
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editHowTocancelModal">Edit
                            Data</a>
                        @else
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#howTocancelModal">Tambah Data</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if ($item)
            <div class="isi-content">
                {!! $item->body !!}
            </div>
            @else
            <div class="icon-nodata d-flex justify-content-center">
                <img src="{{ asset('/img/no_data_admin.png') }}" alt="">
            </div>
            @endif
        </div>

        <div class="card-footer">

        </div>
    </div>
</div>

@include('admin.howTocancel.create')
@include('admin.howTocancel.edit')
@endsection
