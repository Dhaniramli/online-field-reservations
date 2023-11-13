@extends('admin.layouts.main')

@section('content')
<link href="/css/admin/cancel.css" rel="stylesheet">

<div class="container-fluid">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <h1 class="h3 mb-2 text-gray-800 text-center">Permintaan Pembatalan</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tableCancel">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nomor Telpon</th>
                            <th class="text-center">Nama Bank</th>
                            <th class="text-center">Nomor Rekening</th>
                            <th class="text-center">Alasan Pembatalan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td>{{ $item->userCancel->first_name }} {{ $item->userCancel->last_name }}</td>
                            <td>{{ $item->userCancel->phone_number }}</td>
                            <td>{{ $item->bank_name }}</td>
                            <td>{{ $item->account_number }}</td>
                            <td>{{ $item->reason }}</td>
                            <td>
                                @if ($item->status === 'pending')
                                <span class="status-pending">Menunggu</span>
                                @elseif($item->status === 'confirm')
                                <span class="status-confirmed">Selesai</span>
                                @elseif($item->status === 'reject')
                                <span class="status-reject">Ditolak</span>
                                @endif
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a id="saveButton" href="{{ url('/admin/permintaan-pembatalan/konfir/' . $item->id) }}"
                                    class="btn btn-success btn-icon-split btn-sm mb-2">
                                    <span class="text">Konfirmasi</span>
                                </a>
                                <a id="saveButton" href="{{ url('/admin/permintaan-pembatalan/tolak/' . $item->id) }}"
                                    class="btn btn-warning btn-icon-split btn-sm mb-2">
                                    <span class="text">Tolak</span>
                                </a>
                                <a id="deleteButton" href="{{ url('/admin/permintaan-pembatalan/hapus/' . $item->id) }}"
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var table = $('#tableCancel').DataTable({
        
        });
    });

</script>

@endsection

{{-- @include('admin.fieldList.create') --}}
