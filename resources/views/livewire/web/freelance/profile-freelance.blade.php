<div class="min-h-screen">
    <div class="flex flex-col h-full bg-gray-100 dark:bg-gray-900 lg:flex-row">
        <aside class="w-full bg-white shadow-md ov lg:w-4/12">

        <div class="sticky top-6 ">

                <div style="" class="p-6 overflow-y-auto scrollbar-sm lg:h-screen ">


                    <div class="flex items-center justify-center ">
                        @component("components.user-photo" ,['user'=>$freelance->user,'taille'=>32])
                        @endcomponent
                    </div>
                    <h1 class="mt-4 text-lg font-bold text-gray-800 lg:text-lg xl:text-xl 2xl:text-3xl">
                        {{$freelance->prenom}}
                        {{$freelance->nom}}</h1>
                    <h2 class="flex justify-between mt-2 text-lg font-medium text-gray-500 dark:text-gray-200">
                        <div class="flex gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                            <span class="items-start text-gray-600 dark:text-gray-500">
                                Categories
                            </span>

                        </div>

                        <span class="text-base text-gray-700 dark:text-gray-100">{{$freelance->category->name}}</span>
                    </h2>
                    @if(isset($freelance->localisation['ville']))
                    <h2 class="flex justify-between gap-1 mt-4 font-medium text-gray-800">

                        <div class="flex gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>

                            <span class="text-gray-600 dark:text-gray-500">Localisation</span>

                        </div>


                        <span class="text-base text-gray-700 dark:text-gray-100">{{$freelance->localisation['ville']?
                            $freelance->localisation['ville']:''}}</span>
                    </h2>
                    @endif

                    <h2 class="flex justify-between gap-2 mt-2 font-medium text-gray-500 dark:text-gray-200">
                        <div class="flex gap-1 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-()">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span class="text-base text-gray-600 dark:text-gray-500">Niveau</span>

                        </div>

                        <span>{{$freelance->level}}</span>
                    </h2>


                    @if(isset($freelance->compte) && ($freelance->compte != null))
                    <div class="flex flex-col mt-4">
                        <div>
                            <h1 class="text-base text-gray-600 dark:text-gray-500">Comptes Liees</h1>
                        </div>
                        <div class="flex gap-4 mt-4 ">


                            @forelse ($freelance->compte as $value)
                            @switch($value['compte'])
                            @case('Facebook')

                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="w-6 h-6 svg3" viewBox="0 0 512 512">
                                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>
                                        .svg3 {
                                            fill: #015cf9
                                        }
                                    </style>
                                    <path
                                        d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                </svg></a>

                            @break
                            @case('Instagram')
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                </svg>
                            </a>
                            @break
                            @case('Twitter')
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" class="w-6 h-6 svg2" viewBox="0 0 512 512">
                                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <style>
                                        .svg2 {
                                            fill: #2270f7
                                        }
                                    </style>
                                    <path
                                        d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                                </svg>
                            </a>
                            @break
                            @case('Linkedin')
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z" />
                                </svg>
                            </a>
                            @break
                            @case('Tiktok')
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                                </svg>
                            </a>
                            @break
                            @case('Youtube')
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" class=".svg4" viewBox="0 0 576 512">

                                    <style>
                                        .svg4 {
                                            fill: #ff0000
                                        }
                                    </style>
                                    <path
                                        d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
                                </svg>
                            </a>
                            @break


                            @default

                            @endswitch



                            @empty

                            @endforelse





                        </div>
                    </div>
                    @endif
                    <div class="flex flex-col mt-4">

                        <div class="text-base text-gray-600 dark:text-gray-500">
                            <h1>Sous categorie cle</h1>
                        </div>
                        <div>
                            <div class="inline-flex flex-wrap items-center gap-3 mt-4 min:h-12 group">


                                @forelse ($subCategories as $subCategory)
                                @if ($loop->index < 5) <span data-tooltip-target="{{$subCategory->id}}"
                                    class="items-center py-1 cursor-default px-2 rounded-md text-[12px] lg:text-[14px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    {{$subCategory->name}}
                                    </span>

                                    <div id="{{$subCategory->id}}" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        {{$subCategory->name}}
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                    @endif
                                    @if ($loop->last && $loop->remaining > 0)
                                    <span class="ml-2 text-sm text-gray-500">(+{{$loop->remaining}} de plus)</span>
                                    @endif
                                    @empty
                                    <p>Aucune sous-catégorie trouvée.</p>
                                    @endforelse


                            </div>
                        </div>

                    </div>

                    <div class="flex flex-col mt-4">
                        @if(isset($freelance->skill) )


                        <div class="text-base text-gray-600 dark:text-gray-500">
                            <h1>Competences</h1>
                        </div>
                        <div>


                            @foreach($freelance->skill as $value)
                            <div class="inline-flex flex-wrap items-center gap-3 mt-4 min-h-12 group">
                                <span data-tooltip-target=""
                                    class="items-center py-1 cursor-default px-2 rounded-md text-[12px] lg:text-[14px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    {{$value['skill']}}
                                </span>
                            </div>
                            @endforeach

                        </div>
                        @endif
                    </div>

                    @if(!empty($commandeE) || !empty($commandeEn))
                    <div class="flex flex-col mt-4">


                        <div class="text-base text-gray-600 dark:text-gray-500">
                            <h1>Commande</h1>
                        </div>


                        <div class="flex justify-between mt-4">
                            <span>Effectuer</span>
                            <span
                                class="items-center py-1 cursor-default px-2 rounded-md text-[14px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                {{$commandeE}}
                            </span>
                        </div>
                        <div class="flex justify-between mt-4">
                            <span>En Cours</span>
                            <span
                                class="items-center py-1 cursor-default px-2 rounded-md text-[14px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                {{$commandeEn}}
                            </span>

                        </div>


                    </div>
                    @endif

                    @if(!empty($freelance->certificat))
                    <div>
                        <div x-data="{open:false}" class="relative mb-3">
                            <h6 class="mb-0">
                                <button @click="open=!open"
                                    class="relative flex items-center w-full p-4 text-base font-semibold text-left text-gray-600 transition-all ease-in border-b border-solid cursor-pointer border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                                    data-collapse-target="animated-collapse-1">
                                    <span>Certification</span>
                                    <i :class="open? 'rotate-180 transition-transform':''"
                                        class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                                </button>
                            </h6>
                            <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                                <div class="p-4 text-sm leading-normal text-blue-gray-500/80">
                                    @foreach($freelance->certificat as $value)
                                    <div class="rounded-lg ">
                                        <div class="text-base font-bold text-gray-700 dark:text-gray-500">
                                            <div class="flex gap-2 lg:justify-between">
                                                <span>Certifier en :</span>
                                                <span
                                                    class="text-base text-gray-700 dark:text-gray-100">{{$value['certificate']}}</span>
                                            </div>

                                        </div>
                                        <div class="text-base font-bold text-gray-700 dark:text-gray-500">
                                            <div class="flex gap-2 lg:justify-between">

                                                <span>

                                                    Par :
                                                </span>
                                                <span class="text-base text-gray-700 dark:text-gray-100">
                                                    {{$value['delivrer']}} / {{$value['annee']}}

                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    @endif

                    @if($freelance->diplome)
                    <div>
                        <div x-data="{open:false}" class="relative mb-3">
                            <h6 class="mb-0">
                                <button @click="open=!open"
                                    class="relative flex items-center w-full p-4 text-base font-semibold text-left text-gray-600 transition-all ease-in border-b border-solid cursor-pointer border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                                    data-collapse-target="animated-collapse-1">
                                    <span>Education</span>
                                    <i :class="open? 'rotate-180 transition-transform':''"
                                        class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                                </button>
                            </h6>
                            <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                                <div class="p-4 text-sm leading-normal">

                                    @foreach($freelance->diplome as $value)
                                    <div class="flex gap-4">

                                        <div>
                                            <span class="text-base">Diplome En:</span>
                                        </div>

                                        <div class="text-base text-gray-800">
                                            <span>{{$value['diplome']}} / </span>

                                            <span>{{$value['universite']}} / </span>
                                            <span>{{$value['annee']}} </span>
                                        </div>


                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>


                    </div>

                    @endif

                    <div class="w-full px-2 mt-8">
                        <button type="button" wire:click="conversation()"
                            class="block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button" data-ripple-light="true">
                            Contacter
                        </button>

                    </div>

                    <div class="lg:h-48">

                    </div>

                </div>



        </div>
        </aside>
        <main class="w-full p-6 rounded lg:w-8/12">

            <div class="hidden">
                {{-- @include('include.breadcumbUser',['findFreelance'=>'findFreelance'])--}}
            </div>

            <section class="bg-white rounded-md dark:bg-gray-800">
                <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="max-w-3xl mx-auto ">
                        <h2
                            class="text-lg font-bold text-center text-gray-800 xl:text-3xl md:text-xl dark:text-gray-200">
                            General
                            information</h2>
                        <p class="my-8 text-gray-00 dark:text-gray-300">Apropos de Moi</p>
                        <div x-data="{ showMore: false }"
                            class="max-w-4xl mb-4 text-base text-gray-700 break-words dark:text-gray-300">
                            <template x-if="!showMore">
                                <p class="">{{ \Illuminate\Support\Str::limit($freelance->description, 600) }}</p>

                            </template>
                            <template x-if="showMore">
                                <p>{{ $freelance->description }}</p>

                            </template>

                            @if(mb_strlen($freelance->description) > 600)
                            <div>
                                <button @click="showMore = !showMore">
                                    <span x-show="showMore" class="text-blue-600">Lire moins</span>
                                    <span x-show="!showMore" class="text-blue-600">Lire la suite</span>
                                </button>

                            </div>
                            @endif

                        </div>



                    </div>

            </section>





            <section class="bg-gray-200 dark:bg-gray-900 ">
                <div class="px-2 py-12 mx-auto max-w-7xl sm:px-4 lg:px-4">
                    <div class="mx-auto text-center ">
                        <h2 class="text-3xl font-bold text-gray-800">Mes Services</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-200">Voici quelques-uns des services que j'ai créés
                            sur
                            la plateforme :</p>


                            <div class="py-8 swiper"
                                x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: '2', breakpoints:{0:{slidesPerView:1,},520:{slidesPerView:1,},950:{slidesPerView:2,},1100:{slidesPerView:3,}}, spaceBetween: 15, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
                                <div class="flex items-center justify-between">

                                    <div>

                                    </div>
                                    <div class="flex gap-4 p-2">

                                        <button
                                            class="p-0 rounded-full btn btn-outline btn-circle btn-sm prev-btn hover:bg-slate-300/20 focus:bg-slate-300/20 dark:active:bg-slate-300/25 active:bg-slate-100/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <button
                                            class="p-0 rounded-full btn btn-outline btn-circle btn-sm next-btn hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-5 swiper-wrapper" x-data="{ selected: 'slide-1' }">

                                    @forelse ($freelance->services as $service)
                                    <div class="md:mx-0 swiper-slide ">


                                          @livewire('web.card.service-card',['service' => $service], key($service->id))



                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                    </div>
                </div>
            </section>

            <section class="hidden bg-gray-200 dark:bg-gray-900">
                <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-3xl font-bold text-gray-800">Mes Projets</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-200">Voici quelques-uns des projets sur lesquels
                            j'ai
                            travaillé :</p>
                        <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-2 lg:grid-cols-3">
                            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                                <a href="#">
                                    <img class="object-cover w-full h-48" src="https://via.placeholder.com/500x300"
                                        alt="Projet 1">
                                </a>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-gray-900"><a href="#">Nom du Projet</a></h3>
                                    <p class="mt-2 text-gray-500">Description du projet</p>
                                </div>
                            </div>
                            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                                <a href="#">
                                    <img class="object-cover w-full h-48" src="https://via.placeholder.com/500x300"
                                        alt="Projet 2">
                                </a>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-gray-900"><a href="#">Nom du Projet</a></h3>
                                    <p class="mt-2 text-gray-500">Description du projet</p>
                                </div>
                            </div>
                            <div class="overflow-hidden bg-white rounded-lg shadow-lg">
                                <a href="#">
                                    <img class="object-cover w-full h-48" src="https://via.placeholder.com/500x300"
                                        alt="Projet 3">
                                </a>
                                <div class="p-6">
                                    <h3 class="text-lg font-bold text-gray-900"><a href="#">Nom du Projet</a></h3>
                                    <p class="mt-2 text-gray-500">Description du projet</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @empty(!$commentaires)

            <section class="bg-gray-100 dark:bg-gray-800">
                <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-3xl font-bold text-gray-800">Témoignages</h2>
                        <p class="mt-4 text-gray-500">Voici ce que mes clients satisfaits ont à dire :</p>
                        <div class="grid grid-cols-1 gap-4 mt-8 sm:grid-cols-2 lg:grid-cols-3">

                            @forelse ($commentaires as $commentaire)
                            <div class="overflow-hidden bg-gray-900 border-b border-gray-300 rounded-lg ">
                                <div class="flex flex-col items-center justify-center gap-2 p-4">
                                    <p class="mt-2 text-gray-500">{{$commentaire->commentaires}}</p>

                                    <p class="mt-2 text-base text-gray-400 dark:text-gray-600">
                                        Serivice: <span class="text-gray-300 dark:text-gray- 700"><a
                                                href="">{{$commentaire->order->service->title}}</a></span>
                                    </p>

                                    <div class="flex items-center mx-auto space-x-1">
                                        @for ($i = 1; $i <= 5; $i++) @if ($i <=$commentaire->satisfaction)
                                            <svg class="w-4 h-4 text-yellow-300" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                            @else
                                            <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 22 20">
                                                <path
                                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                            @endif
                                            @endfor
                                    </div>


                                    <p class="mt-2 font-medium text-gray-800">{{$commentaire->order->user->name}}</p>
                                </div>
                            </div>
                            @empty

                            @endforelse

                        </div>
                    </div>

                </div>
            </section>

            @endempty


            <section class="p-6 mt-6 bg-gray-100 rounded-md shadow-sm dark:bg-gray-900">


                <div class="max-w-4xl mx-auto mb-4 text-center">
                        <h2 class="text-3xl font-bold text-gray-800">Mes réalisations</h2>
                        <p class="mt-4 text-gray-500">Voici ce que mes clients satisfaits ont à dire :</p>
                </div>


                <div class="grid grid-cols-1 gap-4 ">
                    @foreach($freelance->realisations as $realisation)
                    <div class="p-4 bg-white rounded-md shadow">
                        <div class="flex flex-row gap-2 p-4 mb-4">
                            <div x-init="$nextTick(()=>$el._x_swiper = new Swiper($el,{ navigation: {prevEl: '.swiper-button-prev', nextEl: '.swiper-button-next'}, pagination: { el: '.swiper-pagination',type: 'progressbar'},lazy: true,}))"
                                class="rounded-lg swiper">
                                <div class="swiper-wrapper">

                                    @foreach($realisation['image'] as $image)


                                        <div class="p-2 swiper-slide">
                                            <img class="object-fill w-full h-full rounded-md swiper-lazy" src="{{Storage::disk('local')->url($image) }}" alt="" />
                                            <div  class="hidden swiper-lazy-preloader"></div>
                                        </div>
                                    @endforeach


                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                        <div class="p-4 mt-2 font-sans text-gray-700 dark:text-gray-200">
                            {!! $realisation['description'] !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>


        </main>


    </div>


    <script>
        function truncateText(text, length) {
                return text.length > length ? text.slice(0, length) + '...' : text;
            }
    </script>



<div x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 200) ? true : false">
    <!-- Bouton Retour en haut -->
    <button x-collapse x-show="showButton" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed p-2 text-white transition duration-300 ease-in-out rounded-full shadow-lg bottom-4 right-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:shadow-xl focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</div>

</div>
