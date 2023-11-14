@extends('user.layouts.main')

@section('content')
<link rel="stylesheet" href="/css/user/privacyPolicy.css">

<div class="container kebijakan-privasi">
    <h1>Kebijakan Privasi</h1>

    <div class="card border-0 shadow">
        <div class="isi text-justify">
            {!! $item ? $item->body : '' !!}
        </div>
    </div>

</div>
@endsection
