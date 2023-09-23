@extends('admin.layouts.main')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid time-list">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 text-center">Jam Main</h1>

    <div class="row">
        <div class="col-lg-8 mx-auto my-auto">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex">
                    <button class="btn btn-success px-4 py-2 ml-auto" data-bs-toggle="modal"
                        data-bs-target="#createTimeModal">Tambah Jam Main</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Jam Main</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->time }}</td>
                                    <td class="text-center">
                                        <a href="#" type="button"
                                            class="btn btn-warning btn-icon-split btn-sm edit-button"
                                            data-bs-toggle="modal" data-bs-target="#{{ 'edit' . $item->id }}">
                                            <span class="text">Edit</span>
                                        </a>
                                        <a id="deleteButton" href="{{ url('/admin/jam-main/hapus/' . $item->id) }}"
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
    </div>

</div>
<!-- /.container-fluid -->

@endsection

@include('admin.timeList.create')

@foreach ($items as $item)
@include('admin.timeList.edit')
@endforeach

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        // Inisialisasi DataTables dengan konfigurasi pencarian
        var table = $('#dataTable').DataTable({
            searching: true, // Hanya aktifkan fitur pencarian
            paging: false, // Nonaktifkan paging (halaman)
            info: false, // Nonaktifkan info jumlah data
            ordering: false, // Nonaktifkan sorting
        });
    });

</script>
