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

    <link rel="stylesheet" href="/test/assets/css/plugins.css">
    <!-- Bootstap CSS -->

    <!-- Main Style CSS -->

    <link rel="stylesheet" href="/test/assets/css/responsive.css">
    </head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased template-index belle home7-shoes">

    <div id="pre-loader">
        <img src="/test/assets/images/loader.gif" alt="Loading..." />
    </div>

    <div>


        <x-header-test></x-header-test>
        <div id="content">

            @yield('content')
        </div>

    </div>




   @livewireScriptConfig






    <script src="/test/assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="/test/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="/test/assets/js/vendor/jquery.cookie.js"></script>
    <script src="/test/assets/js/vendor/wow.min.js"></script>
    <!-- Including Javascript -->
    <script src="/test/assets/js/bootstrap.min.js"></script>
    <script src="/test/assets/js/plugins.js"></script>
    <script src="/test/assets/js/popper.min.js"></script>
    <script src="/test/assets/js/lazysizes.js"></script>
    <script src="/test/assets/js/main.js"></script>

    @stack('script')
</body>

</html>
