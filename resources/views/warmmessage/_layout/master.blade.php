<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Warm Message</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
</head>
<body>
<div id="app" class="container mx-auto">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@livewireAssets
</body>
</html>
