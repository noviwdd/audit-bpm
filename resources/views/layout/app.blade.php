<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @yield('style')
    @vite('resources/css/app.css')
</head>

<body class="h-full">
    <div id="app" class="h-full">
        @yield('content')
    </div>
    @vite('resources/js/app.js')
</body>

</html>
