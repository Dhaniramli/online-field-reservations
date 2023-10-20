@extends('user.layouts.main')

@section('content')
<div class="container content-paymentConfirmation">
    <h1 class="title-jadwal text-center mt-5">Periksa Pemesanan Anda</h1>
    <p class="text-center sub-title-paymentConfir">Pastikan detail pemesanan sudah sesuai dan benar.</p>


</div>

<div class="container-fluid box-pembayaran">
    <div class="container">
        <div class="row mb-2">
            <div class="col-12 content-total-kanan">
                <h6>Total Rp. <span id="totalPrice"></span></h6>
            </div>
        </div>
        <a id="btn-konfirmasi-pemesanan" class="btn btn-konfirmasi-pemesanan w-100"
            href="/bayar/">Konfirmasi Pemesanan</a>
    </div>
</div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
