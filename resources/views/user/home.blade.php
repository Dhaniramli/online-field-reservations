@extends('user.layouts.main')

@section('content')
<div class="container-fluid px-0">
    <div class="main-carousel" data-flickity='{"autoPlay": 1500, "contain": true ,"prevNextButtons": true, "pageDots": false}'>
        <div class="carousel-cell">
            <div class="overlay">
                <img src="/img/c1.png" alt="Blue Lock">
            </div>
        </div>
        <div class="carousel-cell">
            <div class="overlay">
                <img src="/img/c2.png" alt="Blue Lock">
            </div>
        </div>
        <div class="carousel-cell">
            <div class="overlay">
                <img src="/img/c3.png" alt="Blue Lock">
            </div>
        </div>
        <div class="carousel-cell">
            <div class="overlay">
                <img src="/img/c4.jpeg" alt="Blue Lock">
            </div>
        </div>
    </div>
</div>
@endsection
