@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/mount.css">

<div class="container content-mount">
    @if(session('success'))
    <script>
        $(document).ready(function () {
            Swal.fire({
            title: "Berhasil Submit!!!",
            text: "Silahkan tunggu dan cek email anda",
            icon: "success",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Oke"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/sewa-lapangan";
                }
            });
        });
    </script>    
    @endif
    
    <div class="row mb-5">
        <div class="col-lg-6">
            <div class="card card-mount">
                <h1 class="title-pelanggan mt-2 text-center">Data Pelanggan</h1>
                <table class="table table-borderless">
                    <tr>
                        <td class="h-12">Nama Tim</td>
                        <td>: {{ $user->team_name }}</td>
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
            <div class="card card-mount-2">
                <form action="/submit-payment" method="POST">
                    @csrf
                    <h1 class="title-pelanggan mt-2 text-center">Detail Pembayaran</h1>
                
                    <table class="table">
                        @foreach ($items as $item)
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
                                Rp. {{ number_format($totalPrice, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="h-12">
                                Pilihan Pembayaran<br>
                            </td>
                            <td class="h-12 " style="text-align: right;">
                                <select id="pilihanBayar" name="pilihanBayar">
                                    <option value="DP">Bayar DP</option>
                                    <option value="Full">Bayar Penuh</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="h-12">
                                Bayar
                            </td>
                            <td class="h-12 " style="text-align: right;">
                                <span id="bayarAmount"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="h-12">
                                Tipe Pembayaran<br>
                            </td>
                            <td class="h-12 " style="text-align: right;">
                                <select id="tipePembayaran" name="tipePembayaran">
                                    <option value="bca">BCA Virtual Account</option>
                                    <option value="bni">BNI Virtual Account</option>
                                    <option value="bri">BRI Virtual Account</option>
                                    <option value="cimb">CIMB Virtual Account</option>
                                    <option value="alfamart">Alfa Group</option>
                                    <option value="indomaret">Indomaret</option>
                                </select>
                            </td>
                        </tr>
                        <input type="hidden" name="itemId" value="{{ $item->id }}">
                        <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
                        <tr>
                            <td colspan="2" class="h-12 text-center">
                                <button type="submit" id="pay-button" class="btn btn-bayar btn-myprimary btn-block mt-5">SUBMIT</button>
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.getElementById("pilihanBayar").addEventListener("change", function() {
        updatePayment();
    });

    function updatePayment() {
        var totalPrice = {{ $totalPrice }};
        var selectedOption = document.getElementById("pilihanBayar").value;
        var bayarAmountElement = document.getElementById("bayarAmount");

        if (selectedOption === "DP") {
            var dpAmount = totalPrice / 2;
            bayarAmountElement.textContent = "Rp. " + dpAmount.toLocaleString('id-ID');
        } else {
            bayarAmountElement.textContent = "Rp. " + totalPrice.toLocaleString('id-ID');
        }
    }

    // Memanggil fungsi untuk menginisialisasi tampilan pada saat halaman dimuat
    updatePayment();
</script>
@endsection
