@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <h1 class="h3 mb-2 text-gray-800 text-center">Tautan Sosial Media</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a class="btn btn-success px-4 py-2 ml-auto" data-bs-toggle="modal" data-bs-target="#tambahTautanModal">Tambah Tautan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Sosial Media</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->link }}</td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a class="btn btn-warning btn-icon-split btn-sm" data-bs-toggle="modal" data-bs-target="#{{ 'edit' . $item->id }}"><span class="text">Edit</span>
                                </a>
                                <a id="deleteButton" href="{{ url('/admin/tautan/hapus/' . $item->id) }}"
                                    class="btn btn-danger btn-icon-split btn-sm">
                                    <span class="text">Hapus</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@include('admin.socmedLinks.create')
@foreach ($items as $item)
@include('admin.socmedLinks.edit')
@endforeach
@endsection