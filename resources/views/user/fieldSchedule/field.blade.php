@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/booking.css">

<div class="container content-booking">
    <h1 class="text-center title-booking" data-aos="zoom-in" data-aos-duration="2000">Lapangan Tersedia</h1>

    <div class="row">
        @if (!$fieldLists->count())
        <div class="col-12 text-center d-flex justify-content-center align-items-center" data-aos="zoom-in-up" data-aos-duration="2000">
            <div class="icon-not">
                <img src="{{ asset('/img/data_not.png') }}" alt="">
            </div>
        </div>
        
        @else
        @foreach ($fieldLists as $item)
        <div class="col-lg-4 col-md-6 col-sm-12 colom-content mx-auto">
            <div class="card card-lapangan border-0" data-aos="zoom-in-up" data-aos-duration="2000">
                <div class="img-box">
                    <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://source.unsplash.com/1200x1200?nodata' }}" alt="">
                </div>
                <div class="content">
                    <h2>{{ $item->name }}</h2>
                    {{-- <p style="text-align: justify">{{ \Illuminate\Support\Str::limit($item->body, 150, '...') }}</p> --}}
                    <a href="/sewa-lapangan/{{ $item->id }}/jadwal">Lihat Jadwal</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection