<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    @include('layouts._header')

    <div class="page-wrapper">
        <div class="container">
            @include('layouts._flash')
            @include('layouts._errors')
        </div>
    </div>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
