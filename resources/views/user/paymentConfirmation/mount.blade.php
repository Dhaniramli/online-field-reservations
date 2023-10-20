@extends('user.layouts.main')

@section('content')
<div class="container content-paymentConfirmation">
    <div class="card mt-5 p-4">
        <h1 class="title-jadwal text-center">Detail Pembayaran</h1>
        {{-- <p class="text-center sub-title-paymentConfir">Pastikan detail pemesanan sudah sesuai dan benar.</p> --}}

        <button id="pay-button">Pay! {{ $snapToken }}</button>
    </div>


</div>

{{-- <div class="container-fluid box-pembayaran">
    <div class="container">
        <a id="pay-button" class="btn btn-konfirmasi-pembayaran w-100"
            href="#">Konfirmasi Pembayaran</a>
    </div>
</div> --}}
</div>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('{{ $snapToken }}');
        // customer will be redirected after completing payment pop-up

        snap.pay(paymentData, {
            onSuccess: function (result) {
                // Tindakan jika pembayaran berhasil
                console.log('Pembayaran berhasil: ' + JSON.stringify(result));
            },
            onPending: function (result) {
                // Tindakan jika pembayaran masih tertunda
                console.log('Pembayaran tertunda: ' + JSON.stringify(result));
            },
            onError: function (result) {
                // Tindakan jika pembayaran gagal
                console.log('Pembayaran gagal: ' + JSON.stringify(result));
            },
            onClose: function () {
                // Tindakan jika pengguna menutup pop-up pembayaran
                console.log('Pop-up pembayaran ditutup');
            },
        });
    });

</script>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
