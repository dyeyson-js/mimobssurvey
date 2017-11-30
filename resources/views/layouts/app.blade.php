<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @if(config('app.env') === "local")
    <link href="http://localhost:8080/css/app.css" rel="stylesheet">
    @else
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @endif    
</head>
<body>
    <div id="app">
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    @if(config('app.env') === "local")
    <script src="http://localhost:8080/js/app.js"></script>    
    @else
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
    @endif
</body>
</html>
