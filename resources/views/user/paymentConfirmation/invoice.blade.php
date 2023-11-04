@extends('user.layouts.main')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow p-5">
        <table id="dataTable1" class="display table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Total harga</th>
                    <th>Bayar Awal</th>
                    <th>Status Bayar Awal</th>
                    <th>Bayar Akhir</th>
                    <th>Status Bayar Akhir</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaction as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->total_price }}</td>
                    <td>{{ $item->pay_early }}</td>
                    <td>{{ $item->status_pay_early }}</td>
                    <td>{{ $item->pay_final }}</td>
                    <td>{{ $item->status_pay_final }}</td>
                    <td> <a href="/invoice/{{ $item->id }}" class="btn btn-primary btn-group-sm">Detail</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable1').DataTable({
            responsive: true
        });
    });
</script>
