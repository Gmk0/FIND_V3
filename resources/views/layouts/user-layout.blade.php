<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': dark }" x-data="data()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FIND') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />

    <!-- script -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script src="/js/alpine-init.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>

    @livewireStyles
    @filamentStyles


    @filamentScripts
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <div x-cloak x-show.in.out.opacity="navOpen" class="fixed inset-0 z-[85] bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>

    @livewire('user.header-user')


    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif



    <main class="min-h-screen pt-20 bg-gray-200 dark:bg-gray-900">
        {{ $slot }}
    </main>










    @livewireScriptConfig




</body>

</html>