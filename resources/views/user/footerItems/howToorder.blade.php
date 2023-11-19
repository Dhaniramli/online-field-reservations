@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/howToorder.css">

<div class="container cara-booking">
    <h1 data-aos="zoom-in" data-aos-duration="2000">Cara Booking</h1>

    <div class="card border-0 shadow">
        <div class="isi text-justify">
            {!! $item ? $item->body : '' !!}
        </div>
    </div>

</div>
@endsection
