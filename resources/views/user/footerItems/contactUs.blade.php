@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/contactUs.css">

<div class="container kontak-kami">
    <h1>Kontak Kami</h1>

    <div class="card border-0 shadow">
        <div class="row row-content h-100">
            <div class="col-lg-6 col-md-6">
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.7705281927842!2d119.48338967397413!3d-5.140606851984108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30b58cb90a9%3A0xb37efae63a9621ee!2sKarsa%20Mini%20Soccer!5e0!3m2!1sid!2sid!4v1699162349700!5m2!1sid!2sid"
                        style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="isi">
                    <div class="isi-2 alamat d-flex">
                        <div class="icon">
                            <i class="fa-solid fa-map-pin custom-icon-size"></i>
                        </div>
                        <div class="content ml-4">
                            <p>Ayo kunjungi kami di</p>
                            <h5>{{ $item ? $item->address : '' }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="isi-2  d-flex">
                        <div class="icon">
                            <i class="fa-solid fa-phone custom-icon-size"></i>
                        </div>
                        <div class="content ml-4">
                            <p>Jangan ragu untuk menghubungi kami</p>
                            <h5>{{ $item ? $item->phone_number : '' }}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="isi-2  d-flex">
                        <div class="icon">
                            <i class="fa-solid fa-envelope custom-icon-size"></i>
                        </div>
                        <div class="content ml-4">
                            <p>Sapa Kami di</p>
                            <h5>{{ $item ? $item->email : '' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
