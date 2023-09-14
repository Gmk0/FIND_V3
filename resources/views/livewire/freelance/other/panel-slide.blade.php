<div>
    <div x-show="$store.global.isRightSidebarExpanded"
        @keydown.window.escape="$store.global.isRightSidebarExpanded = false">
        <div class="fixed inset-0 z-[150] bg-slate-900/60 transition-opacity duration-200"
            @click="$store.global.isRightSidebarExpanded = false" x-show="$store.global.isRightSidebarExpanded"
            x-transition:enter="ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>
        <div class="fixed right-0 top-0 z-[151] h-full w-full sm:w-80">
            <div x-data="{ activeTab: 'tabHome' }"
                class="relative flex flex-col w-full h-full transition-transform duration-200 bg-white transform-gpu dark:bg-navy-750"
                x-show="$store.global.isRightSidebarExpanded" x-transition:enter="ease-out"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="ease-in" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full">
                <div class="flex items-center justify-between px-4 py-2">
                    <p x-show="activeTab === 'tabHome'" class="flex shrink-0 items-center space-x-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs">

                            @php
                            $date=now();
                            @endphp

                            {{$date}}

                        </span>
                    </p>
                    <p x-show="activeTab === 'tabProjects'" class="flex shrink-0 items-center space-x-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                        <span class="text-xs">Commande</span>
                    </p>
                    <p x-show="activeTab === 'tabActivity'" class="flex shrink-0 items-center space-x-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs">Activity</span>
                    </p>

                    <button @click="$store.global.isRightSidebarExpanded=false"
                        class="w-6 h-6 p-0 -mr-1 rounded-full btn2 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div x-show="activeTab === 'tabHome'" x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                    class="pt-1 overflow-y-auto is-scrollbar-hidden overscroll-contain">

                    <div class="mt-4">
                        <h2
                            class="px-3 text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Solde
                        </h2>
                        <div class="px-3 mt-3 swiper"
                            x-init="$nextTick(() => new Swiper($el, { slidesPerView: 'auto', spaceBetween: 16 }))">
                            <div class="swiper-wrapper">
                                <div
                                    class="relative flex flex-col w-48 p-3 overflow-hidden swiper-slide h-28 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-600">
                                    <div class="grow">
                                        <h1>Solde</h1>
                                    </div>
                                    <div class="text-white">
                                        <p class="text-lg font-semibold tracuking-wide">
{{$soldeFreelance}} $
                                        </p>


                                    </div>
                                    <div
                                        class="absolute top-0 right-0 w-16 h-16 -m-3 mask is-reuleaux-triangle bg-white/20">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>



                    <div class="mt-4">
                        <h2
                            class="px-3 text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Dernier messages
                        </h2>
                        <div class="hidden px-2 space-y-3 mt-">
                            <div class="flex justify-between space-x-2 rounded-lg bg-slate-100 p-2.5 dark:bg-navy-700">
                                <div class="flex flex-col justify-between flex-1">
                                    <div class="line-clamp-2">
                                        <a href="#"
                                            class="font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">What
                                            is Tailwind CSS?</a>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <div class="avatar h-7 w-7">
                                                <img class="rounded-full" src="{{ asset('images/100x100.png') }}"
                                                    alt="avatar" />
                                            </div>
                                            <div>
                                                <p class="text-xs font-medium line-clamp-1">
                                                    John D.
                                                </p>
                                                <p class="text-tiny+ text-slate-400 line-clamp-1 dark:text-navy-300">
                                                    2 min read
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <button
                                                class="p-0 rounded-full btn2 h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                </svg>
                                            </button>
                                            <button
                                                class="p-0 rounded-full btn2 h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <img src="{{ asset('images/800x600.png') }}"
                                    class="object-cover object-center w-20 h-20 rounded-lg" alt="image" />
                            </div>


                        </div>
                    </div>

                    <div class="px-3 mt-3">
                        <h2 class="text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                            Settings
                        </h2>
                        <div class="flex flex-col mt-2 space-y-2">
                            <label class="inline-flex items-center space-x-2">
                                <input x-model="$store.global.isDarkModeEnabled"
                                    class="w-10 h-5 rounded-lg form-switch bg-slate-300 before:rounded-md before:bg-slate-50 checked:bg-slate-500 checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-navy-400 dark:checked:before:bg-white"
                                    type="checkbox" />
                                <span>Dark Mode</span>
                            </label>
                            <label class="inline-flex items-center space-x-2">
                                <input x-model="$store.global.isMonochromeModeEnabled"
                                    class="w-10 h-5 rounded-lg form-switch bg-slate-300 before:rounded-md before:bg-slate-50 checked:bg-slate-500 checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-navy-400 dark:checked:before:bg-white"
                                    type="checkbox" />
                                <span>Monochrome Mode</span>
                            </label>
                        </div>
                    </div>

                    <div class="hidden px-3 mt-3">
                        <div class="p-3 rounded-lg bg-slate-100 dark:bg-navy-600">
                            <div class="flex items-center justify-between">
                                <p>
                                    <span class="font-medium text-slate-600 dark:text-navy-100">35GB</span>
                                    of 1TB
                                </p>
                                <a href="#"
                                    class="text-xs+ font-medium text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">Upgrade</a>
                            </div>

                            <div class="h-2 mt-2 progress bg-slate-150 dark:bg-navy-500">
                                <div class="w-7/12 rounded-full bg-info"></div>
                            </div>
                        </div>
                    </div>
                    <div class="h-18"></div>
                </div>

                <div x-show="activeTab === 'tabProjects'" x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                    class="px-3 pt-1 overflow-y-auto is-scrollbar-hidden overscroll-contain">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 rounded-lg bg-slate-100 dark:bg-navy-600">
                            <div class="flex justify-between space-x-1">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$pending}}
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" stroke-width="1.5"
                                    class="w-5 h-5 text-primary dark:text-accent" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">En attente</p>
                        </div>
                        <div class="p-3 rounded-lg bg-slate-100 dark:bg-navy-600">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$livre}}
                                </p>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-success" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                            <p class="mt-1 text-xs+">Livré</p>
                        </div>
                        <div class="p-3 rounded-lg bg-slate-100 dark:bg-navy-600">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$enAttente}}
                                </p>

                                <i class="text-base fa fa-spinner text-warning"></i>
                            </div>
                            <p class="mt-1 text-xs+">In Progress</p>
                        </div>
                        <div class="p-3 rounded-lg bg-slate-100 dark:bg-navy-600">
                            <div class="flex justify-between">
                                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                    {{$total}}
                                </p>

                                <i class="text-base fa-solid fa-list-check text-info"></i>
                            </div>
                            <p class="mt-1 text-xs+">Total</p>
                        </div>
                    </div>

                    @forelse ($order as $orderP)
                    <div class="p-3 mt-4 border rounded-lg border-slate-150 dark:border-navy-600">
                        <div class="flex items-center space-x-3">
                            <img class="object-cover object-center w-10 h-10 rounded-lg"
                                src="{{ asset('images/illustrations/lms-ui.svg') }}" alt="image" />
                            <div>
                                <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                                    {{$orderP->order->service->title}}
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    Mise a jour {{$orderP->updated_at->formatLocalized('%e
                                    %B %G')}}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">

                                <div style="width: {{$orderP->order->progress}}%;"
                                    class="w-4/12 rounded-full bg-primary dark:bg-accent"></div>
                            </div>
                            <p class="mt-2 text-right text-xs+ font-medium text-primary dark:text-accent-light">
                                {{$orderP->order->progress}} %
                            </p>
                        </div>

                        <div class="flex items-center justify-between mt-3 space-x-2">
                            <div class="flex -space-x-3">

                                <div class="avatar h-7 w-7 hover:z-10">


                                    @if (!empty(Auth::user()->profile_photo_path))
                                    <img class="rounded-full ring ring-white dark:ring-navy-700"
                                        src="{{Storage::disk('local')->url($orderP->order->user->profile_photo_path) }}"
                                        alt="">
                                    @else
                                    <img class="rounded-full ring ring-white dark:ring-navy-700"
                                        src="{{ $orderP->order->user->profile_photo_url }}" alt="">
                                    @endif

                                </div>
                            </div>
                            <a href="{{route('freelance.Order.view', $orderP->order->order_numero)}}"
                                class="p-0 font-medium rounded-full btn2 h-7 w-7 bg-slate-150 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rotate-45" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty

                    @endforelse






                    <div class="h-18"></div>
                </div>



                <div class="absolute flex justify-center w-full pointer-events-none bottom-4">
                    <div
                        class="pointer-events-auto mx-auto flex space-x-1 rounded-full border border-slate-150 bg-white px-4 py-0.5 shadow-lg dark:border-navy-700 dark:bg-navy-900">
                        <button @click="activeTab = 'tabHome'"
                            :class="activeTab === 'tabHome' && 'text-primary dark:text-accent'"
                            class="px-4 py-0 rounded-full btn2 h-9 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                            <svg x-show="activeTab === 'tabHome'" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <svg x-show="activeTab !== 'tabHome'" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </button>
                        <button @click="activeTab = 'tabProjects'"
                            :class="activeTab === 'tabProjects' && 'text-primary dark:text-accent'"
                            class="px-4 py-0 rounded-full btn2 h-9 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                            <svg x-show="activeTab === 'tabProjects'" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg x-show="activeTab !== 'tabProjects'" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                            </svg>
                        </button>

                        {{--
                        <button @click="activeTab = 'tabActivity'"
                            :class="activeTab === 'tabActivity' && 'text-primary dark:text-accent'"
                            class="px-4 py-0 rounded-full btn2 h-9 hover:bg-slate-300/20 hover:text-primary focus:bg-slate-300/20 focus:text-primary active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:hover:text-accent dark:focus:bg-navy-300/20 dark:focus:text-accent dark:active:bg-navy-300/25">
                            <svg x-show="activeTab ===  'tabActivity'" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg x-show="activeTab !==  'tabActivity'" xmlns="http://www.w3.org/2000/svg"
                                class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
