


<div wire:ignore x-data="{isDark: false, isSearchBoxOpen:false}" @scroll.window="isDark = (window.pageYOffset > 150) ? true : false">

    <div x-data="{isWhite: false, isHome: @entangle('isHome')}" @scroll.window="isWhite = (window.pageYOffset > 150) ? true : false"

        :class="isDark?'dark:bg-gray-800 ':''" class="{{request()->routeIs('home') ? 'header-wrap2':' bg-white '}} header-wrap  classicHeader animated flex">
        <div class="w-full px-4 lg:px-12">
            <div class="grid items-center justify-between w-full grid-cols-12 lg:mx-auto">
                <!--Desktop Logo-->
                <div class="hidden logo md:col-span-2 lg:block">
                    <a href="{{url('home')}}">
                        <img src="/images/logo/find_02.png" class="w-20 hidden lg:block" alt="FInd" title="Find" />
                    </a>


                </div>
                <!--End Desktop Logo-->
                <div class="col-span-3 lg:col-span-8 ">
                    <div class="block lg:hidden">
                        <button @click="navOpen = !navOpen"
                            class="inline-flex items-center justify-center p-2 text-gray-700 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
                            x-bind:aria-label="navOpen ? 'Close main menu' : 'Main menu'" x-bind:aria-expanded="navOpen">
                            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': navOpen, 'inline-flex': !navOpen }" class="inline-flex" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !navOpen, 'inline-flex': navOpen }" class="hidden" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!--Desktop Menu-->
                    <nav
                        class="relative grid__item" id="AccessibleNav">
                        <!-- for mobile -->
                        <ul id="siteNav" class="site-nav medium center hidearrow">
                            <li class="lvl1 parent megamenu">
                                <a class="text-dark" href="{{url('/')}}" >

                                <x-header-change :name="'Accueil'" />

                                </a>


                            </li>
                            <li class="lvl1 parent megamenu">
                                <a href="#">

                                 <x-header-change :name="'Categories'" />


                                </a>
                                <div class="megamenu hidden lg:block  !dark:bg:gray-800 !pb-12 style4 soft-scrollbar">
                                    <div>
                                        <h1 class="mb-2 font-bold Text-lg">Toutes les categories</h1>
                                    </div>
                                    <ul class="grid grid-cols-4 rounded-md grid--uniform mmWrapper">
                                        @forelse ($categories as $category)
                                        <li class="grid__item lvl-1 col-md-3 col-lg-3">
                                            <a href="{{route('categoryByName',[$category->name])}}"  class="site-nav lvl-1">{{$category->name}}</a>
                                            <ul class="subLinks">
                                                @forelse ($category->subCategories as $item)


                                                @if ($loop->index < 5)
                                                <li class="lvl-2"><a href="{{route('SubcategoryName',[$category->name,$item->name])}}"  class="site-nav lvl-2">{{$item->name}}</a></li>

                                                @endif

                                                @if ($loop->iteration == 5 && ($loop->count - 2) > 0)
                                                <span class="ml-2 text-sm text-gray-500">(+{{ $loop->count - 2 }} de plus)</span>
                                                @endif
                                                @empty

                                                @endforelse


                                            </ul>
                                        </li>

                                        @empty

                                        @endforelse


                                    </ul>
                                </div>
                            </li>

                            <li class="lvl1 parent dropdown">
                                <a  href="#">

                                    <x-header-change :name="'Freelance'" />
                                    </a>
                                <ul class="dropdown">
                                    <li><a href="{{url('/registration')}}" class="site-nav">Devenir Freelance</a></li>
                                    <li><a href="{{url('/find-freelance')}}"  class="site-nav">Trouver un freelance</a></li>


                                </ul>
                            </li>
                            <li class="lvl1 parent dropdown"><a  href="#">
                                <x-header-change :name="'Mission'" />

                                    </a>
                                <ul class="dropdown">
                                    <li><a href="{{route('createProject')}}" class="site-nav">Soumettre une Mission</a></li>



                                </ul>
                            </li>
                            <li class="lvl1 parent dropdown">
                                <a  href="{{url('/services')}}">

                             <x-header-change :name="'Services'" />

                                    </a>

                            </li>
                            <li class="lvl1 parent dropdown"><a  href="#">

                                <x-header-change :name="'Contact'" />
                            </a>
                                <ul class="dropdown">
                                    <li><a href="{{url('/contact')}}" class="site-nav">Contact</a></li>
                                 {{--   <li><a href="{{route('blogView')}}" class="site-nav">Blog</a></li>--}}
                                    <li><a href="{{route('FeedbackView')}}" class="site-nav">Votre Avis</a></li>
                                    <li><a href="{{url('/faq')}}" class="site-nav">Faq</a></li>

                                </ul>
                            </li>
                            @guest
                            <li class="lvl1 parent dropdown">
                                <a href="{{url('/login')}}" class="font-semibold">

                                    <x-header-change :name="'Connexion'" />

                                </a>

                            </li>

                            @endguest


                        </ul>
                    </nav>
                    <!--End Desktop Menu-->
                </div>
                <!--Mobile Logo-->
                <div class="block col-span-6 mx-auto lg:col-span-2 lg:hidden mobile-logo">
                    <div class="logo">
                        <a href="/">

                            <a :class="isWhite?'hidden':'block'"  href="{{url('/')}}">
                                <img x-show="isHome"  src="/images/logo/find_03.png" alt="logo-find" class="h-14 dark:hidden">
                                <img x-show="isHome" src="/images/logo/find_02.png" alt="logo-find" class="hidden w-24 dark:block">
                            </a>
                            <a :class="isWhite?'block':'hidden'" href="{{url('/')}}">
                                <img x-show="isHome"  src="/images/logo/find_02.png" alt="logo-find" class="w-24 ">
                            </a>



                            <a x-show="!isHome"  href="{{url('/')}}">
                                <img   src="/images/logo/find_02.png" alt="logo-find" class="w-24">
                            </a>

                        </a>
                    </div>
                </div>
                <!--Mobile Logo-->
                <div  class="flex items-center justify-end col-span-3 gap-2 lg:col-span-2 ">

                    @auth

                    <div class="site-header__search">
                        <button @click="isSearchBoxOpen=!isSearchBoxOpen" type="button" class="search-trigger">

                            <svg x-cloak x-show="isHome" class="hidden w-5 h-5 lg:block " :class="isWhite?'dark:!text-white':'!text-white dark:!text-white'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <svg x-cloak x-show="!isHome" class="hidden w-5 h-5 lg:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <svg  class="block w-5 h-5 text-gray-700 dark:text-white lg:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>


                        </button>
                    </div>

                    @livewire('web.other.count-product')



                    <div class="hidden lg:block">
                        <x-user-info />
                    </div>

                    @else

                    <a href="{{url('/register')}}"
                        class="relative items-center justify-center hidden w-full h-12 px-8 mx-auto rounded-full lg:flex bg-skin-fill group dark:bg-skin-fill hover:scale-105 active:duration-75 active:scale-95 sm:w-max">
                        <span
                            class="relative text-base font-semibold text-white dark:text-white underline-none">{{__("S'inscrire")}}</span>

                    </a>
                    <a href="{{url('/register')}}"
                        class="relative flex items-center justify-center h-10 px-4 mx-auto mr-4 text-sm duration-300 rounded-md lg:hidden bg-gray-50 before:absolute before:inset-0 before:transition hover:scale-105 active:duration-75 active:scale-95 sm:w-max">
                        <span class="relative text-base font-semibold text-amber-600">{{__("S'inscrire")}}</span>
                    </a>


                    @endauth


                </div>
            </div>
        </div>


    </div>




    <div x-cloak x-show.in.out.opacity="navOpen" class="fixed inset-0 z-[400] bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>


    <div x-cloak x-show="navOpen" @click.away="navOpen = false"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
        class="fixed inset-0 bottom-0 left-0 z-[500] w-10/12 overflow-auto origin-left transform shadow-lg bg-gray-50 dark:bg-gray-800 custom-scrollbar lg:hidden"
        x-transition:enter=" transition ease-in duration-300" x-transition:enter-start="opacity-0 transform -translate-x-40"
        x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-out duration-500"
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
                        <span class="block text-base text-gray-800 truncate dark:text-white ">{{Auth::user()->name}}</span>

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
        <div class="p-4 overflow-auto custom-scrollbar">
            <div class="flex flex-col ">

                <div class="flex-1 border-gray-800 dark:border-white custom-scrollbar">
                    <div class="pt-4 pb-3">
                        <a href="{{url('/')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 text-base font-medium text-gray-800 rounded-md dark:text-white focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="ml-2">{{__('Accueil')}}</span>
                        </a>
                        <a href="{{url('/registration')}}" @click="navOpen = false"
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
                                    class="w-5 h-5 px-1 mt-1 transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse @click.away="open = false"
                                class="flex flex-col px-2 py-2 mt-2 rounded-md shadow-xs bg-inherit" role="menu" aria-orientation="vertical"
                                aria-labelledby="user-menu" role="menuitem">

                                @forelse($categories as $categorie)

                                <div x-data="{ open: false }">
                                    <button @click="open = true"
                                        class="flex flex-row items-center w-full px-3 py-2 mt-1 text-lg font-medium text-left text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:dark:text-white focus:text-white focus:bg-amber-600">

                                        <span class="ml-3">{{$categorie->name}}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180': open, 'rotate-0': !open}"
                                            class="w-5 h-5 px-1 mt-1 transform" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-down">
                                            <polyline points="6 9 12 15 18 9"></polyline>
                                        </svg>
                                    </button>
                                    <div x-show="open" x-collapse @click.away="open = false"
                                        class="flex flex-col px-2 py-2 mt-2 rounded-md shadow-xs bg-inherit" role="menu"
                                        aria-orientation="vertical" aria-labelledby="user-menu" role="menuitem">

                                        <a @click="navOpen = false" href="{{route('categoryByName',[$categorie->name])}}"  @click="navOpen = false"
                                            class="flex flex-row items-center px-3 py-2 text-base font-medium text-gray-800 rounded-md dark:text-white hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:text-gray-900 focus:bg-gray-200"
                                            role="menuitem"> Voir
                                            {{$categorie->name}}
                                        </a>
                                        @forelse($categorie->subCategories as $item)
                                       <a @click="navOpen = false" href="{{route('SubcategoryName',[$category->name,$item->name])}}"  @click="navOpen = false"
                                            class="flex flex-row items-center px-3 py-2 text-base font-medium text-gray-800 rounded-md dark:text-white hover:text-gray-900 hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:text-gray-900 focus:bg-gray-200"
                                            role="menuitem">
                                            {{$item->name}}
                                        </a>
                                        @empty

                                        @endforelse

                                    </div>
                                </div>




                                @empty
                                @endforelse



                            </div>
                        </div>

                        <a href="{{url('/services')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="albums-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Services')}}</span>
                        </a>
                        <a href="{{url('/find-freelance')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="reader-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Trouver un Freelancer')}}</span>
                        </a>

                        <a href="{{route('createProject')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>

                            <span class="ml-2">{{__('Soumettre une mission')}}</span>
                        </a>


                        <a href="{{url('/apropos')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="chatbubbles-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Apropos')}}</span>
                        </a>
                        <a href="{{url('/faq')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-3 py-2 mt-1 text-base font-medium text-gray-800 rounded-md dark:text-gray-50 hover:dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none focus:dark:text-white focus:text-white focus:bg-amber-600">
                            <ion-icon name="chatbubbles-outline" class="w-6 h-6 dark:text-white"></ion-icon>
                            <span class="ml-2">{{__('Foire aux Questions')}}</span>
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


                        <a href="{{route('freelance.dashboard')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-4 py-2 font-medium text-gray-800 text-md focus:text-gray-900 hover:text-gray-900 focus:outline-none hover:bg-gray-100 focus:bg-gray-100"
                            role="menuitem">
                            <ion-icon name="person-outline" class="w-6 h-6"></ion-icon>
                            <span class="ml-2">{{__('Dashboard Freelance')}}</span>
                        </a>
                        @endif

                        <a href="{{url('/user/messages')}}" @click="navOpen = false"
                            class="flex flex-row items-center px-4 py-2 font-medium text-gray-800 text-md focus:text-gray-900 hover:text-gray-900 focus:outline-none hover:bg-gray-100 focus:bg-gray-100"
                            role="menuitem">
                            <ion-icon name="chatbox-outline" class="w-6 h-6"></ion-icon>
                            <span class="ml-2">{{__('Conversation')}}</span>
                        </a>


                        <form method="POST" action="{{ url('/logout') }}" x-data>
                            @csrf

                            <x-dropdown-link
                                class="flex flex-row items-center px-4 py-2 text-red-500 text-md hover:text-red-700 hover:bg-red-100 focus:outline-none focus:text-red-700 focus:bg-red-100"
                                href="{{ url('/logout') }}" @click.prevent="$root.submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-log-out">
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


    <!--End Header-->


    <livewire:web.card.cart-service />

    <livewire:web.other.search-box />




</div>
