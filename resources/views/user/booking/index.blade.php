@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/booking.css">

<div class="container content-booking">
    <h1 class="text-center title-booking">Lapangan Tersedia</h1>

    <div class="row">
        @foreach ($fieldLists as $item)
        <div class="col-lg-4 col-md-6 col-sm-12 colom-content">
            <div class="card card-lapangan">
                <div class="img-box">
                    <img src="https://source.unsplash.com/1200x1200?soccer" alt="">
                </div>
                <div class="content">
                    <h2>{{ $item->name }}</h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic nesciunt corrupti harum consequatur debitis enim id.</p>
                    <a href="/sewa-lapangan/{{ $item->id }}/jadwal">Lihat Jadwal</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
