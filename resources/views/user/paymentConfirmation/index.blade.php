@extends('user.layouts.main')

@section('content')
<div class="container content-paymentConfirmation">

    <div class="card mt-5 p-4">
        <h1 class="title-jadwal text-center">Periksa Pemesanan Anda</h1>
        <p class="text-center sub-title-paymentConfir">Pastikan detail pemesanan sudah sesuai dan benar.</p>
    
        @php
        $bannedIds = []; // ID yang akan dibanned
        $unbannedIds = []; // ID yang belum dibanned
        @endphp
        @foreach ($items as $item)
        @if (!in_array($item->id, $bannedIds))
        @php
        array_push($unbannedIds, $item->id); // Tambahkan ID yang belum dibatasi
        @endphp
        <div class="card card-paymentC p-3 mb-3" data-id="{{ $item->id }}" data-selected="false">
            <div class="row">
                <div class="col-7 content-kiri">
                    <h1>{{ $item->fieldList->name }}</h1>
                    <h2>{{ \Carbon\Carbon::parse($item->date)->format('d F Y') }}</h2>
                    <h3>{{ $item->time_start . ' - ' . $item->time_finish }}</h3>
                </div>
                <div class="col-5 content-kanan">
                    <h4>Rp. {{ $item->price }}</h4>
                    <button class="btn btn-tambah btn-success" data-item-id="{{ $item->id }}"
                        data-item-price="{{ $item->price }}">Tambah</button>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

</div>

<div class="container-fluid box-pembayaran">
    <div class="container">
        <a id="btn-konfirmasi-pemesanan" class="btn btn-konfirmasi-pemesanan w-100"
            href="/payment/{{ implode(',', $unbannedIds) }}">Konfirmasi Pemesanan</a>
    </div>
</div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var bannedIds = [];

        $(".btn-tambah").click(function () {
            var itemId = $(this).data("item-id");
            bannedIds.push(itemId); // Tambahkan ID ke dalam bannedIds
            $(this).closest(".card-paymentC").remove();
            updateTotalPrice();
        });

        function updateTotalPrice() {
            var totalPrice = 0;
            var unbannedIds = [];

            $(".btn-tambah").each(function () {
                var itemId = $(this).data("item-id");
                var itemPrice = $(this).data("item-price");
                if (!bannedIds.includes(itemId)) {
                    totalPrice += itemPrice;
                    unbannedIds.push(itemId);
                }
            });

            $("#totalPrice").text(totalPrice);
            var konfirmasiLink = "/payment/" + unbannedIds.join(',');
            $("#btn-konfirmasi-pemesanan").attr("href", konfirmasiLink);
        }
    });

</script>
