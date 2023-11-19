@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/paymentConfirmation.css">

<div class="container content-paymentConfirmation">

    <div class="card mt-5 p-4">
        <h1 class="title-payment text-center">Periksa Pemesanan Anda</h1>
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
                    <h4>Rp. {{ number_format($item->price, 0, ',', '.') }}</h4>
                    <button class="btn btn-tambah btn-sm btn-danger" data-item-id="{{ $item->id }}"
                        data-item-price="{{ $item->price }}">Hapus</button>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    <div class="card mt-5 p-4 mb-5">
        <form>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="metode-bayar-dp">Bayar DP</label>
                <input class="form-check-input" autocomplete="off" type="radio" id="metode-bayar-dp" name="metode" value="bayar_dp">
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label" for="metode-bayar-penuh">Bayar Penuh</label>
                <input class="form-check-input" type="radio" id="metode-bayar-penuh" name="metode" value="bayar_penuh">
            </div>
            <br>
            <a id="btn-konfirmasi-pemesanan" class="btn btn-konfirmasi-pemesanan btn-myprimary mt-3 w-100"
                href="/payment/{{ implode(',', $unbannedIds) }}?metode=">Konfirmasi Pemesanan</a>
        </form>
    </div>

</div>

</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var bannedIds = [];
        var konfirmasiButton = $("#btn-konfirmasi-pemesanan");

        $(".btn-tambah").click(function () {
            var itemId = $(this).data("item-id");
            bannedIds.push(itemId); // Tambahkan ID ke dalam bannedIds
            $(this).closest(".card-paymentC").remove();
            updateTotalPrice();
        });

        // Menangani perubahan pada radio button
        $("input[type=radio][name=metode]").change(function () {
            updateTotalPrice();
        });

        konfirmasiButton.click(function (e) {
            // Periksa apakah salah satu radio button dipilih
            if ($("input[type=radio][name=metode]:checked").length === 0) {
                e.preventDefault(); // Mencegah tindakan default tombol jika tidak ada radio button yang dipilih
                alert("Pilih metode pembayaran terlebih dahulu.");
            }
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

            // Ambil nilai radio button yang dipilih
            var metode = $("input[type=radio][name=metode]:checked").val();

            // Membuat URL dengan parameter metode
            var konfirmasiLink = "/payment/" + unbannedIds.join(',') + "?metode=" + metode;

            // var konfirmasiLink = "/payment/" + unbannedIds.join(',');
            $("#btn-konfirmasi-pemesanan").attr("href", konfirmasiLink);
        }
    });

</script>
