@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/home.css">

<div class="container-fluid content-home"
    style="background-image: linear-gradient(rgba(1, 78, 96, 1), rgba(1, 78, 96, 0.5)), url('{{ asset('/img/bg-home.jpg') }}'); background-size: cover;">

    @if(session('success'))
        <script>
            $(document).ready(function () {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '{!! session('success') !!}',
                    showConfirmButton: false,
                    timer: 1000
                });
            });
        </script>
    @endif

    <h1 data-aos="zoom-in" data-aos-duration="2000" class="text-center">Sewa Lapangan Karsa Mini Soccer</h1>
    <div class="row card-icon">
        <div class="col-lg-6 col-md-6 col-11 mx-auto my-auto">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-6" data-aos="zoom-in-up" data-aos-duration="2000">
                    <div class="d-flex justify-content-center">
                        <div class="icon-home">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1792">
                                <path fill="currentColor"
                                    d="M593 896q-162 5-265 128H194q-82 0-138-40.5T0 865q0-353 124-353q6 0 43.5 21t97.5 42.5T384 597q67 0 133-23q-5 37-5 66q0 139 81 256zm1071 637q0 120-73 189.5t-194 69.5H523q-121 0-194-69.5T256 1533q0-53 3.5-103.5t14-109T300 1212t43-97.5t62-81t85.5-53.5T602 960q10 0 43 21.5t73 48t107 48t135 21.5t135-21.5t107-48t73-48t43-21.5q61 0 111.5 20t85.5 53.5t62 81t43 97.5t26.5 108.5t14 109t3.5 103.5zM640 256q0 106-75 181t-181 75t-181-75t-75-181t75-181T384 0t181 75t75 181zm704 384q0 159-112.5 271.5T960 1024T688.5 911.5T576 640t112.5-271.5T960 256t271.5 112.5T1344 640zm576 225q0 78-56 118.5t-138 40.5h-134q-103-123-265-128q81-117 81-256q0-29-5-66q66 23 133 23q59 0 119-21.5t97.5-42.5t43.5-21q124 0 124 353zm-128-609q0 106-75 181t-181 75t-181-75t-75-181t75-181t181-75t181 75t75 181z" />
                                </svg>
                        </div>
                    </div>
                    <h2 class="text-center">{{ $user && $user->count() > 99 ? '99+' : ($user ? $user->count() : 0) }}</h2>
                    <h3 class="text-center">Pengguna</h3>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6" data-aos="zoom-in-up" data-aos-duration="2000">
                    <div class="d-flex justify-content-center">
                        <div class="icon-home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M255.03 33.813a229.242 229.242 0 0 0-5.5.03c-6.73.14-13.462.605-20.155 1.344c.333.166.544.32.47.438L204.78 75.063l73.907 49.437l-.125.188l70.625.28L371 79.282L342.844 52a225.62 225.62 0 0 0-49.47-14.78c-12.65-2.24-25.497-3.36-38.343-3.407zM190.907 88.25l-73.656 36.78l-13.813 98.407l51.344 33.657l94.345-43.438l14.875-76.5l-73.094-48.906zm196.344.344l-21.25 44.5l36.75 72.72l62.063 38.905l11.312-21.282c.225.143.45.403.656.75c-.77-4.954-1.71-9.893-2.81-14.782c-6.446-28.59-18.59-55.962-35.5-79.97c-9.07-12.872-19.526-24.778-31.095-35.5l-20.125-5.342zm-302.656 23c-6.906 8.045-13.257 16.56-18.938 25.5c-15.676 24.664-26.44 52.494-31.437 81.312A223.087 223.087 0 0 0 31 261l20.25 5.094l33.03-40.5L98.75 122.53l-14.156-10.936zm312.719 112.844l-55.813 44.75l-3.47 101.093l39.626 21.126l77.188-49.594l4.406-78.75l-.094.157l-61.844-38.783zm-140.844 6.406l-94.033 43.312l-1.218 76.625l89.155 57.376l68.938-36.437l3.437-101.75l-66.28-39.126zm-224.22 49.75c.91 8.436 2.29 16.816 4.156 25.094c6.445 28.59 18.62 55.96 35.532 79.968c3.873 5.5 8.02 10.805 12.374 15.938l-9.374-48.156l.124-.032l-27.03-68.844l-15.782-3.968zm117.188 84.844l-51.532 8.156l10.125 52.094a225.067 225.067 0 0 0 27.314 20.437a226.31 226.31 0 0 0 46.687 22.594l62.626-13.69l-4.344-31.124l-90.875-58.47zm302.437.5l-64.22 41.25l-42 47.375l4.408 6.156c12.027-5.545 23.57-12.144 34.406-19.72c23.97-16.76 44.604-38.304 60.28-62.97c2.51-3.947 4.87-7.99 7.125-12.092zm-122.78 97.656l-79.94 9.625l-25.968 5.655c26.993 4 54.717 3.044 81.313-2.813c9.412-2.072 18.684-4.79 27.75-8.062l-3.156-4.406z" />
                                </svg>
                        </div>
                    </div>
                    <h2 class="text-center">{{ $lapangan ? $lapangan->count() : 0 }}</h2>
                    <h3 class="text-center">Lapangan</h3>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6" data-aos="zoom-in-up" data-aos-duration="2000">
                    <div class="d-flex justify-content-center">
                        <div class="icon-home">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M15 3H9V1h6v2m-2 16c0 1.03.26 2 .71 2.83c-.55.11-1.12.17-1.71.17a9 9 0 0 1 0-18c2.12 0 4.07.74 5.62 2l1.42-1.44c.51.44.96.9 1.41 1.41l-1.42 1.42A8.963 8.963 0 0 1 21 13v.35c-.64-.22-1.3-.35-2-.35c-3.31 0-6 2.69-6 6m0-12h-2v7h2V7m9.54 9.88l-1.42-1.41L19 17.59l-2.12-2.12l-1.41 1.41L17.59 19l-2.12 2.12l1.41 1.42L19 20.41l2.12 2.13l1.42-1.42L20.41 19l2.13-2.12Z"/></svg>
                        </div>
                    </div>
                    <h2 class="text-center">
                        {{ $jadwalTerjual->count() > 99 ? '99+' : ($jadwalTerjual ? $jadwalTerjual->count() : 0) }}
                    </h2>
                    <h3 class="text-center">Jadwal Terjual</h3>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6" data-aos="zoom-in-up" data-aos-duration="2000">
                    <div class="d-flex justify-content-center">
                        <div class="icon-home">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M15 3H9V1h6v2m-2 16c0 1.03.26 2 .71 2.83c-.55.11-1.12.17-1.71.17a9 9 0 0 1 0-18c2.12 0 4.07.74 5.62 2l1.42-1.44c.51.44.96.9 1.41 1.41l-1.42 1.42A8.963 8.963 0 0 1 21 13v.35c-.64-.22-1.3-.35-2-.35c-3.31 0-6 2.69-6 6m0-12h-2v7h2V7m8.34 8.84l-3.59 3.59l-1.59-1.59L15 19l2.75 3l4.75-4.75l-1.16-1.41Z"/></svg>
                        </div>
                    </div>
                    <h2 class="text-center">
                        {{ $jadwalTersedia->count() > 99 ? '99+' : ($jadwalTersedia->count() > 0 ? $jadwalTersedia->count() : 0) }}
                    </h2>
                    <h3 class="text-center">Jadwal Tersedia</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container layanan-kami">
    <h1 class="text-center" data-aos="zoom-in" data-aos-duration="2000">Layanan Kami</h1>
    <h2 class="text-center" data-aos="zoom-in" data-aos-duration="2000">Kami Menyediakan Layanan dan Lapangan Olahraga Terbaik Untuk Anda</h2>

    <div class="row content-layanan-kami">
        <div class="col-lg-4">
            <div class="card" data-aos="zoom-in-up" data-aos-duration="2000">
                <div class="layanan-icon">
                    <div class="card-icon p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="m384 476.1l-192-54.9V35.9l192 54.9v385.3zm32-1.2V88.4l127.1-50.9c15.8-6.3 32.9 5.3 32.9 22.3v334.8c0 9.8-6 18.6-15.1 22.3L416 474.8zM15.1 95.1L160 37.2v386.4L32.9 474.5C17.1 480.8 0 469.2 0 452.2V117.4c0-9.8 6-18.6 15.1-22.3z" />
                            </svg>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Lapangan</h5>
                    <p class="card-text text-center">Menyediakan layanan booking lapangan mini soccer untuk kegiatan
                        berolahraga anda</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" data-aos="zoom-in-up" data-aos-duration="2000">
                <div class="layanan-icon">
                    <div class="card-icon p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path fill="currentColor" d="M338.8 31.81c-5 19.51-9.9 38.69-14.9 57.64c-45.3 7.27-90.5 7.28-135.8 0c-5-18.95-9.9-38.13-14.9-57.64c54.9 22.58 110.7 22.58 165.6 0zm17.3 4.59l34.4 45.95c-14 96.25-40 204.15-77.5 302.95c-10.7-12.4-25.2-21.3-41.8-24.7c28.3-111.3 56.6-212.3 84.9-324.2zm-200.2 0c28.3 111.9 56.6 212.9 84.9 324.2c-16.6 3.4-31.1 12.3-41.8 24.7c-37.5-98.8-63.5-206.7-77.5-302.95zM256 377c31.6 0 57 25.4 57 57s-25.4 57-57 57s-57-25.4-57-57s25.4-57 57-57z"/></svg>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Event Turnamen</h5>
                    <p class="card-text text-center">Memberikan layanan dan harga terbaik untuk anda yang akan mengadakan turnamen</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card" data-aos="zoom-in-up" data-aos-duration="2000">
                <div class="layanan-icon">
                    <div class="card-icon p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M11 19q-2.5 0-4.25-1.75T5 13q0-.275.025-.55t.075-.55q-.125.05-.3.075T4.5 12q-1.05 0-1.775-.725T2 9.5q0-1.05.688-1.775T4.425 7q.825 0 1.488.462T6.85 8.65q.825-.75 1.888-1.2T11 7h11v4h-5v2q0 2.5-1.75 4.25T11 19Zm-6.5-8.5q.425 0 .713-.288T5.5 9.5q0-.425-.288-.713T4.5 8.5q-.425 0-.713.288T3.5 9.5q0 .425.288.713t.712.287ZM11 15q.825 0 1.413-.588T13 13q0-.825-.588-1.413T11 11q-.825 0-1.413.588T9 13q0 .825.588 1.413T11 15Z"/></svg>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center">Perlengkapan Olahraga</h5>
                    <p class="card-text text-center">Menyediakan perlengkapan olahraga dengan kualitas terbaik demi kenyamanan anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid lokasi-kami">
    <h1 class="text-center" data-aos="zoom-in" data-aos-duration="2000">Lokasi Karsa Mini Soccer</h1>

    <div class="card card-lokasi" data-aos="zoom-in-up" data-aos-duration="2000">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.7705281927842!2d119.48338967397413!3d-5.140606851984108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30b58cb90a9%3A0xb37efae63a9621ee!2sKarsa%20Mini%20Soccer!5e0!3m2!1sid!2sid!4v1699162349700!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

</div>
@endsection
