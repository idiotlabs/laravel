<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('js')
</body>
</html>
