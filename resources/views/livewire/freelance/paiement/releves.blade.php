<div class="min-h-screen p-2">

    <div class="max-w-3xl mb-2">
        <h2 class="mb-2 text-lg font-semibold tracking-wide uppercase text-amber-600 lg:text-xl">Paiement
        </h2>
    </div>
    <div>
        @include('include.bread-cumb-Freelance',['paiementReleves'=>'Releves'])
    </div>


    <div class="container px-6 mx-auto">

        <!-- En-tête du Relevé -->
        <div class="flex items-center justify-between hidden mb-8">
           <div class="text-right">
                <p class="mb-1 text-xl font-semibold">Solde actuel:</p>
                <p class="text-2xl text-blue-600">{{$solde}} $</p>
            </div>

        </div>

        <!-- Filtres et Recherche -->


        <!-- Récapitulatif -->
    <div x-show="!loading" x-cloak class="grid gap-4 md:grid-cols-3">
        <div class="px-6 py-3 bg-white rounded-lg shadow-xl dark:bg-navy-800">
            <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-gray-700 dark:text-gray-200 ">Total credit</span>

            </div>
            <div class="flex items-center justify-between mt-6">
                <div>
                    <svg class="w-12 h-12 p-1 text-gray-600 border rounded-full bg-amber-400 border-amber-600 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-end">
                        <span class="text-2xl font-bold dark:text-gray-200 2xl:text-4xl">{{$credits}}</span>

                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-3 bg-white rounded-lg shadow-xl dark:bg-navy-800">
            <div class="flex items-center justify-between">
                <span class="text-sm font-bold dark:text-gray-200 text-gary-700">Total debit</span>

            </div>
            <div class="flex items-center justify-between mt-6">
                <div>
                    <svg class="w-12 h-12 p-1 text-gray-600 border rounded-full bg-amber-400 border-amber-600 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-end">
                        <span class="text-2xl font-bold dark:text-gray-200 2xl:text-4xl">{{$debits}} $</span>

                    </div>
                </div>
            </div>
        </div>
        <div class="px-6 py-3 bg-white rounded-lg shadow-xl dark:bg-navy-800">
            <div class="flex items-center justify-between">
                <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Total Paiment</span>

            </div>
            <div class="flex items-center justify-between mt-6">
                <div>
                    <svg class="w-12 h-12 p-1 text-gray-600 border rounded-full bg-amber-400 border-amber-600 2xl:w-16 2xl:h-16 2xl:p-3 bg-opacity-20"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-end">
                        <span class="text-2xl font-bold dark:text-gray-200 2xl:text-4xl">{{$paiments}} $</span>

                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Exportation -->


        <!-- Notifications et Alertes -->

        <!-- Aide et Support -->


        <div class="mt-4">

            {{ $this->table }}
        </div>

    </div>




    <div class="mt-8">
        <a href="#" class="text-blue-600 underline hover:text-blue-700">Besoin d'aide ? Consultez notre FAQ</a>
    </div>
</div>
