<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" :class="{ 'dark': dark }" x-data="data()">

@include('include.head')

<body x-init="setTimeout(() => { loading = false }, 2000)" class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <x-notifications z-index="z-[200]"/>
        <x-dialog />

    <div x-cloak x-show.in.out.opacity="navOpen" class="fixed inset-0 z-[85] bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>

    @livewire('user.other.header-user')


    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif



    <main class="min-h-screen pt-20 bg-gray-100 dark:bg-gray-900">
        {{ $slot }}
    </main>






<x-footer-user></x-footer-user>


@include('include.footer')



</body>

</html>
