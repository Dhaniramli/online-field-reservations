@extends('user.layouts.main')

@section('content')
<div class="container content-booking">
    <h1 class="text-center mb-5 mt-3">Pilih Lapangan</h1>

    <div class="row">
        @foreach ($fieldLists as $item)
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="card card-booking">
                <div class="card-header">
                    <img src="https://source.unsplash.com/1200x1200?soccer" alt="" class="img-fluid">
                </div>
                <div class="card-body">
                    <h5 class="text-center">{{ $item->name }}</h5>
                    <a class="btn btn-outline-info mt-2" href="/sewa-lapangan/{{ $item->id }}/jadwal" role="button">Lihat Jadwal</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
