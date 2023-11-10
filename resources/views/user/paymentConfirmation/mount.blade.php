@extends('user.layouts.main')

@section('content')
<div class="container content-mount">

    <h1 class="title-jadwal text-center mt-4">Detail Pembayaran</h1>
    {{-- <p class="text-center sub-title-paymentConfir">Pastikan detail pemesanan sudah sesuai dan benar.</p> --}}

    <div class="row mt-5 mb-5">
        <div class="col-lg-6">
            <div class="card">
                <h1 class="title-pelanggan mt-4 text-center">Detail Pelanggan</h1>
                <table class="table table-borderless">
                    <tr>
                        <td class="h-12">Nama Tim</td>
                        <td>: Belum ada</td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td>: {{ $user->first_name }} {{ $user->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: {{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telpon</td>
                        <td>: {{ $user->phone_number }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
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
                    <h2 class="title-total text-center">Total Bayar</h2>
                    <tr>
                        <td class="h-12">
                            Total Harga<br>
                        </td>
                        <td class="h-12 " style="text-align: right;">
                            Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="h-12">
                            Bayar
                        </td>
                        <td class="h-12 " style="text-align: right;">
                            Rp. {{ number_format($gross_amount, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="h-12 text-center">
                            <button id="pay-button" class="btn btn-success btn-myprimary btn-block">Bayar</button>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var payButtonFull = document.getElementById('pay-button');
        var pdfLink = document.getElementById('pdf-link');
        var dataTransaksi;

        payButtonFull.addEventListener('click', function () {
            console.log('testing');

            axios.post('/pay', {
                    belanja: '{{ $belanja }}',
                    totalPrice: '{{ $totalPrice }}',
                    ids: '{{ $ids }}',
                    user: '{{ $user }}',
                    gross_amount: '{{ $gross_amount }}'
                })
                .then(function (response) {
                    var snapToken = response.data.snapToken;
                    dataTransaksi = response.data.dataTransaksi;
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
                    window.location.href = '/pembelian'
                },
                onPending: function (result) {
                    console.log('Pembayaran tertunda: ' + JSON.stringify(result));
                    window.location.href = '/pembelian'

                    console.log('data transaksi :' + dataTransaksi);
                },
                onError: function (result) {
                    console.log('Pembayaran gagal: ' + JSON.stringify(result));
                    
                    axios.get('/deleteTransaction/' + dataTransaksi.id)
                        .then(function (response) {
                            console.log('Data dihapus');
                        })
                        .catch(function (error) {
                            console.log('Data gagal dihapus: ' + error);
                        });
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
                    axios.get('/deleteTransaction/' + dataTransaksi.id)
                        .then(function (response) {
                            console.log('Data dihapus');
                        })
                        .catch(function (error) {
                            console.log('Data gagal dihapus: ' + error);
                        });
                },
            });
        }
    });

</script>
@endsection
