<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center bg-blue-700 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute w-[600px] h-[600px] bg-blue-800 rounded-full -top-64 -left-64 opacity-40"></div>
            <div class="absolute w-[700px] h-[700px] bg-blue-800 rounded-full bottom-0 right-0 opacity-30"></div>
        </div>
        {{ $slot }}
    </div>
</body>

</html>