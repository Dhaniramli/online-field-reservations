@extends('admin.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/admin/contact.css">

<div class="container content-contact mt-4">
    <h1 class="h3 mb-2 text-gray-800 text-center">Kontak Kami</h1>
    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <div class="card shadow">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="tombol-tambah ms-auto">
                        @if ($item)
                        <a class="btn btn-danger" href="{{ url('/admin/kontak-kami/hapus/' . $item->id) }}" id="deleteButton">Hapus</a>
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editKontakModal">Edit Data</a>
                        @else
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahKontakModal">Tambah Data</a>
                        @endif
                    </div>
                </div>                
            </div>
        </div>

        <div class="card-body">
           <table>
            <tr>
                <td>Alamat lengkap</td>
                <td>: {{ $item ? $item->address : '. . .' }}</td>
            </tr>
            <tr>
                <td>Nomor Telpon</td>
                <td>: {{ $item ? $item->phone_number : '. . .' }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $item ? $item->email : '. . .' }}</td>
            </tr>
           </table>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>

@include('admin.contactUs.create')
@include('admin.contactUs.edit')
@endsection