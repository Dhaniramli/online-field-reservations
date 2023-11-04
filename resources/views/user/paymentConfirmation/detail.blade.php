@extends('user.layouts.main')

@section('content')
<div class="container mt-5">

    <div class="row">
        <div class="col-lg-6 mx-auto my-auto">
            <div class="card">
                <h1 class="title-pelanggan mt-4 text-center">Detail Pembayaran</h1>
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
                    <h2 class="title-total text-center">Total</h2>
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
                            Bayar Awal<br>
                        </td>
                        <td class="h-12 " style="text-align: right;">
                            Rp. {{ number_format($transactionDetail->pay_early, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td class="h-12">
                            Bayar
                        </td>
                        <td class="h-12 " style="text-align: right;">
                            Rp. {{ number_format($transactionDetail->pay_final, 0, ',', '.') }}
                        </td>
                    </tr>
                    @if ($transactionDetail->status_pay_early === 'expire' || $transactionDetail->status_pay_final ===
                    'paid')

                    @else
                    <tr>
                        <td colspan="2" class="h-12 text-center">
                            <button id="pay-button" class="btn btn-success">Bayar</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="h-12 text-center">
                            <a id="pdf-link" style="display: none" target="_blank" href="#">Lihat Info Pembayaran</a>
                        </td>
                    </tr>
                    @endif
                </table>

            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var payButtonFull = document.getElementById('pay-button');
        var pdfLink = document.getElementById('pdf-link');

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
                        window.location.href = '/invoice'
                    },
                    onPending: function (result) {
                        console.log('Pembayaran tertunda: ' + JSON.stringify(result));
                        
                                const pdfUrl = result.pdf_url;
                                pdfLink.href = pdfUrl;
                                pdfLink.style.display = 'block';

                                console.log(result.pdf_url);
                                window.location.href = '/invoice'

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
