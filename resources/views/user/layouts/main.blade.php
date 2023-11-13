<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karsa Mini Soccer</title>
    @include('user.partials.linkCss')
</head>

<body id="page-top">
    @include('user.partials.navbar')

    @yield('content')

    {{-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up" style="margin-top: 12px;"></i>
    </a> --}}

    @include('user.partials.linkJs')

    @include('user.partials.footer')
</body>

</html>
