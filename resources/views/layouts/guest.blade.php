<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': dark }" x-data="data()">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FIND') }}</title>
    <link rel="shortcut icon" href="/images/logo/find_01.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/tailwindcss2.css">
    <script src="/js/alpine-init.js"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">

  <link rel="stylesheet" href="/build/assets/app.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="/js/alpine-init.js"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @wireUiScripts


    <style>
        .gradient {
            background: linear-gradient(100deg, #FF9E5E 10%, rgb(69, 67, 67) 100%);
        }

        .gradient2 {
            background: linear-gradient(80deg, #fd8b3f 20%, rgb(47, 46, 46) 100%);
        }

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/images/find2.gif') 50% 50% no-repeat rgb(249, 249, 249);
        }
    </style>

@filamentStyles


@filamentScripts
    <!-- Styles -->
    @livewireStyles

    <script src="/build/assets/app.js" defer></script>

</head>

<body>
    <div class="font-sans antialiased text-gray-900 bg-white dark:bg-gray-900 dark:text-gray-100">
        {{ $slot }}
    </div>



    @livewireScriptConfig
</body>

</html>
