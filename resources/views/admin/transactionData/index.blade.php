@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <h1 class="h3 mb-2 text-gray-800 text-center">Data Transaksi</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <select id="selectMenu" class="form-select" aria-label="Default select example" style="width: fit-content;">
                <option value="link1" {{ !$status ? 'selected' : '' }}>Semua Data Transaksi</option>
                <option value="link2" {{ $status === 'selesai' ? 'selected' : '' }}>Data Transaksi Selesai</option>
                <option value="link3" {{ $status === 'belum-selesai' ? 'selected' : '' }}>Data Transaksi Belum Selesai</option>
                <option value="link4" {{ $status === 'tidak-selesai' ? 'selected' : '' }}>Data Transaksi Tidak Selesai</option>
            </select>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nama Tim</th>
                            <th class="text-center">Nomor Telpon</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->user->created_at)->format('d F Y') }}</td>
                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                            <td>{{ $item->user->team_name }}</td>
                            <td class="text-center">{{ $item->user->phone_number }}</td>
                            <td class="text-center">{{ $item->total_price }}</td>
                            <td class="text-center">
                                @if ( $item->status_pay_early === 'paid' || $item->status_pay_final === 'paid')
                                Selesai
                                @elseif( $item->status_pay_early === 'expire' || $item->status_pay_final === 'expire' )
                                Tidak Selesai
                                @elseif( $item->status_pay_early === 'pending' || $item->status_pay_final === 'pending'
                                || $item->status_pay_early === 'unpaid' || $item->status_pay_final === 'unpaid' )
                                Belum Selesai
                                @endif
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a href="{{ url('/admin/data-transaksi/show/' . $item->id) }}"
                                    class="btn btn-info btn-icon-split btn-sm mb-2">
                                    <span class="text">Detail</span>
                                </a>
                                <a id="deleteButton" href="{{ url('/admin/data-transaksi/hapus/' . $item->id) }}"
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
        <div class="card card-footer">
            <a href="{{ url('/admin/data-transaksi/export') }}" class="btn btn-success">Download Excel</a>
        </div>
    </div>

</div>

<script>
    const links = {
    link1: "/admin/data-transaksi",
    link2: "/admin/data-transaksi?status=selesai",
    link3: "/admin/data-transaksi?status=belum-selesai",
    link4: "/admin/data-transaksi?status=tidak-selesai"
};

document.addEventListener('DOMContentLoaded', function () {
    const selectMenu = document.getElementById('selectMenu');

    selectMenu.addEventListener('change', function () {
        const selectedOption = selectMenu.options[selectMenu.selectedIndex].value;
        const selectedLink = links[selectedOption];
        if (selectedLink) {
            window.location.href = selectedLink;
        }
    });
});

</script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
