@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/howTocancel.css">

<div class="container pembatalan">
    <h1>Pembatalan</h1>

    <div class="card border-0 shadow">
        <div class="isi text-justify">
            {!! $item ? $item->body : '' !!}
        </div>
    </div>

</div>
@endsection
