<div x-data="{isSearchBoxOpen:false,search:false}" class="fixed top-0 z-50 w-full bg-skin-fill dark:bg-gray-800">

    @php
    if (request()->routeIs('home')){
    $height = "h-20";
    $fixed="fixed";
    }else{
    $height = "h-16";
    $fixed="";
    }
    @endphp


    <div class="container flex items-center justify-between h-16 px-4 py-6 mx-auto ">
        <div class="flex-shrink-0">
            <h1 class="text-lg font-semibold tracking-widest text-white uppercase">
                <a href="{{url('/')}}">
                    <img src="/images/logo/find_03.png" alt="logo-find" class="h-16 dark:hidden">
                </a>
                <a href="{{url('/')}}">
                    <img src="/images/logo/find_02.png" alt="logo-find" class="hidden w-20 dark:block ">
                </a>
            </h1>

        </div>
        <nav class="hidden lg:flex">
            <ul class="flex items-center justify-center font-semibold">
                <li class="relative px-3 py-2 ">
                    <a href="{{ route('home')}}" wire:navigate
                        class="flex flex-row items-center px-3 py-2 @if(request()->routeIs('home')) border-b border-gray-100 dark:border-amber-800 @endif font-medium text-white  rounded-md  text-md focus:outline-none focus:text-white focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="ml-2">{{__('Accueil')}}</span>
                    </a>
                </li>
                <li x-data="{show:false}" class="relative px-3 py-2 group">
                    <button
                        class="flex flex-row items-center px-3 py-2 font-medium text-white rounded-md cursor-default hover:opacity-50 text-md focus:outline-none focus:text-white focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                        </svg>
                        <span class="ml-2">{{__('Category')}}</span>
                    </button>
                    <div
                        class="absolute top-0 -left-48 transition group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 min-w-[560px] transform">
                        <div class="relative w-full p-6 bg-white shadow-xl dark:bg-gray-900 top-6 rounded-xl">
                            <div
                                class="w-10 h-10 bg-white dark:bg-gray-800 transform rotate-45 absolute top-0 z-0 translate-x-0 transition-transform group-hover:translate-x-[12rem] duration-500 ease-in-out rounded-sm">
                            </div>

                            <div class="relative z-10">
                                <p
                                    class="uppercase tracking-wider text-gray-500 dark:text-gray-100 font-medium text-[13px]">
                                    The
                                    Categorie
                                </p>
                                <div class="grid grid-cols-2 gap-4">

                                    @forelse($categories as $categorie)




                                    <a href="{{route('categoryByName',[$categorie->name])}}" wire:navigate
                                        class="block p-2 -mx-2 font-semibold text-gray-800 transition duration-300 ease-in-out rounded-lg dark:text-gray-50 hover:bg-gradient-to-br hover:dark:text-gray-200 hover:text-indigo-600">
                                        {{$categorie->name}}

                                    </a>

                                    @empty


                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="relative px-3 py-2 group">
                    <button
                        class="flex flex-row items-center px-3 py-2 font-medium text-white rounded-md cursor-default hover:opacity-50 text-md focus:outline-none focus:text-white focus:bg-gray-700">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        <span class="ml-2">{{__('Freelance')}}</span>
                    </button>
                    <div
                        class="absolute top-0 -left-2 transition group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 min-w-[260px] transform">
                        <div class="relative w-full p-6 bg-white shadow-xl top-6 rounded-xl">
                            <div
                                class="absolute top-0 z-0 w-10 h-10 transition-transform duration-500 ease-in-out transform rotate-45 -translate-x-4 bg-white rounded-sm group-hover:translate-x-3">
                            </div>
                            <div class="relative z-10">
                                <p class="uppercase tracking-wider text-gray-500 font-medium text-[13px]">Freelance
                                </p>
                                <ul class="mt-3 text-[15px]">
                                    <li>
                                        <a href="{{route('register.begin')}}" wire:navigate
                                            class="block py-1 font-semibold text-transparent bg-transparent bg-clip-text bg-gradient-to-br from-indigo-400 to-pink-700 via-blue-500 hover:from-blue-600 hover:to-indigo-600 hover:via-pink-400">
                                            Creer un compte
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('find_freelance')}}" wire:navigate
                                            class="block py-1 font-semibold text-transparent bg-transparent bg-clip-text bg-gradient-to-br from-indigo-400 to-pink-700 via-blue-500 hover:from-blue-600 hover:to-indigo-600 hover:via-pink-400">
                                            Trouver un Freelannce
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="relative px-3 py-2 group">
                    <button
                        class="flex flex-row items-center px-3 py-2 font-medium text-white rounded-md cursor-default hover:opacity-50 text-md focus:outline-none focus:text-white focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                        <span class="ml-2">{{__('Mission')}}</span>
                    </button>
                    <div
                        class="absolute top-0 -left-2 transition group-hover:translate-y-5 translate-y-0 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-500 ease-in-out group-hover:transform z-50 min-w-[200px] transform">
                        <div class="relative w-full p-6 bg-white shadow-xl top-6 rounded-xl">
                            <div
                                class="absolute top-0 z-0 w-10 h-10 transition-transform duration-500 ease-in-out transform rotate-45 -translate-x-4 bg-white rounded-sm group-hover:translate-x-3">
                            </div>
                            <div class="relative z-10">
                                <ul class="text-[15px]">
                                    <li>
                                        <a href="{{route('createProject')}}" wire:navigate
                                            class="block py-1 font-semibold text-transparent bg-transparent bg-clip-text bg-gradient-to-br from-indigo-400 to-pink-700 via-blue-500 hover:from-blue-600 hover:to-indigo-600 hover:via-pink-400">
                                            Soumettre un Projet
                                        </a>
                                    </li>



                                </ul>


                            </div>
                        </div>
                    </div>
                </li>

                <li class="relative px-3 py-2 ">
                    <a href="{{url("/services")}}" wire:navigate.hover
                        class="flex flex-row items-center px-3 py-2 font-medium text-white rounded-md  text-md focus:outline-none @if(request()->routeIs('services')) border-b border-gray-100 dark:border-amber-800 @endif focus:text-white focus:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        <span class="ml-2">{{__('Service')}}</span>
                    </a>
                </li>




            </ul>

            <div>

            </div>
            <div class="flex items-center justify-center">

                <div class="relative px-3 py-2 ">

                    <button
                        class="text-gray-800 rounded-md dark:text-white focus:outline-none focus:shadow-outline-purple"
                        @click="toggleTheme" aria-label="Toggle color mode">

                        <svg x-cloak x-show="!dark" class="w-5 h-5 text-white" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>


                        <svg x-cloak x-show="dark" class="w-5 h-5 text-white" aria-hidden="true" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                clip-rule="evenodd"></path>
                        </svg>

                    </button>
                </div>



                @if(!request()->routeIs('home'))
                <div class="relative px-3 py-2 ">

                    <button
                        class="text-gray-800 rounded-md dark:text-white focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSearch()" aria-label="Toggle color mode">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>

                    </button>
                </div>

                @endif




                @auth
                {{-- @livewire('user.navigation.notifications-component')
                --}}
                <div class="relative px-3 py-2">
                    <button @click="toggleCard" class="flex cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                        <sub>
                            <span class="bg-red-600 text-gray-100 px-1.5 py-0.5 rounded-full -ml-1 animate-pulse">
                                {{$products?count($products):0}}
                            </span>
                        </sub>
                    </button>

                </div>

                @endauth



            </div>
        </nav>
        <nav class="hidden lg:flex ">

            <ul class="flex gap-2">

                @auth


                <li class="">




                </li>

                <li class="relative ml-3">


                    <x-user-info />




                </li>
                @else
                <li class="flex gap-2">
                    <a href="{{url('/login')}}"
                        class="relative flex items-center justify-center h-12 px-4 mx-auto mr-4 text-sm duration-300 rounded-md before:absolute before:inset-0 before:transition hover:scale-105 active:duration-75 active:scale-95 sm:w-max">
                        <span class="relative text-base font-semibold text-white">{{__("connexion")}}</span>
                    </a>

                    <a href="{{url('/register')}}"
                        class="relative flex items-center justify-center w-full h-12 px-8 mx-auto bg-white rounded-full group dark:bg-skin-fill hover:scale-105 active:duration-75 active:scale-95 sm:w-max">
                        <span
                            class="relative text-base font-semibold dark:text-white text-amber-600">{{__("S'inscrire")}}</span>
                        <svg class="stroke-current dark:text-white text-amber-600 " width="10" height="10"
                            stroke-width="2" viewBox="0 0 10 10" aria-hidden="true">
                            <g fill-rule="evenodd">
                                <path class="transition duration-200 ease-in-out opacity-0 group-hover:opacity-100"
                                    d="M0 5h7">
                                </path>
                                <path
                                    class="transition duration-200 ease-in-out opacity-100 group-hover:transform group-hover:translate-x-1"
                                    d="M1 1l4 4-4 4"></path>
                            </g>
                        </svg>
                    </a>
                </li>
                @endauth


            </ul>
        </nav>

        <div class="flex -mr-2 lg:hidden">
            @guest

            <a href="{{url('/register')}}"
                class="relative flex items-center justify-center h-10 px-4 mx-auto mr-4 text-sm duration-300 rounded-md bg-gray-50 before:absolute before:inset-0 before:transition hover:scale-105 active:duration-75 active:scale-95 sm:w-max">
                <span class="relative text-base font-semibold text-amber-600">{{__("S'inscrire")}}</span>
            </a>
            @else



            <div class="relative px-3 py-2 ">

                <button class="text-gray-800 rounded-md dark:text-white focus:outline-none focus:shadow-outline-purple"
                    @click="toggleSearch()" aria-label="Toggle color mode">

                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>

                </button>

            </div>
            <div class="relative px-3 py-2 ">


                <div @click="linkActive = !linkActive" class="flex cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    <sub>
                        <span class="bg-red-600 text-gray-100 px-1.5 py-0.5 rounded-full -ml-1 animate-pulse">
                            {{$products?count($products):0}}
                        </span>
                    </sub>
                </div>


            </div>

            @endguest


            <button @click="navOpen = !navOpen"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-50 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
                x-bind:aria-label="navOpen ? 'Close main menu' : 'Main menu'" x-bind:aria-expanded="navOpen">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': navOpen, 'inline-flex': !navOpen }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': !navOpen, 'inline-flex': navOpen }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>




    </div>

    <div x-cloak x-show.in.out.opacity="navOpen" class="fixed inset-0 z-50 bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>


    <div x-cloak x-show="navOpen" @click.away="navOpen = false"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
        class="fixed inset-0 bottom-0 left-0 z-[100] w-10/12 overflow-auto origin-left transform shadow-lg bg-gray-50 dark:bg-gray-800 custom-scrollbar lg:hidden"
        x-transition:enter=" transition ease-in duration-300"
        x-transition:enter-start="opacity-0 transform -translate-x-40"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-out duration-500"
        x-transition:leave-start="opacity-0 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-60">

        <div
            class="sticky top-0 z-20 flex justify-between h-24 p-2 bg-white border-b border-gray-700 dark:bg-gray-800 dark:border-gray-300 ">

            <div class="flex p-3 mx-1 ">
                @auth
                <div class="flex w-full text-left">
                    <div class="flex-shrink-0">
                        @if (!empty(Auth::user()->profile_photo_path))
                        <img class="w-12 h-12 rounded-full"
                            src="{{Storage::disk('local')->url(Auth::user()->profile_photo_path) }}" alt="">
                        @else
                        <img class="w-16 h-16 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="">
                        @endif
                    </div>
                    <div class="px-4 py-3">
                        <span
                            class="block text-base text-gray-800 truncate dark:text-white ">{{Auth::user()->name}}</span>

                    </div>
                </div>
                @else
                <a href="{{url('/login')}}"
                    class="relative flex items-center justify-center w-full h-12 px-8 mx-auto duration-300 rounded-full dark:border dark:border-white bg-skin-fill before:absolute before:inset-0 before:transition hover:scale-105 active:duration-75 active:scale-95 sm:w-max">
                    <span class="relative text-base font-semibold text-white">{{__('messages.SignIn')}}</span>
                </a>
                @endauth
            </div>

            <div class="text-left">

                </button>
                <button @click="navOpen = false" class="btn btn-sm btn-circle btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
        <div class="p-4 overflow-auto custom-scrollbar">
            <div class="flex flex-col ">

                <div class="flex-1 border-gray-800 dark:border-white custom-scrollbar">
                    <div class="pt-4 pb-3">
                        <a href="{{url('/')}}" @click="navOpen = false" wire:navigate
                            class="flex flex-row items-center px-3 py-2 text-base font-medium text-gray-800 rounded-md dark:text-white focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="ml-2">{{__('Accueil')}}</span>
                        </a>
                        <a href="{{url('/registration')}}" @click="navOpen = false" wire:navigate
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-white hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="person-add-outline" class="w-6 h-6"></ion-icon>
                            <span class="ml-2">{{__('Devenir Prestataire')}}</span>
                        </a>
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = true"
                                class="flex flex-row items-center w-full px-3 py-2 mt-1 text-lg font-medium text-left text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:dark:text-white focus:text-white focus:bg-amber-600">
                                <ion-icon name="albums-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                                <span class="ml-2">{{__('Categories')}}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open, 'rotate-0': !open}"
                                    class="w-6 h-6 mt-1 transform" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse @click.away="open = false"
                                class="flex flex-col px-2 py-2 mt-2 rounded-md shadow-xs bg-inherit" role="menu"
                                aria-orientation="vertical" aria-labelledby="user-menu" role="menuitem">

                                @forelse($categories as $categorie)


                                <a @click="navOpen = false" href="{{route('categoryByName',[$categorie->name])}}"
                                    wire:navigate @click="navOpen = false"
                                    class="flex flex-row items-center px-3 py-2 text-base font-medium text-gray-800 rounded-md dark:text-white hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:text-gray-900 focus:bg-gray-200"
                                    role="menuitem">
                                    {{$categorie->name}}
                                </a>

                                @empty
                                @endforelse



                            </div>
                        </div>
                        <a href="{{url('/services')}}" @click="navOpen = false" wire:navigate
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="albums-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Services')}}</span>
                        </a>
                        <a href="{{url('/find-freelance')}}" @click="navOpen = false" wire:navigate
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="reader-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Trouver un Freelancer')}}</span>
                        </a>

                        <a href="{{route('createProject')}}" @click="navOpen = false" wire:navigate
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>

                            <span class="ml-2">{{__('Soumettre une mission')}}</span>
                        </a>


                        <a href="{{url('/apropos')}}" @click="navOpen = false" wire:navigate
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="chatbubbles-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Apropos')}}</span>
                        </a>

                        <button
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:dark:text-white focus:text-white "
                            @click="toggleTheme" aria-label="Toggle color mode">
                            <template x-if="!dark">
                                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                    </path>
                                </svg>
                            </template>
                            <template x-if="dark">
                                <svg class="w-5 h-5 text-gray-800" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </template>
                            <span x-show="!dark" class="ml-2 text-gray-800">Sombre</span>
                            <span x-show="dark" class="ml-2 text-gray-800">Clair</span>
                        </button>
                    </div>
                </div>
                @auth
                <div class="container mt-4 border-t border-gray-800 dark:border-gray-50 ">
                    <div class="pt-2 pb-3">
                        <a href="{{url('/user/profile')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 text-base font-medium text-gray-800 rounded-md hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:text-gray-900 focus:bg-gray-200"
                            role="menuitem">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="ml-2">{{__('messages.profile')}}</span>
                        </a>

                        @if(Auth::user()->freelance()->exists())


                        <a href="{{--route('freelance.dashboard')--}}" @click="navOpen = false"
                            class="flex flex-row items-center px-4 py-2 text-gray-800 text-md focus:text-gray-900 hover:text-gray-900 focus:outline-none hover:bg-gray-100 focus:bg-gray-100"
                            role="menuitem">
                            <ion-icon name="person-outline" class="w-6 h-6"></ion-icon>
                            <span class="ml-2">{{__('Dashboard Freelance')}}</span>
                        </a>
                        @endif

                        <a href="{{url('/user/messages')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-4 py-2 text-gray-800 text-md focus:text-gray-900 hover:text-gray-900 focus:outline-none hover:bg-gray-100 focus:bg-gray-100"
                            role="menuitem">
                            <ion-icon name="chatbox-outline" class="w-6 h-6"></ion-icon>
                            <span class="ml-2">{{__('Conversation')}}</span>
                        </a>
                        <a href="{{--route('paiementUser')--}}"
                            class="flex flex-row items-center px-4 py-2 text-gray-800 text-md focus:text-gray-900 hover:text-gray-900 focus:outline-none hover:bg-gray-100 focus:bg-gray-100"
                            role="menuitem">
                            <ion-icon name="cash-outline" class="w-6 h-6"></ion-icon>
                            <span class="ml-2">{{__('Paiment')}}</span>
                        </a>

                        <form method="POST" action="{{ url('/logout') }}" x-data>
                            @csrf

                            <x-dropdown-link
                                class="flex flex-row items-center px-4 py-2 text-red-500 text-md hover:text-red-700 hover:bg-red-100 focus:outline-none focus:text-red-700 focus:bg-red-100"
                                href="{{ url('/logout') }}" @click.prevent="$root.submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                {{ __('messages.logOut') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
                @endauth

            </div>
        </div>


    </div>


    <livewire:web.card.cart-service />


</div>
