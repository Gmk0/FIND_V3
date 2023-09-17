<div class="grid min-h-screen grid-cols-12 gap-4 mt-4 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">

    <div class="col-span-12 dark:bg-navy-800 card lg:col-span-8">
        <div class="flex flex-col justify-between px-4 mt-3 sm:flex-row sm:items-center sm:px-5">
            <div class="flex items-center justify-between flex-1 space-x-2 sm:flex-initial">
                <h2 class="text-sm+ font-medium tracking-wide text-slate-700 dark:text-navy-100">
                    Aperçu de la commande
                </h2>
                <div x-data="usePopper({ placement: 'bottom-start', offset: 4 })"
                    @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                        class="w-8 h-8 p-0 rounded-full btn2 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>

                    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                        <div
                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-600">
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Revenu</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                        Commande</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                        Mission</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                        Chart</a>
                                </li>
                            </ul>
                            <div class="h-px my-1 bg-slate-150 dark:bg-navy-500"></div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-2 gap-3 px-4 py-4 mt-4 sm:mt-5 sm:grid-cols-4 sm:gap-5 sm:px-5 lg:mt-6">
            <div class="p-4 rounded-lg bg-slate-100 dark:bg-navy-600">
                <div class="flex justify-between space-x-1">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        {{$amount}}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-primary dark:text-accent" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="mt-1 text-xs+">Revenu</p>
            </div>
            <div class="p-4 rounded-lg bg-slate-100 dark:bg-navy-600">
                <div class="flex justify-between">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        {{$totalR}}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-success" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <p class="mt-1 text-xs+">Complété</p>
            </div>
            <div class="p-4 rounded-lg bg-slate-100 dark:bg-navy-600">
                <div class="flex justify-between">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        {{$orderCount}}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-warning" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="mt-1 text-xs+">En attente</p>
            </div>
            <div class="p-4 rounded-lg bg-slate-100 dark:bg-navy-600">
                <div class="flex justify-between">
                    <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                        {{$orderCount}}
                    </p>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-info" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </div>
                <p class="mt-1 text-xs+">Dispatch</p>
            </div>
        </div>


    </div>
    <div class="grid grid-cols-2 col-span-12 gap-4 sm:grid-cols-4 sm:gap-5 lg:col-span-4 lg:grid-cols-2 lg:gap-6">
        <div class="col-span-2 px-4 pb-5 dark:bg-navy-800 card sm:px-5">
            <div class="flex items-center justify-between py-3">
                <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                    Budget
                </h2>
                <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })"
                    @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                        class="btn2 -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>

                    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                        <div
                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Another
                                        Action</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Something
                                        else</a>
                                </li>
                            </ul>
                            <div class="h-px my-1 bg-slate-150 dark:bg-navy-500"></div>
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Separated
                                        Link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex space-x-5 grow">
                <div class="flex flex-col w-1/2">
                    <div class="grow">
                        <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                            {{$freelance->solde}} $
                        </p>
                        <a href="#"
                            class="border-b border-dotted border-current pb-0.5 text-tiny font-medium uppercase text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">
                            Yearly Budget
                        </a>
                    </div>
                    <p class="hidden mt-2 text-xs leading-normal line-clamp-3">
                        You have spent about 25% of your annual budget.
                    </p>
                </div>


            </div>
        </div>
        <div class="hidden card">
            <div class="flex items-center justify-between px-4 mt-3 sm:px-5">
                <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                    Income
                </h2>

                <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })"
                    @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                        class="p-0 -mr-2 rounded-full btn h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>

                    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                        <div
                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Another
                                        Action</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Something
                                        else</a>
                                </li>
                            </ul>
                            <div class="h-px my-1 bg-slate-150 dark:bg-navy-500"></div>
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Separated
                                        Link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p class="px-4 text-xl font-semibold grow text-slate-700 dark:text-navy-100 sm:px-5">
                $169.6k
            </p>
            <div class="ax-transparent-gridline">

            </div>
        </div>
        <div class="hidden card">
            <div class="flex items-center justify-between px-4 mt-3 sm:px-5">
                <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                    Expense
                </h2>

                <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })"
                    @click.outside="if(isShowPopper) isShowPopper = false" class="inline-flex">
                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                        class="p-0 -mr-2 rounded-full btn h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                        </svg>
                    </button>

                    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                        <div
                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Another
                                        Action</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Something
                                        else</a>
                                </li>
                            </ul>
                            <div class="h-px my-1 bg-slate-150 dark:bg-navy-500"></div>
                            <ul>
                                <li>
                                    <a href="#"
                                        class="flex items-center h-8 px-3 pr-8 font-medium tracking-wide transition-all outline-none hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Separated
                                        Link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p class="px-4 text-xl font-semibold grow text-slate-700 dark:text-navy-100 sm:px-5">
                $34.6k
            </p>
            <div class="ax-transparent-gridline">

            </div>
        </div>
    </div>

    <div class="col-span-12">
        <div class="flex flex-col gap-2">
            <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                Commandes
            </h2>

            <livewire:freelance.dashboard.commande-table-freelance lazy />


        </div>

    </div>
</div>
