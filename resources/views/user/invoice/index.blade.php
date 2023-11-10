@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/invoice.css">

<div class="container content-pembelian">
    <h1 class="text-center">Daftar Transaksi</h1>

    <div class="scrollable-tabs-container mt-5">
        <a href="/pembelian" class="btn btn-tabs {{ ($status === 'semua') ? 'active' : '' }}">Semua</a>
        <a href="/pembelian?status=pending" class="btn btn-tabs {{ ($status === 'pending') ? 'active' : '' }}">Berlangsung</a>
        <a href="/pembelian?status=paid" class="btn btn-tabs {{ ($status === 'paid') ? 'active' : '' }}">Selesai</a>
        <a href="/pembelian?status=paid_final" class="btn btn-tabs {{ ($status === 'paid_final') ? 'active' : '' }}">Belum Selesai</a>
        <a href="/pembelian?status=expire" class="btn btn-tabs {{ ($status === 'expire') ? 'active' : '' }}">Tidak Selesai</a>
    </div>

    <div class="isi-content mt-5">
        <div class="row">
            <div class="col-lg-6 col-md-8 mx-auto my-auto">
                @if (!$transaction->count())
                <div class="icon-not d-flex justify-content-center">
                    <img src="{{ asset('/img/data_not.png') }}" alt="">
                </div>                    
                @endif
                @foreach ($transaction as $item)
                <div class="card shadow p-3 border-0 mb-3">
                    <h2 class="mb-3 text-center">Sewa Lapangan</h2>
                    @if ($item->status_pay_early != 'paid_final')
                    <div class="header-content d-flex">
                        <h3 class="mb-3">Pembayaran DP</h3>
                        @if ($item->status_pay_early === 'pending')
                        <div class="teks-4">Tertunda</div>
                        @elseif ($item->status_pay_early === 'paid')
                        <div class="teks-2">Selesai</div>
                        @elseif ($item->status_pay_early === 'expire')
                        <div class="teks-3">Tidak Selesai</div>
                        @else
                        <div class="teks-3">Belum Selesai</div>
                        @endif
                    </div>
                    @endif
                    <div class="header-content d-flex">
                        <h3 class="mb-3">Pembayaran Akhir</h3>
                        @if ($item->status_pay_final === 'pending')
                        <div class="teks-4">Tertunda</div>
                        @elseif ($item->status_pay_final === 'paid')
                        <div class="teks-2">Selesai</div>
                        @elseif ($item->status_pay_final === 'expire' )
                        <div class="teks-3">Tidak Selesai</div>
                        @else
                        <div class="teks-3">Belum Selesai</div>
                        @endif
                    </div>
                    <table>
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td style="text-align: right">Rp. {{ $item->total_price }}</td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td style="text-align: right">Rp. {{ $item->pay_final }}</td>
                        </tr>
                    </table>
                    <div class="tombol mt-3 d-flex">
                        <button class="btn btn-invoice-utama">Detail</button>
                        @if ($item->status_pay_early != 'paid_final' && $item->status_pay_final != 'paid' && $item->status_pay_early === 'paid' && $item->status_pay_early != 'expire' && $item->status_pay_final != 'expire')
                        @if ($item->status_pay_early === 'pending' && $item->status_pay_final === 'pending')
                            
                        @else
                        <button class="btn btn-invoice-utama">Bayar</button>
                        @endif
                        @endif

                        @if ($item->status_pay_early != 'expire' && $item->status_pay_final != 'expire')
                        <button class="btn btn-invoice-utama btn bg-danger">Batal</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script src="/js/user/invoice.js"></script>
@endsection
