@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <h1 class="h3 mb-2 text-gray-800 text-center">Data Pengguna</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Depan</th>
                            <th class="text-center">Nama Belakang</th>
                            <th class="text-center">Nama Tim</th>
                            <th class="text-center">Nomor Telpon</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->team_name }}</td>
                            <td>{{ $item->phone_number }}</td>
                            <td>{{ $item->email }}</td>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a id="deleteButton" href="{{ url('/admin/pengguna/hapus/' . $item->id) }}"
                                    class="btn btn-danger btn-icon-split btn-sm mb-2">
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

@endsection