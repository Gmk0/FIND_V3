<div class="">
    <div x-show="!loading" x-cloak
    x-transition:enter="ease-out"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="ease-in"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"


    >
        <div x-effect="if($store.global.isSearchbarActive) isShowPopper = false"
            x-data="usePopper({ placement: 'bottom-end', offset: 12 })"
            @click.outside="if(isShowPopper) isShowPopper = false" class="flex">
            <button @click="isShowPopper = !isShowPopper" x-ref="popperRef"
                class="flex p-2 text-gray-100 rounded-lg hover:text-gray-900 dark:text-gray-400 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-300" stroke="currentColor" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15.375 17.556h-6.75m6.75 0H21l-1.58-1.562a2.254 2.254 0 01-.67-1.596v-3.51a6.612 6.612 0 00-1.238-3.85 6.744 6.744 0 00-3.262-2.437v-.379c0-.59-.237-1.154-.659-1.571A2.265 2.265 0 0012 2c-.597 0-1.169.234-1.591.65a2.208 2.208 0 00-.659 1.572v.38c-2.621.915-4.5 3.385-4.5 6.287v3.51c0 .598-.24 1.172-.67 1.595L3 17.556h12.375zm0 0v1.11c0 .885-.356 1.733-.989 2.358A3.397 3.397 0 0112 22a3.397 3.397 0 01-2.386-.976 3.313 3.313 0 01-.989-2.357v-1.111h6.75z" />
                </svg>

                <sub>
                    <span class="bg-red-600 text-gray-100 px-1.5 py-0.5 rounded-full -ml-1 animate-pulse">
                        {{count(Auth::user()->unReadNotifications)}}
                    </span>
                </sub>
            </button>
            <div wire:ignore.self :class="isShowPopper && 'show'" class="popper-root" x-ref="popperRoot">
                <div x-data="{ activeTab: 'tabAll' }"
                    class="popper-box mx-4 mt-1 flex max-h-[calc(100vh-6rem)] w-[calc(100vw-2rem)] flex-col rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark sm:m-0 sm:w-80">
                    <div class="rounded-t-lg bg-slate-100 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                        <div class="flex items-center justify-between px-4 pt-2">
                            <div class="flex items-center space-x-2">
                                <h3 class="font-medium text-slate-700 dark:text-navy-100">
                                    Notifications
                                </h3>
                                <div
                                    class="badge h-5 rounded-full bg-primary/10 px-1.5 text-primary dark:bg-accent-light/15 dark:text-accent-light">
                                    {{count(Auth::user()->unReadNotifications)}}
                                </div>
                            </div>

                            <div x-data="usePopper({placement:'bottom-start',offset:4})"
                                @click.outside="isShowPopper && (isShowPopper = false)" class="inline-flex">

                                <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                                    class="p-0 rounded-full m- btn2 center h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>

                                <div x-ref="popperRoot" x-show="isShowPopper" x-cloak class="popper-root"
                                    :class="isShowPopper && 'show'">
                                    <div
                                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                        <ul>
                                            <li>
                                                <a wire:click="markReads()" href="#"
                                                    class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-primary hover:text-white focus:bg-primary focus:text-white dark:hover:bg-accent dark:focus:bg-accent">Marquer
                                                    tout lue</a>
                                            </li>

                                        </ul>

                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="flex px-3 overflow-x-auto is-scrollbar-hidden shrink-0">
                            <button @click="activeTab = 'tabAll'"
                                :class="activeTab === 'tabAll' ?
                                                'border-primary  dark:border-accent bg-transparent text-primary dark:text-accent-light' :
                                                'border-transparent hover:text-slate-800 focus:text-slate-800 bg-transparent dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class=" shrink-0 rounded-none border-b-2 px-3.5 py-2.5">
                                <span>All</span>
                            </button>
                            <button @click="activeTab = 'tabAlerts'"
                                :class="activeTab === 'tabAlerts' ?
                                                'border-primary dark:border-accent text-primary dark:text-accent-light' :
                                                'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class=" shrink-0 rounded-none border-b-2 px-3.5 py-2.5">
                                <span>Commande</span>
                            </button>
                            <button @click="activeTab = 'tabEvents'"
                                :class="activeTab === 'tabEvents' ?
                                                'border-primary dark:border-accent text-primary dark:text-accent-light' :
                                                'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class=" shrink-0 rounded-none border-b-2 px-3.5 py-2.5">
                                <span>Event</span>
                            </button>
                            <button @click="activeTab = 'tabLogs'"
                                :class="activeTab === 'tabLogs' ?
                                                'border-primary dark:border-accent text-primary dark:text-accent-light' :
                                                'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class=" shrink-0 rounded-none border-b-2 px-3.5 py-2.5">
                                <span>Logs</span>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col overflow-hidden ">
                        <div x-show="activeTab === 'tabAll'" x-transition:enter="transition-all duration-300 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                            class="px-4 py-4 space-y-4 overflow-y-auto is-scrollbar-hidden">

                            @forelse ($notification as $notification)
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-lg shrink-0 bg-amber-600/10 dark:bg-amber-600/15">
                                    <i class="{{ $notification->data['icon']}} text-amber-600 dark:text--amber-600"></i>

                                </div>

                                <a href="#" class="flex flex-col items-start"
                                    wire:click="markRead('{{$notification->id}}')">
                                    @if (isset($notification->data['title']))
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        {{ $notification->data['title']}}
                                    </p>
                                    @else
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        Notifications
                                    </p>

                                    @endif

                                    <div class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                        {!! $notification->data['message'] !!}
                                    </div>
                                </a>
                            </div>
                            @empty

                            <div class="pb-8 mt-8 text-center">
                                <img class="mx-auto w-36" src="{{ asset('images/illustrations/empty.svg') }}" alt="image" />
                                <div class="mt-5">
                                    <p class="text-base font-semibold text-slate-700 dark:text-navy-100">
                                        Pas de notificacion
                                    </p>

                                </div>
                            </div>
                            @endforelse


                        </div>
                        <div x-show="activeTab === 'tabAlerts'" x-transition:enter="transition-all duration-300 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                            class="px-4 py-4 space-y-4 overflow-y-auto is-scrollbar-hidden">

                            @forelse ($commande as $notificationCommande)
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-lg shrink-0 bg-amber-600/10 dark:bg-amber-600/15">
                                    <i
                                        class="{{ $notificationCommande->data['icon']}} text-amber-600 dark:text--amber-600"></i>

                                </div>
                                <a href="{{$notificationCommande->data['url']}}">
                                    @if (isset($notificationCommande->data['title']))
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        {{ $notificationCommande->data['title']}}
                                    </p>
                                    @else
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        Notifications
                                    </p>

                                    @endif

                                    <div class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                        {!! $notificationCommande->data['message'] !!}
                                    </div>
                                </a>
                            </div>
                            @empty

                            <div class="pb-8 mt-8 text-center">
                                <img class="mx-auto w-36" src="{{ asset('images/illustrations/empty.svg') }}" alt="image" />
                                <div class="mt-5">
                                    <p class="text-base font-semibold text-slate-700 dark:text-navy-100">
                                        Pas de notificacion
                                    </p>

                                </div>
                            </div>
                            @endforelse
                        </div>
                        <div x-show="activeTab === 'tabEvents'" x-transition:enter="transition-all duration-300 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                            class="px-4 py-4 space-y-4 overflow-y-auto is-scrollbar-hidden">
                            @forelse ($Progress as $notificationProgress)
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-lg shrink-0 bg-amber-600/10 dark:bg-amber-600/15">
                                    <i
                                        class="{{ $notificationProgress->data['icon']}} text-amber-600 dark:text--amber-600"></i>

                                </div>
                                <a href="{{$notificationProgress->data['url']}}">
                                    @if (isset($notificationProgress->data['title']))
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        {{ $notificationProgress->data['title']}}
                                    </p>
                                    @else
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        Notifications
                                    </p>

                                    @endif

                                    <div class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                        {!! $notificationProgress->data['message'] !!}
                                    </div>
                                </a>
                            </div>
                            @empty

                            <div class="pb-8 mt-8 text-center">
                                <img class="mx-auto w-36" src="{{ asset('images/illustrations/empty.svg') }}" alt="image" />
                                <div class="mt-5">
                                    <p class="text-base font-semibold text-slate-700 dark:text-navy-100">
                                        Pas de notificacion
                                    </p>

                                </div>
                            </div>
                            @endforelse
                        </div>
                        <div x-show="activeTab === 'tabLogs'" x-transition:enter="transition-all duration-300 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                            class="px-4 overflow-y-auto is-scrollbar-hidden">
                            <div class="pb-8 mt-8 text-center">
                                <img class="mx-auto w-36" src="{{ asset('images/illustrations/empty-girl-box.svg') }}"
                                    alt="image" />
                                <div class="mt-5">
                                    <p class="text-base font-semibold text-slate-700 dark:text-navy-100">
                                        Aucun journal
                                    </p>
                                    <p class="text-slate-400 dark:text-navy-300">
                                        Il n'y a pas encore de journaux non lus
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
