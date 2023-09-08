<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FIND')}}
        @isset($title)
        - {{ $title }}
        @endisset

    </title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />


    <link rel="stylesheet" href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />

    <!-- script -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <link rel="stylesheet" href="/css/app3.css">

    <script src="/js/alpine-init.js"></script> <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
    @livewireStyles
    @filamentStyles


    @filamentScripts


    <script>

    </script>
    <script>
        document.addEventListener('Keydown', (e)=>{

                if(!e.target.hasAttribute('wire:navigate'))
                return;

                if(e.key.toLowerCase() == 'enter')
                Alpine.navigate(e.target.href);

            });

    </script>
</head>
