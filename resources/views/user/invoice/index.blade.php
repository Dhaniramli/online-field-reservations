@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/invoice.css">

<div class="container content-pembelian">
    <h1 class="text-center">Daftar Transaksi</h1>

    <div class="scrollable-tabs-container mt-5">
        <a href="/pembelian" class="btn btn-tabs btn-block {{ ($status === 'semua') ? 'active' : '' }}">Semua</a>
        <a href="/pembelian?status=pending"
            class="btn btn-tabs btn-block {{ ($status === 'pending') ? 'active' : '' }}">Berlangsung</a>
        <a href="/pembelian?status=paid" class="btn btn-tabs btn-block {{ ($status === 'paid') ? 'active' : '' }}">Selesai</a>
        <a href="/pembelian?status=unpaid"
            class="btn btn-tabs btn-block {{ ($status === 'unpaid') ? 'active' : '' }}">Belum Selesai</a>
        <a href="/pembelian?status=expire" class="btn btn-tabs btn-block {{ ($status === 'expire') ? 'active' : '' }}">Tidak
            Selesai</a>
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
                    <div class="header-content d-flex">
                        <h2 class="mb-3">Sewa Lapangan</h2>
                        <p>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</p>
                    </div>

                    <table>
                        <tr>
                            <td>Total Harga</td>
                            <td style="text-align: right">Rp. {{ number_format($item->total_price, 0, ',', '.') }}</td>
                        </tr>
                        @if ($item->status_pay_early != 'paid_final')
                        <tr>
                            <td>Pembayaran Dp</td>
                            <td style="text-align: right">Rp. {{ number_format($item->pay_early, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Pembayaran Akhir</td>
                            <td style="text-align: right">Rp. {{ number_format($item->pay_final, 0, ',', '.') }}</td>
                        </tr>
                        @else
                        <tr>
                            <td>Pembayaran</td>
                            <td style="text-align: right">Rp. {{ number_format($item->pay_final, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td colspan="2">
                                <hr>
                            </td>
                        </tr>
                    </table>

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
                    @else
                    <div class="header-content d-flex">
                        <h3 class="mb-3">Pembayaran</h3>
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
                    @endif

                    <div class="tombol mt-3 d-flex">
                        <a href="/pembelian/{{ $item->id }}" class="btn btn-invoice-utama">Detail</a>

                        @if (!$cancel->where('transaction_id', $item->id)->first())
                            
                            @if ($item->status_pay_early != 'paid_final' && $item->status_pay_final != 'paid' &&
                                $item->status_pay_early === 'paid' && $item->status_pay_early != 'expire' &&
                                $item->status_pay_final != 'expire' && $item->status_pay_early != 'pending' &&
                                $item->status_pay_final != 'pending')
                                <button id="pay-button" data-item-id="{{ $item->id }}" class="btn btn-invoice-utama">Bayar</button>
                            @endif
                            
                            @if ($item->status_pay_early != 'expire' && $item->status_pay_final != 'expire')
                            <button class="btn btn-invoice-utama btn bg-danger" data-bs-toggle="modal" data-bs-target="#cancelModal{{ $item->id }}">Batal</button>
                            @endif

                        @endif


                    </div>

                    @if ($cancel->where('transaction_id', $item->id)->first())
                        @if ($cancel->where('transaction_id', $item->id)->where('status', 'pending')->first())
                        <h4 class="text-center mt-4 mb-2">Pembatalan menunggu konfirmasi dari admin</h4>
                        @elseif($cancel->where('transaction_id', $item->id)->where('status', 'confirm')->first())
                        <h4 class="text-center text-success mt-4 mb-2">Pembatalan diterima, silahkan cek rekening anda</h4>
                        @elseif($cancel->where('transaction_id', $item->id)->where('status', 'reject')->first())
                        <h4 class="text-center mt-4 mb-2">Pembatalan ditolak</h4>
                        @endif
                    @else
                    <a class="text-center cek-email mt-4 mb-2" href="mailto:{{ Auth::user()->email }}">Cek email untuk info pembayaran</a>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script src="/js/user/invoice.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


@foreach ($transaction as $item)
@include('user.invoice.cancel')
@endforeach

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var payButtonFull = document.getElementById('pay-button');
        var itemId = payButtonFull.getAttribute('data-item-id');

        payButtonFull.addEventListener('click', function () {
            console.log('testing');

            axios.put('/generate-snap-token/' + itemId)
                .then(function (response) {
                    var snapToken = response.data.snapToken;
                    handlePayment(snapToken);
                })
                .catch(function (error) {
                    console.error('Gagal mendapatkan Snap Token:', error.response.data);
                    location.reload();
                });
        });

        function handlePayment(snapToken) {
            // Membuka popup pembayaran Snap
            window.snap.pay(snapToken, {
                onSuccess: function (result) {
                    console.log('Pembayaran berhasil: ' + JSON.stringify(result));
                    window.location.href = '/pembelian'
                },
                onPending: function (result) {
                    console.log('Pembayaran tertunda: ' + JSON.stringify(result));

                    window.location.href = '/pembelian'

                    // axios.post('/transaction/pending', requestData)
                    // .then(response => {
                    //     console.log(response.data);
                    // })
                    // .catch(error => {
                    //     console.error(error);
                    // });
                },
                onError: function (result) {
                    console.log('Pembayaran gagal: ' + JSON.stringify(result));
                    // axios.put('/updateScheduleFalse/' + bookingId)
                    //     .then(function (response) {
                    //         console.log('Data berhasil diupdate ke false');
                    //         location.reload();
                    //     })
                    //     .catch(function (error) {
                    //         console.log('Gagal mengupdate data false: ' + error);
                    //         location.reload();
                    //     });
                },
                onClose: function () {
                    // axios.put('/updateScheduleFalse/' + bookingId)
                    //     .then(function (response) {
                    //         console.log('Data berhasil diupdate ke false');
                    //         // location.reload();
                    //     })
                    //     .catch(function (error) {
                    //         console.log('Gagal mengupdate data false: ' + error);
                    //         // location.reload();
                    //     });
                    console.log('Pop-up pembayaran ditutup');
                },
            });
        }
    });

</script>

@endsection
