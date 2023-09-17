<head>
    <link rel="shortcut icon" href="/images/logo/find_01.png" type="image/x-icon">
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
    <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>

    <script src="/service-worker.js" defer></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @wireUiScripts

    <link rel="stylesheet" href="/css/app3.css">

    <link rel="stylesheet" href="/build/assets/app.css">

    <script src="/js/alpine-init.js"></script> <!-- Scripts -->

   {{-- @vite(['resources/css/app.css','resources/js/app.js'])--}}

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

    @livewireStyles
    @filamentStyles


    @filamentScripts



     <script>
        localStorage.getItem("dark") === "true" &&
                document.documentElement.classList.add("dark");

    </script>


    <script>


           const beamsClient = new PusherPushNotifications.Client({
            instanceId: '3a7c226c-b409-40f9-add8-ace345844730',
            });
            beamsClient.start()
            .then(() => beamsClient.addDeviceInterest('App.Models.User.{{ auth()->id() }}'))
            .then(() => console.log('Successfully registered and subscribed!'))
            .catch(console.error);

    </script>



    <script src="/build/assets/app.js" defer></script>
</head>
