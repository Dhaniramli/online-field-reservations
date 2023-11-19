@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/invoice.css">

<div class="container show-invoice">

    <div class="row">
        <div class="col-lg-6 mx-auto my-auto">
            <div class="card p-2 mb-5">
                <h1 class="title-pelanggan mt-2 text-center" data-aos="zoom-in" data-aos-duration="2000">Detail Sewa Lapangan</h1>

                <table class="table">
                    @foreach ($belanja as $item)
                    <tr>
                        <td class="h-12">
                            {{ $item->fieldList->name }}<br>
                            {{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}<br>
                            {{ $item->time_start . ' - ' . $item->time_finish }}
                        </td>
                        <td class="text-right align-bottom" style="text-align: right;">Rp.
                            {{ number_format($item->price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </table>
                <table class="table table-borderless">
                    <h2 class="title-total text-center">Total Pembayaran</h2>
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

                    @if (!($transactionDetail->status_pay_early === 'expire' || $transactionDetail->status_pay_early === 'pending' || $transactionDetail->status_pay_final === 'pending' || $transactionDetail->status_pay_final ===
                    'paid' || $transactionDetail->status_pay_final === 'expire'))
                    <tr>
                        <td colspan="2" class="h-12 text-center">
                            @if (!$cancel->where('transaction_id', $transactionDetail->id)->first())
                            <button id="pay-button" class="btn btn-myprimary btn-block mt-3">Bayar</button>
                            @endif
                        </td>
                    </tr>
                    @endif

                </table>

                @if ($cancel->where('transaction_id', $transactionDetail->id)->first())
                    <h4 class="text-center mt-4 mb-2">Pembatalan menunggu konfirmasi dari admin</h4>
                @else
                <a class="text-center cek-email mt-4 mb-2" href="mailto:{{ Auth::user()->email }}">Cek email untuk info pembayaran</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var payButtonFull = document.getElementById('pay-button');

        payButtonFull.addEventListener('click', function () {
            console.log('testing');

            axios.put('/generate-snap-token/' + '{{ $transactionDetail->id }}')
                .then(function (response) {
                    var snapToken = response.data.snapToken;
                    handlePayment(snapToken);
                })
                .catch(function (error) {
                    console.error('Gagal mendapatkan Snap Token:', error.response.data);
                });
        });

        function handlePayment(snapToken) {
            // Membuka popup pembayaran Snap
            window.snap.pay(snapToken, {
                onSuccess: function (result) {
                    console.log('Pembayaran berhasil: ' + JSON.stringify(result));
                },
                onPending: function (result) {
                    console.log('Pembayaran tertunda: ' + JSON.stringify(result));

                },
                onError: function (result) {
                    console.log('Pembayaran gagal: ' + JSON.stringify(result));

                },
                onClose: function () {

                    console.log('Pop-up pembayaran ditutup');
                },
            });
        }
    });

</script>
@endsection
