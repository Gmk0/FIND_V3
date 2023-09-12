<div x-data="{ isOpen:false,isLoading: true,showFilters: false,showSearch: false }"
    x-init="setTimeout(() => { isLoading = false }, 3000) "
    class="flex flex-col min-h-screen ">

    <div class="max-w-3xl mb-2">
        <h2 class="mb-2 text-lg font-semibold tracking-wide uppercase text-amber-600 lg:text-xl">Creation Service
        </h2>
    </div>
    <div>
        @include('include.bread-cumb-freelance',['commande'=>'Commande'])
    </div>


    <div x-show="isLoading">

        <div class="flex flex-col gap-4 p-8 overflow-y-hidden">
            <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-3">
                <div class="h-48 bg-gray-300 rounded-md animate-pulse"></div>
                <div class="h-48 bg-gray-300 rounded-md animate-pulse"></div>
                <div class="h-48 bg-gray-300 rounded-md animate-pulse"></div>
            </div>

            <div
                class="flex-1 w-full min-h-screen p-4 mb-2 overflow-y-auto text-xs bg-gray-200 border-r rounded-md border-amber-300 h-80 animate-pulse custom-scrollbar">



            </div>
        </div>
    </div>


    <div x-show="!isLoading" x-cloak class="grid gap-4 md:grid-cols-3">
        <div class="px-6 py-3 bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-amber-600">En attente</span>

            </div>
            <div class="flex items-center justify-between mt-6">
                <div>
                    <svg class="w-12 h-12 p-1 border rounded-full text-amber-600 bg-amber-400 border-amber-600 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-end">
                        <span class="text-2xl font-bold dark:text-gray-200 2xl:text-4xl">{{$pending}}</span>

                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-3 bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-amber-600">Payer</span>

            </div>
            <div class="flex items-center justify-between mt-6">
                <div>
                    <svg class="w-12 h-12 p-1 border rounded-full text-amber-600 bg-amber-400 border-amber-600 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-end">
                        <span class="text-2xl font-bold dark:text-gray-200 2xl:text-4xl">{{$payer}}</span>

                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-3 bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-amber-600">Annuler</span>

            </div>
            <div class="flex items-center justify-between mt-6">
                <div>
                    <svg class="w-12 h-12 p-1 border rounded-full text-amber-600 bg-amber-400 border-amber-600 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-end">
                        <span class="text-2xl font-bold dark:text-gray-200 2xl:text-4xl">{{$rejeted}}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="!isLoading" x-cloak class="pt-4">


        {{ $this->table }}






    </div>


    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
