@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <h1 class="h3 mb-2 text-gray-800 text-center">Daftar Lapangan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <a class="btn btn-success px-4 py-2 ml-auto" href="/admin/daftar-lapangan/create">Tambah Lapangan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Lapangan</th>
                            <th class="text-center">Jam</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td style="vertical-align: middle;">{{ $item->name }}</td>
                            <td>
                                @if ($itemTwo = $itemsTwo->where('field_list_id', $item->id))
                                @foreach ($itemTwo as $itemTwoo)
                                {{ $itemTwoo->playingTime->time }} <br>
                                @endforeach
                                @else
                                Data tidak ditemukan.
                                @endif
                            </td>
                            <td>
                                @if ($itemTwo = $itemsTwo->where('field_list_id', $item->id))
                                @foreach ($itemTwo as $itemTwoo)
                                Rp. {{ number_format($itemTwoo->price, 0, ',', '.') }} <br>
                                @endforeach
                                @else
                                Data tidak ditemukan.
                                @endif
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a href="/admin/daftar-lapangan/edit/{{ $item->id }}"
                                    class="btn btn-warning btn-icon-split btn-sm">
                                    <span class="text">Edit</span>
                                </a>
                                <a id="deleteButton" href="{{ url('/admin/daftar-lapangan/hapus/' . $item->id) }}"
                                    class="btn btn-danger btn-icon-split btn-sm">
                                    <span class="text">Hapus</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>