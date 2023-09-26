@extends('admin.layouts.main')


@section('content')
<div class="container content-schedule mb-5 mt-4">
    <h1 class="title-jadwal text-center mb-5">Jadwal Lapangan</h1>
    <!-- Tambahkan input pencarian di luar tabel -->
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group fitur-cari">
                <input type="text" id="search" class="form-control" placeholder="Cari &#40Hari/Tanggal/Nama&#41">
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="myTable" class="table table-striped display" style="width:100%" border="0">
            <thead class="sticky-header">
                <tr>
                    <th class="sticky-header-tanggal">Hari / Tanggal</th>
                    @foreach ($playingTimes as $playingTime)
                    <th class="" style="text-align: center;">{{ $playingTime->time }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>

                @foreach ($dates as $date)
                <tr>
                    <td class="" style="text-align: center; width:20px;">{{ $date['day'] . ' ' . $date['date'] }}</td>
                    @foreach ($playingTimes as $playingTime)
                    @php
                    $booking = $bookeds->where('date', $date['dateNoFormats'])->where('time',
                    $playingTime->time)->first();
                    @endphp
                    <td style="text-align: center;  vertical-align: middle;"">
                        @if ($booking)
                        {{ $booking->name_user }}
                        @endif
                    </td>
                    @endforeach
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<script>
    // let table = new DataTable('#myTable');

    $(document).ready(function () {
        // Inisialisasi DataTables dengan konfigurasi pencarian
        var table = $('#myTable').DataTable({
            searching: true, // Hanya aktifkan fitur pencarian
            paging: false, // Nonaktifkan paging (halaman)
            info: false, // Nonaktifkan info jumlah data
            ordering: false, // Nonaktifkan sorting
        });

        // Tambahkan event listener untuk input pencarian
        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });

</script>

@endsection
