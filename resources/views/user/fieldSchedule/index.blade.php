@extends('user.layouts.main')

@section('content')
<div class="container content-schedule">
    <h1 class="title-jadwal text-center">Jadwal Lapangan</h1>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-8 mx-auto my-auto">
            <form action="/sewa-lapangan/{{ $id }}/jadwal" method="POST">
                @csrf

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <input type="date" class="form-control" id="date" name="date" value="{{ $dates[0] ?? old('date') }}">
                    <div class="mx-2"></div>
                    <button type="submit" class="btn-filter">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @if (!$items->count())
        <div class="col-lg-6 col-md-4 col-6 p-2 my-auto mx-auto">
            <div class="icon-not d-flex justify-content-center">
                <img src="{{ asset('/img/jadwal_not.png') }}" alt="">
            </div>
        </div>
        @else
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
        @endif
    </div>
</div>
<div class="container-fluid box-pembayaran" style="display: none;">
    <div class="container">
        <a id="btn-lanjut-pembayaran" class="btn btn-pembayaran w-100" href="#">Lanjut Pembayaran</a>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
