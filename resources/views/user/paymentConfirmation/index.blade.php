@extends('user.layouts.main')

@section('content')
<div class="container content-paymentConfirmation">
    <h1 class="title-jadwal text-center mt-5">Periksa Pemesanan Anda</h1>
    <p class="text-center sub-title-paymentConfir">Pastikan detail pemesanan sudah sesuai dan benar.</p>

    @php
    $totalPrice = 0;
    $bannedIds = []; // ID yang akan dibanned
    @endphp
    @foreach ($items as $item)
    @if (!in_array($item->id, $bannedIds))
    @php
    $totalPrice += $item->price; // Tambahkan harga hanya jika item tidak dibatasi
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
                {{-- <button class="btn-tambah" data-item-id="{{ $item->id }}">Hapus</button> --}}
                <button class="btn btn-tambah btn-danger" data-item-id="{{ $item->id }}"
                    data-item-price="{{ $item->price }}">Hapus</button>
            </div>
        </div>
    </div>
    @endif
    @endforeach

</div>

<div class="container-fluid box-pembayaran">
    <div class="container">
        <div class="row mb-2">
            <div class="col-12 content-total-kanan">
                <h6>Total Rp. <span id="totalPrice">{{ $totalPrice }}</span></h6>
            </div>
        </div>
        <a id="btn-konfirmasi-pemesanan" class="btn btn-konfirmasi-pemesanan w-100" href="/admin/mount/{{}}">Komfirmasi Pemesanan</a>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var bannedIds = []; // Inisialisasi variabel bannedIds di luar fungsi

    $(document).ready(function () {
        $(".btn-tambah").click(function () {
            var itemId = $(this).data("item-id");
            bannedIds.push(itemId); // Tambahkan ID ke dalam bannedIds

            // Hapus elemen HTML yang sesuai
            $(this).closest(".card-paymentC").remove();

            // Perbarui totalPrice
            updateTotalPrice();
        });
    });

    function updateTotalPrice() {
        var totalPrice = 0;
        $(".btn-tambah").each(function () {
            var itemId = $(this).data("item-id");
            var itemPrice = $(this).data("item-price");
            if (!bannedIds.includes(itemId)) {
                totalPrice += itemPrice;
            }
        });
        $("#totalPrice").text(totalPrice);
    }

    $(document).ready(function () {
        $("#btn-konfirmasi-pemesanan").click(function () {
            var ids = selectedItems.join(','); // Menggabungkan id menjadi string dengan koma
            var url = "/admin/mount/" + ids;
            window.location.href = url; // Mengarahkan ke URL dengan id yang dipilih
        });
    });
</script>
