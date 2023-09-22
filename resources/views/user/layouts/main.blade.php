<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Karsa Mini Soccer</title>
    @include('user.partials.linkCss')
</head>

<body>
    @include('user.partials.navbar')
    
    @yield('content')
    
    @include('user.partials.linkJs')

    @include('user.partials.footer')
</body>

</html>
