@extends('user.layouts.main')

@section('content')
<div class="container content-schedule">
    <h1 class="title-jadwal text-center mb-5 mt-5">Jadwal Lapangan</h1>

    <div class="row">
        @foreach ($items as $item)
        <div class="col-lg-3 col-md-4 col-6 p-2">
            <div class="card card-jadwal d-flex flex-column justify-content-center align-items-center"
                data-id="{{ $item->id }}" data-selected="false">
                <h1 class="text-center">{{ $item->time_start . ' - ' . $item->time_finish }}</h1>
                <h2 class="text-center">
                    @if ($item->is_booked)
                    Booked
                    @else
                    Rp. {{ $item->price }}
                    @endif
                </h2>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="container-fluid box-pembayaran" style="display: none;">
    <div class="container">
        {{-- <a href="{{ Route('index-paymentConfirmation', ['ids' => 1]) }}" class="btn btn-pembayaran w-100">Lanjut Pembayaran</a> --}}
        <a id="btn-lanjut-pembayaran" class="btn btn-pembayaran w-100" href="#">Lanjut Pembayaran</a>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function () {
        var selectedItems = [];

        function updatePaymentButton() {
            if (selectedItems.length > 0) {
                $(".box-pembayaran").css("display", "block");
            } else {
                $(".box-pembayaran").css("display", "none");
            }
        }

        $(".card.card-jadwal").click(function () {
            var id = $(this).data("id");

            if (selectedItems.includes(id)) {
                selectedItems = selectedItems.filter(item => item !== id);
                $(this).removeClass("selected");
            } else {
                selectedItems.push(id);
                $(this).addClass("selected");
            }

            updatePaymentButton();
        });
    });
</script> --}}

<script>
    $(document).ready(function () {
        var selectedItems = [];

        function updatePaymentButton() {
            if (selectedItems.length > 0) {
                $(".box-pembayaran").css("display", "block");
            } else {
                $(".box-pembayaran").css("display", "none");
            }
        }

        $(".card.card-jadwal").click(function () {
            var id = $(this).data("id");

            if (selectedItems.includes(id)) {
                selectedItems = selectedItems.filter(item => item !== id);
                $(this).removeClass("selected");
            } else {
                selectedItems.push(id);
                $(this).addClass("selected");
            }

            updatePaymentButton();
        });

        $("#btn-lanjut-pembayaran").click(function () {
            var ids = selectedItems.join(','); // Menggabungkan id menjadi string dengan koma
            var url = "/payment-confirmation/" + ids;
            window.location.href = url; // Mengarahkan ke URL dengan id yang dipilih
        });
    });
</script>
