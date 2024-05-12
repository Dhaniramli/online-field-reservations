@extends('admin.layouts.main')

@section('content')
<link href="/css/admin/transactionData.css" rel="stylesheet">

<div class="container">
    <div class="card card-body shadow border-0">
        <table class="table table-borderless">
            <h2 class="title text-center mt-3">Data Pelanggan</h2>

            <tr>
                <td>Nama Lengkap</td>
                <td>: {{ $user->first_name }} {{ $user->last_name }}</td>
            </tr>
            <tr>
                <td>Nama Tim</td>
                <td>: {{ $user->team_name }}</td>
            </tr>
            <tr>
                <td>Nomor Telpon</td>
                <td>: {{ $user->phone_number }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $user->email }}</td>
            </tr>
        </table>
        <table class="table table-borderless">
            <h2 class="title text-center mt-3">Sewa Lapangan</h2>
            @foreach ($belanja as $item)
            <tr>
                <td class="h-12">
                    {{ $item->fieldList->name }}<br>
                    {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}<br>
                    {{ $item->time_start . ' - ' . $item->time_finish }}
                </td>
                <td class="text-right align-bottom" style="text-align: right;">Rp.{{ number_format($item->price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2s"><hr style="border: 1px solid black;"></td>
            </tr>
            @endforeach
        </table>
        <table class="table table-borderless">
            <h2 class="title text-center">Total Pembayaran</h2>
            <tr>
                <td class="h-12">
                    Total Harga<br>
                </td>
                <td class="h-12 " style="text-align: right;">
                    Rp. {{ number_format($transactionDetail->total_price, 0, ',', '.') }}
                </td>
            </tr>
            @if ($transactionDetail->status_pay_early != 'paid_final')
            <tr>
                <td class="h-12">
                    Pembayaran Dp<br>
                </td>
                <td class="h-12 " style="text-align: right;">
                    Rp. {{ number_format($transactionDetail->pay_early, 0, ',', '.') }}
                </td>
            </tr>
            @endif
            <tr>
                <td class="h-12">
                    Pembayaran Akhir
                </td>
                <td class="h-12 " style="text-align: right;">
                    Rp. {{ number_format($transactionDetail->pay_final, 0, ',', '.') }}
                </td>
            </tr>
    
            {{-- @if (!($transactionDetail->status_pay_early === 'expire' || $transactionDetail->status_pay_early === 'pending' || $transactionDetail->status_pay_final === 'pending' || $transactionDetail->status_pay_final ===
            'paid' || $transactionDetail->status_pay_final === 'expire'))
            <tr>
                <td colspan="2" class="h-12 text-center">
                    @if (!$cancel->where('transaction_id', $transactionDetail->id)->first())
                    <button id="pay-button" class="btn btn-myprimary btn-block mt-3">Bayar</button>
                    @endif
                </td>
            </tr>
            @endif --}}
    
        </table>
    </div>
    <div class="card card-footer">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>

@endsection