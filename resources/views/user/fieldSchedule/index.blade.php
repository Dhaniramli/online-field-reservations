@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/schedule.css">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<div class="container content-schedule">
    <h1 class="title-jadwal text-center" data-aos="zoom-in" data-aos-duration="2000">Jadwal {{ $fieldList->name }}</h1>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-8 mx-auto my-auto" data-aos="zoom-in-up" data-aos-duration="2000">
            <form action="/sewa-lapangan/{{ $id }}/jadwal" method="POST">
                @csrf

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <input type="date" class="form-control" id="date" name="date"
                        value="{{ $dates[0] ?? old('date') }}">
                    <div class="mx-2"></div>
                    <button type="submit" class="btn-filter">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row isi-list-jadwal">
        @if (!$items->count())
        <div class="col-lg-6 col-md-4 col-6 p-2 my-auto mx-auto" data-aos="zoom-in-up" data-aos-duration="2000">
            <div class="icon-not d-flex justify-content-center">
                <img src="{{ asset('/img/jadwal_not.png') }}" alt="">
            </div>
        </div>
        @else

        @foreach ($items as $item)
        @php
            $queueTimeMeTrueByUserId = app(\App\Models\QueueList::class)::where('user_id', $user->id)->where('field_schedule_id', $item->id)->where('status', true)->first();
            $queueTimeFalseByUserId = app(\App\Models\QueueList::class)::where('user_id', $user->id)->where('field_schedule_id', $item->id)->where('status', false)->first();
            $queuePositionByUserId = app(\App\Models\QueueList::class)::where('user_id', $user->id)->where('field_schedule_id', $item->id)->first();
            $queueAll = app(\App\Models\QueueList::class)::where('field_schedule_id', $item->id)->where('status', false)->orderBy('created_at')->get();
            $queues = app(\App\Models\QueueList::class)::where('field_schedule_id', $item->id)->get();
            $queueOne = app(\App\Models\QueueList::class)::where('field_schedule_id', $item->id)->where('status', true)->first();
            $queueNumber = app(\App\Models\QueueList::class)::where('user_id', $user->id)->where('field_schedule_id', $item->id)->first();

            $ids = $item->id;
            $transactionOne = app(\App\Models\Transaction::class)::where('user_id', $user->id)
                ->where(function ($query) use ($ids) {
                    $query->where('schedule_ids', 'LIKE', '%' . $ids . '%');
                })->first();
            
            $transactionTwo = app(\App\Models\Transaction::class)::where(function ($query) use ($ids) {
                    $query->where('schedule_ids', 'LIKE', '%' . $ids . '%');
                })->first();
        @endphp
        <div class="col-lg-3 col-md-4 col-6 p-2" data-aos="zoom-in-up" data-aos-duration="2000">
            <div class="card card-jadwal d-flex flex-column justify-content-center align-items-center {{ $item->is_booked === 'booked' ? 'booked' : '' }}"
                data-id="{{ $item->id }}"
                data-selected="false"
                data-is-booked="{{ $item->is_booked === 'booked' ? 'booked' : ($item->is_booked === 'pending' || !$queues || $queueList->where('user_id', $user->id)->where('field_schedule_id', $item->id)->where('status', false)->first() ? 'pending' : 'not-booked') }}"
                data-button-satu="{{ app(\App\Models\QueueList::class)::where('user_id', $user->id)->where('field_schedule_id', $item->id)->first(); }}"
                data-button-dua="{{ app(\App\Models\QueueList::class)::where('user_id', $user->id)->where('field_schedule_id', $item->id)->where('status', true)->first(); }}">
                <h1 class="text-center">{{ $item->time_start . ' - ' . $item->time_finish }}</h1>
                <h2 class="text-center">
                    @if ($item->is_booked === 'pending' || $queueTimeFalseByUserId || !$queues)
                    Pending <br>
                        {{-- @if ($queueNumber)
                            <span idJadwal="{{ $queueNumber->field_schedule_id }}">{{ $queueNumber->field_schedule_id }}</span>
                        @else
                            <span id="teks{{ $item->id }}">Queue number not available</span>
                        @endif --}}

                        {{-- @if ($queueTimeFalseByUserId)
                        <span id="teks{{ $item->id }}"></span>
                        @endif --}}
                
                        {{-- @if ($queueOne)
                            <script>
                                const queueNumber{{ $item->id }} = '{{ isset($queueNumber) ? $queueNumber->number : "0" }}';
                                const queueOne{{ $item->id }} = '{{ $queueOne->created_at }}';
                                const queueOne2{{ $item->id }} = new Date(queueOne{{ $item->id }}).getTime();
                                const tanggalTujuan{{ $item->id }} = queueNumber{{ $item->id }} > 2 ? queueOne2{{ $item->id }} + ((queueNumber{{ $item->id }} - 1) * 5 * 60 * 1000) : queueOne2{{ $item->id }} + (5 * 60 * 1000);
                                
                                const hitungMundur{{ $item->id }} = setInterval(function(){
                                    
                                    const sekarang{{ $item->id }} = new Date().getTime();
                                    const selisih{{ $item->id }} = tanggalTujuan{{ $item->id }} - sekarang{{ $item->id }};
                                    
                                    const hari = Math.floor(selisih{{ $item->id }} / (1000 * 60 * 60 * 24));
                                    const jam{{ $item->id }} = Math.floor(selisih{{ $item->id }} % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
                                    const menit{{ $item->id }} = Math.floor(selisih{{ $item->id }} % (1000 * 60 * 60) / (1000 * 60));
                                    const detik{{ $item->id }} = Math.floor(selisih{{ $item->id }} % (1000 * 60) / 1000);
                                    
                                    const teks{{ $item->id }} = document.getElementById('teks{{ $item->id }}');
                                    teks{{ $item->id }}.innerHTML = jam{{ $item->id }} + ':' + menit{{ $item->id }} + ':' + detik{{ $item->id }};

                                    if (selisih{{ $item->id }} <= 0) {
                                        clearInterval(hitungMundur{{ $item->id }});
                                        teks{{ $item->id }}.innerHTML = '';

                                        if ('{{ $transactionTwo }}') {
                                            window.location.reload();
                                        }
                                    }
                                }, 1000);

                            </script>
                        @endif --}}
                
                    @elseif ($item->is_booked === 'booked')
                    Booked
                    
                    @else
                    Rp. {{ number_format($item->price, 0, ',', '.') }} <br>
                    <span id="teks2{{ $item->id }}"></span>

                        {{-- @if (!$transactionOne && $queueOne && $queues)
                            <script>
                                const queueOne{{ $item->id }} = '{{ $queueOne->created_at }}';
                                const queueOne2{{ $item->id }} = new Date(queueOne{{ $item->id }}).getTime();

                                const tanggalTujuan2{{ $item->id }} = queueOne2{{ $item->id }} + (4 * 60 * 1000);

                                const hitungMundur2{{ $item->id }} = setInterval(function(){
                                    
                                    const sekarang2{{ $item->id }} = new Date().getTime();
                                    const selisih2{{ $item->id }} = tanggalTujuan2{{ $item->id }} - sekarang2{{ $item->id }};
                                    
                                    const menit2{{ $item->id }} = Math.floor(selisih2{{ $item->id }} % (1000 * 60 * 60) / (1000 * 60));
                                    const detik2{{ $item->id }} = Math.floor(selisih2{{ $item->id }} % (1000 * 60) / 1000);
                                    
                                    const teks2{{ $item->id }} = document.getElementById('teks2{{ $item->id }}');
                                    teks2{{ $item->id }}.innerHTML = menit2{{ $item->id }} + ':' + detik2{{ $item->id }};

                                    if (selisih2{{ $item->id }} <= 0) {
                                        clearInterval(hitungMundur2{{ $item->id }});
                                        teks2{{ $item->id }}.innerHTML = '';

                                        console.log({{ $item->id }});
                                        console.log({{ $ids }});
                                        
                                        axios.get('/deleteQueue/' + {{ $item->id }})
                                        .then(function (response) {
                                            console.log('Data dihapus');
                                        })
                                        .catch(function (error) {
                                            console.log('Data gagal dihapus: ' + error);
                                        });
                                        
                                        if ('{{ $queueTimeMeTrueByUserId }}') {
                                            window.location.reload();
                                        }

                                    }
                                }, 1000);
                            </script>
                        @endif --}}
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
            var isBooked = $(this).data("is-booked");
            var custom1 = $(this).data("button-satu");
            var custom2 = $(this).data("button-dua");

            // Menambahkan kondisi untuk mencegah klik jika item sudah dibooking
            if (isBooked === 'booked') {
                // Menghapus item dari selectedItems jika sudah terpilih sebelumnya
                selectedItems = selectedItems.filter(item => item !== id);
                $(this).removeClass("selected");
                return;
            }  else if (isBooked === 'pending') {
                console.log(custom1.field_schedule_id);
                console.log(custom2);

                if(custom2 != ""){
                    Swal.fire({
                        title: "Anda Telah Melakukan Checkout!!",
                        text: "Silahkann cek email dan selesaikan pembayaran anda",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Oke"
                    });
                } else if(custom1 != "") {
                    Swal.fire({
                    title: "Anda Sudah Berada Dalam Antrian",
                    text: "Silahkan tunggu dan cek email anda",
                    icon: "warning",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Oke"
                    });
                } else {
                    Swal.fire({
                        title: "Apakah Anda ingin masuk dalam antrian?",
                        text: "Jadwal ini sebelumnya telah dipilih oleh orang lain. Jika orang tersebut tidak melanjutkan pembayaran, Anda akan menggantikan tempatnya.",
                        showCancelButton: true,
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Lakukan permintaan POST ke endpoint dengan data yang ingin Anda kirimkan
                            let field_schedule_id = id; // Ganti dengan nilai yang sesuai

                            // TAMPILKAN INI
                            window.location.href = "/payment-queue/" + field_schedule_id;
                        }
                    });
                }

                return;
            }

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
            var ids = selectedItems.join(',');
            var url = "/payment-confirmation/" + ids;
            window.location.href = url;
        });
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dateInput = document.getElementById('date');

        // Mendapatkan tanggal hari ini
        const today = new Date();
        const currentDay = today.getDay(); // Mendapatkan hari dalam bentuk angka (0: Minggu, 1: Senin, dst.)
        const currentDate = today.getDate(); // Mendapatkan tanggal saat ini

        let startOfCurrentWeek;

        // Mencari hari Senin pada minggu ini
        if (currentDay === 1) {
            startOfCurrentWeek = currentDate; // Jika hari ini Senin, maka Senin adalah hari ini
        } else {
            startOfCurrentWeek = currentDate - currentDay + (currentDay === 0 ? 1 : 2); // Jika bukan Senin, cari Senin pada minggu ini
        }

        // Memperbarui batasan tanggal berdasarkan rentang yang diinginkan (7 hari)
        dateInput.setAttribute('min', new Date(today.getFullYear(), today.getMonth(), startOfCurrentWeek).toISOString().split("T")[0]);
        dateInput.setAttribute('max', new Date(today.getFullYear(), today.getMonth(), startOfCurrentWeek + 6).toISOString().split("T")[0]);
    });

</script>
@endsection