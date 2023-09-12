<div x-data="{showModalStudent:false,showModalCompetence:false,showModalCompte:false, showModalLangue:false,showModalCertificate:false}"
    class="min-h-screen">

    <div class="flex flex-col items-start py-3 space-x-4 lg:py-3">
        <h2 class="mb-4 text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
           Profile Details de la mission
        </h2>

        <div>
           @include('include.bread-cumb-freelance',['profile'=>'profile'])
        </div>
    </div>




    <div x-data="{ activeTab: 'AccountF' }" class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
        <div class="col-span-12 lg:col-span-4">
            <div style="top:8rem;" class="sticky p-4 card sm:p-5">
                <div class="flex items-center space-x-4">
                    <div class="avatar h-14 w-14">


                        @if (!empty(Auth::user()->profile_photo_path))
                        <img class="object-cover rounded-full"
                            src="{{Storage::disk('local')->url(Auth::user()->profile_photo_path) }}" alt="">
                        @else
                        <img class="rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="">
                        @endif


                    </div>
                    <div>
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            {{Auth::user()->freelance->nom}} - {{Auth::user()->freelance->prenom}}
                        </h3>
                        <p class="text-xs+">{{Auth::user()->freelance->category->name}}</p>
                    </div>
                </div>
                <ul class="mt-6 space-y-1.5 font-inter font-medium">
                    <li>
                        <a @click="activeTab = 'AccountP'"
                            :class="activeTab === 'AccountP' ?'bg-primary dark:bg-accent text-white':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class=" group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'AccountP' ?'text-white':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Comptes Utilisateur</span>
                        </a>
                    </li>
                    <li>
                        <a @click="activeTab = 'AccountF'"
                            :class="activeTab === 'AccountF' ?'bg-primary text-white dark:bg-accent':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class=" group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'AccountF' ?'text-white':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Comptes Freelance</span>
                        </a>
                    </li>
                    <li>
                        <a @click="activeTab = 'Notification'"
                            :class="activeTab === 'Notification' ?'bg-primary text-white dark:bg-accent':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class=" group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'Notification' ?'text-white':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                class="w-5 h-5 " fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>

                            <span>Notification</span>
                        </a>
                    </li>
                    <li>
                        <a @click="activeTab = 'Security'"
                            :class="activeTab === 'Security' ?'bg-primary text-white dark:bg-accent':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class="group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'Security' ?'text-white':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Security</span>
                        </a>
                    </li>

                    <li>
                        <a @click="activeTab = 'Privacy'"
                            :class="activeTab === 'Privacy' ?'bg-primary text-white dark:bg-accent':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class="group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                :class="activeTab === 'Privacy' ?'text-white':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span> Privacy & data </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>





        <div x-show="activeTab === 'AccountF'" x-transition:enter="transition-all duration-300 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="col-span-12 lg:col-span-8">

            <div class="md:px-2 ">
                <x-section-border />
                <div class='flex flex-col mx-auto md:gap-6'>
                    <div class="flex justify-between ">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Nom & Prenom') }}
                            </h3>
                        </div>
                    </div>

                    <div class="mt-5 md:mt-0 ">

                        <div class="px-4 py-5 bg-white rounded-lg shadow dark:bg-gray-800 ">
                            <div class="grid grid-cols-1 gap-4 md:gap-6 md:grid-cols-2 md:mb-2">
                                <div>
                                    <x-filament::input.wrapper :valid="! $errors->has('user.name')">
                                        <x-filament::input type="text" id="name" wire:model="user.name" />
                                    </x-filament::input.wrapper>
                                    <x-input-error for="user.name" class="mt-2" />
                                </div>


                            <x-filament::input.wrapper :valid="! $errors->has('freelance.nom')">
                                <x-filament::input type="text" wire:model="freelance.nom" />
                            </x-filament::input.wrapper>
                            <x-filament::input.wrapper :valid="! $errors->has('freelance.prenom')">
                                <x-filament::input type="text" wire:model="freelance.prenom" />
                            </x-filament::input.wrapper>
                            <x-filament::input.wrapper prefix-icon="heroicon-m-phone" :valid="! $errors->has('user.phone')">
                                    <x-filament::input type="text" placeholder="telephone" wire:model="user.phone" />
                            </x-filament::input.wrapper>

                                <x-filament::input.wrapper prefix-icon="heroicon-m-currency-dollar">
                                    <x-filament::input type="number" wire:model="freelance.taux_journalier" />
                                </x-filament::input.wrapper>

                                <x-filament::input.wrapper>
                                    <x-filament::input.select :valid="! $errors->has('freelance.experience')" :native='false' wire:model="freelance.experience">
                                        <option value="0-2">0-2 ans</option>
                                        <option value="2-7">2-7 ans</option>
                                        <option value="7">+7ans</option>
                                    </x-filament::input.select>
                                </x-filament::input.wrapper>



                                <div class="md:col-span-2">
                                    <x-filament::input.wrapper prefix-icon="heroicon-m-envelope">
                                        <x-filament::input type="email" wire:model="user.email" />
                                    </x-filament::input.wrapper>

                                </div>
                            </div>
                            <div
                                class="flex items-center justify-end px-4 py-3 mt-2 text-right shadow bg-gray-50 dark:bg-gray-800 sm:rounded-bl-md sm:rounded-br-md">
                                <x-action-message class="mr-3 " on="updateFirts">
                                    {{ __('profiles.Saved') }}
                                </x-action-message>

                                <x-filament::button outlined size="lg" wire:click='updateFirts()'>
                                                        <span>Modifier</span>

                                                    </x-filament::button>



                            </div>

                        </div>



                    </div>
                </div>

                <x-section-border />
                <div class='flex flex-col mt-4 lg:gap-2'>
                    <div class="flex justify-between ">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Localisaction') }} <span class="text-red-600"></span>
                            </h3>


                        </div>


                    </div>

                    <div class="mt-5 md:mt-0">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800  rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="grid gap-6 md:grid-cols-2 md:mb-2">

                                    <x-filament::input.wrapper :valid="! $errors->has('freelance.localisation.avenue')">
                                        <x-filament::input type="text" placeholder="avenue" wire:model="freelance.localisation.avenue" />
                                    </x-filament::input.wrapper>

                                    <x-filament::input.wrapper :valid="! $errors->has('freelance.localisation.ville')">
                                        <x-filament::input type="text" placeholder="ville" wire:model="freelance.localisation.ville" />
                                    </x-filament::input.wrapper>
                                    <x-filament::input.wrapper :valid="! $errors->has('freelance.localisation.commune')">
                                    <x-filament::input type="text" placeholder="commune" wire:model="freelance.localisation.commune" />
                                </x-filament::input.wrapper>

                                <x-filament::input.wrapper suffix-icon="heroicon-m-globe-alt">
                                    <x-filament::input type="text" wire:model="freelance.site" />
                                </x-filament::input.wrapper>





                                </div>

                                <div
                                    class="flex items-center justify-end px-4 py-3 mt-4 text-right shadow bg-gray-50 dark:bg-gray-800 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
                                    <x-action-message class="mr-3 " on="saved">
                                        {{ __('profiles.Saved') }}
                                    </x-action-message>

                                    <x-filament::button outlined size="lg" wire:click='updateLocalisation()'>
                                            <span>Modifier</span>

                                        </x-filament::button>


                                </div>

                            </div>


                        </div>
                    </div>

                </div>
                <x-section-border />
                <div class='flex flex-col mt-4 md:gap-4'>
                    <div class="flex justify-between">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Certification') }} <span class="text-red-600"></span>
                            </h3>

                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 ">
                        <form>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="gap-6 md:grid ">
                                    <table id="table"
                                        class="flex flex-row flex-no-wrap w-full my-5 overflow-hidden rounded-lg sm:bg-white dark:bg-gray-700 sm:shadow-lg">
                                        <thead class="text-white">
                                            @forelse ($freelance['certificat'] as $key=>$value )
                                            <tr
                                                class="flex flex-col mb-2 bg-gray-400 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
                                                <th class="p-3 text-left">certificat</th>
                                                <th class="p-3 text-left">Delivrer par</th>
                                                <th class="p-3 text-left">Annee</th>
                                                <th class="p-3 text-left" colspan="2">Actions</th>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </thead>
                                        <tbody class="flex-1 sm:flex-none">
                                            @forelse ($freelance['certificat'] as $key=>$value )
                                            <tr x-data="{open:false}" x-on:close.window="open=false"
                                                class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0">
                                                <td
                                                    class="p-3 text-gray-700 border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 ">

                                                    <span>{{$value['certificate']}}</span>

                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">


                                                    <span>{{$value['delivrer']}}</span>

                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">
                                                    <span>{{$value['annee']}}</span>





                                                </td>
                                                <td
                                                    class="flex gap-1 p-3 text-red-400 border-t cursor-pointer border-grey-light md:border hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-600 hover:font-medium">

                                                        <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="remove({{$key}},'certificate')" />


                                                        <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier" wire:click="modalCertificate({{$key}})" />






                                                </td>
                                            </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">

                                    <x-filament::button color="info" outlined size="lg" @click="showModalCertificate=true">
                                                <span>ajouter</span>

                                            </x-filament::button>



                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <x-section-border />
                <div class='flex flex-col mt-4 md:gap-6'>
                    <div class="flex justify-between ">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Education') }} <span class="text-red-600"></span>
                            </h3>

                        </div>
                    </div>

                    <div class="mt-5 md:mt-0 ">
                        <form x-data="{form:false}">
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                <div class="gap-6 md:grid ">


                                    <table id="table"
                                        class="flex flex-row flex-no-wrap w-full my-5 overflow-hidden rounded-lg sm:bg-white dark:bg-gray-700 sm:shadow-lg">
                                        <thead class="text-white">
                                            @forelse ($freelance['diplome'] as $key=>$value )
                                            <tr
                                                class="flex flex-col mb-2 bg-gray-400 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
                                                <th class="p-3 text-left">universite</th>
                                                <th class="p-3 text-left">Diplome</th>
                                                <th class="p-3 text-left">Annee</th>
                                                <th class="p-3 text-left" width="110">Actions</th>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </thead>
                                        <tbody class="flex-1 sm:flex-none">

                                            @forelse ($freelance['diplome'] as $key=>$value )
                                            <tr x-data="{open:false}" x-on:close.window="open=false"
                                                class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0">
                                                <td
                                                    class="p-3 text-gray-700 border border-gray-500 dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 ">

                                                    <span>{{$value['universite']?? null}}</span>





                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">


                                                    <span >{{$value['diplome'] ?? null}}</span>


                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">


                                                    <span>{{$value['annee']?? null}}</span>



                                                </td>
                                                <td
                                                    class="flex gap-1 p-3 border-t cursor-pointer border-grey-light lg:border hover:bg-gray-100 dark:hover:bg-gray-800 hover:font-medium">

                                                    <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="remove({{$key}},'universite')" />


                                                    <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier" wire:click="modalDiplome({{$key}})" />







                                                </td>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>

                                </div>
                                <div class="mt-4">

                                    <x-filament::button color="info" outlined size="lg" @click="showModalStudent=true">
                                                        <span>ajouter</span>

                                                    </x-filament::button>




                                </div>

                            </div>


                        </form>
                    </div>

                </div>




                <x-section-border />
                <div class='flex flex-col mt-4 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Vos competences') }} <span class="text-red-600"></span>
                            </h3>

                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                <div class="gap-6 md:grid ">

                                    <table id="table"
                                        class="flex flex-row flex-no-wrap w-full my-5 overflow-hidden rounded-lg sm:bg-white dark:bg-gray-700 sm:shadow-lg">
                                        <thead class="text-white">
                                            @forelse ($freelance['competences'] as $key=>$value )
                                            <tr
                                                class="flex flex-col mb-2 bg-gray-400 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
                                                <th class="p-3 text-left">Compentences</th>
                                                <th class="p-3 text-left">Niveau</th>

                                                <th class="p-3 text-left" colspan="2">Actions</th>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </thead>
                                        <tbody class="flex-1 sm:flex-none">
                                            @forelse ($freelance['competences'] as $key=>$value )
                                            <tr x-data="{open:false}" x-on:close.window="open=false"
                                                class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0">
                                                <td
                                                    class="p-3 text-gray-700 border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 ">



                                                    <span class="truncate">{{$value['skill']}}</span>




                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">

                                                    <span>{{$value['level']}}</span>




                                                </td>

                                                <td
                                                    class="flex gap-1 p-3 text-red-400 border-t cursor-pointer border-grey-light md:border hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-600 hover:font-medium">

                                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="remove({{$key}},'skill')" />


                                                                <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier" wire:click="modaleCompentences({{$key}})" />





                                                </td>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>



                                </div>

                                <div class="mt-4">

                                    <x-filament::button color="info" outlined size="lg" @click="showModalCompetence=true">
                                                <span>ajouter</span>

                                            </x-filament::button>



                                </div>

                            </div>


                        </form>
                    </div>

                </div>

                <x-section-border />
                <div class='flex flex-col mt-4 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Langue') }} <span class="text-red-600"></span>
                            </h3>

                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                <div class="gap-6 md:grid ">



                                    <table id="table"
                                        class="flex flex-row flex-no-wrap w-full my-5 overflow-hidden rounded-lg sm:bg-white dark:bg-gray-700 sm:shadow-lg">
                                        <thead class="text-white">
                                            @forelse ($freelance['langue'] as $key=>$value )
                                            <tr
                                                class="flex flex-col mb-2 bg-gray-400 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
                                                <th class="p-3 text-left">Langue</th>
                                                <th class="p-3 text-left">Niveau</th>

                                                <th class="p-3 text-left" width="110">Actions</th>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </thead>
                                        <tbody wire:ignore.self class="flex-1 sm:flex-none">
                                            @forelse ($freelance['langue'] as $key=>$value )
                                            <tr x-data="{open:false}" x-on:close.window="open=false"
                                                class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0">
                                                <td
                                                    class="p-3 text-gray-700 border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 ">

                                                    <span>{{$value['name']}}</span>








                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border-t border-grey-light md:border dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">



                                                    <span>{{$value['level']}}</span>



                                                </td>

                                                <td
                                                    class="border-grey-light border-t md:border  flex gap-1 hover:bg-gray-100 dark:hover:bg-gray-800 p-2.5 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">

                                                        <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="remove({{$key}},'Langue')" />


                                                        <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier" wire:click="modalLangue({{$key}})" />
                                                </td>
                                            </tr>

                                            @empty

                                            <tr>
                                                <td colspan="1" class="py-4 text-center">Aucune langue ajoutée'
                                                </td>
                                            </tr>

                                            @endforelse

                                        </tbody>
                                    </table>

                                </div>


                                <div class="mt-4">


                                    <x-filament::button color="info" outlined size="lg" @click="showModalLangue=true">
                                            <span>ajouter</span>

                                </x-filament::button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <x-section-border />
                <div class='flex flex-col mt-4 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Comptes lie') }}
                            </h3>
                        </div>

                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                <div class="gap-6 md:grid ">

                                    @if(!empty($freelance['comptes']))
                                    <table id="table"
                                        class="flex flex-row flex-no-wrap w-full my-5 overflow-hidden rounded-lg sm:bg-white dark:bg-gray-700 sm:shadow-lg">
                                        <thead class="text-white">
                                            @forelse ($freelance['comptes'] as $key=>$value )
                                            <tr
                                                class="flex flex-col mb-2 bg-gray-400 rounded-l-lg flex-no wrap sm:table-row sm:rounded-none sm:mb-0">
                                                <th class="p-3 text-left">comptes</th>
                                                <th class="p-3 text-left">lien</th>

                                                <th class="p-3 text-left" width="110">Actions</th>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </thead>
                                        <tbody class="flex-1 sm:flex-none">
                                            @forelse ($freelance['comptes'] as $key=>$value )
                                            <tr class="flex flex-col mb-2 flex-no wrap sm:table-row sm:mb-0">
                                                <td
                                                    class="p-3 text-gray-700 border-t border-grey-light md:border dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100 ">



                                                    <span>{{$value['comptes']}}</span>







                                                </td>
                                                <td
                                                    class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">
                                                    <span>{{$value['lien']}}</span>





                                                </td>

                                                <td
                                                    class="flex gap-1 p-3 text-red-400 border-t cursor-pointer border-grey-light md:border hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-600 hover:font-medium">


                                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="remove({{$key}},'Comptes')" />


                                                            <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier" wire:click="modalComptes({{$key}})" />




                                                </td>
                                            </tr>

                                            @empty

                                            @endforelse

                                        </tbody>
                                    </table>
                                    @endif

                                </div>


                                <div class="mt-4">

                                    <x-filament::button color="info" outlined size="lg" @click="showModalCompte=true">
                                        <span>ajouter</span>

                                    </x-filament::button>



                                </div>

                            </div>


                        </form>
                    </div>

                </div>



            </div>
        </div>

        <div x-show="activeTab === 'AccountP'" x-transition:enter="transition-all duration-300 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="col-span-12 lg:col-span-8">



            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')

            <x-section-border />
            @endif
        </div>
        <div x-show="activeTab === 'Notification'" x-transition:enter="transition-all duration-300 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="col-span-12 lg:col-span-8">



            <livewire:user.user.notification-config />
        </div>

        <div x-show="activeTab === 'Security'" x-transition:enter="transition-all duration-300 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="col-span-12 lg:col-span-8">


            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-10 sm:mt-0">
                @livewire('profile.update-password-form')
            </div>

            <x-section-border />
            @endif
            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-section-border />
            @endif

        </div>

        <div x-show="activeTab === 'Privacy'" x-transition:enter="transition-all duration-300 easy-in-out"
            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" class="col-span-12 lg:col-span-8">


            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

        </div>
    </div>



    <div x-on:opendiplome.window="showModalStudent=true">


        <div x-on:close.window="showModalStudent=false">

            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModalStudent" role="dialog" @keydown.window.escape="showModalStudent = false">
                <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60"
                    @click="showModalStudent = false" x-show="showModalStudent" x-transition:enter="ease-out"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
                <div class="relative w-full max-w-lg transition-all duration-300 origin-top bg-white rounded-lg dark:bg-navy-700"
                    x-show="showModalStudent" x-transition:enter="easy-out"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="easy-in" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex justify-between px-4 py-3 rounded-t-lg bg-slate-200 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Education
                        </h3>
                        <button @click="showModalStudent = !showModalStudent"
                            class="btn2 -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-4 py-4 sm:px-5">

                        <div class="mt-4 space-y-4">

                            <div class="grid grid-cols-1 gap-4">

                                <div>
                                    <x-filament::input.wrapper :valid="! $errors->has('diplome.universite')">
                                        <x-filament::input type="text" id="name" placeholder="universite" wire:model="diplome.universite" />
                                    </x-filament::input.wrapper>
                                    <x-input-error for="diplome.universite" class="mt-2" />
                                </div>

                                <div>
                                    <x-filament::input.wrapper :valid="! $errors->has('diplome.diplome')">
                                        <x-filament::input type="text" id="name" placeholder="diplome" wire:model="diplome.diplome" />
                                    </x-filament::input.wrapper>
                                    <x-input-error for="diplome.diplome" class="mt-2" />
                                </div>

                                <div>
                                    <x-filament::input.wrapper>
                                        <x-filament::input.select :valid="! $errors->has('diplome.annee')" :native='false'
                                            wire:model="diplome.annee">
                                            <option value="">Choisissez l'annee</option>

                                            @foreach ($date as $key=>$value)

                                            <option value="{{$value}}">{{$value}}</option>

                                            @endforeach


                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>
                                    <x-input-error for="diplome.annee" class="mt-2" />
                                </div>


                            </div>
                            <div class="space-x-2 text-right">

                                <x-filament::button color="danger" outlined size="lg" wire:click='resetAll()' @click="showModalStudent=false">
                                            <span>annuler</span>

                                        </x-filament::button>



                                @if($diplomeEdit)


                                <x-filament::button outlined size="lg" wire:click='modifierDiplome()' >
                                    <span>Modifier</span>

                                </x-filament::button>
                                @else
                                <x-filament::button  outlined size="lg" wire:click='addDiplome()' >
                                                        <span>ajouter</span>

                                                    </x-filament::button>



                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div x-on:openlangue.window="showModalLangue=true">


        <div x-on:close.window="showModalLangue=false">

            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModalLangue" role="dialog" @keydown.window.escape="showModalLangue = false">
                <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60"
                    @click="showModalLangue = false" x-show="showModalLangue" x-transition:enter="ease-out"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
                <div class="relative w-full max-w-lg transition-all duration-300 origin-top bg-white rounded-lg dark:bg-navy-700"
                    x-show="showModalLangue" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="easy-in"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex justify-between px-4 py-3 rounded-t-lg bg-slate-200 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Langue
                        </h3>
                        <button @click="showModalLangue = !showModalLangue"
                            class="btn2 -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-4 py-4 sm:px-5">

                        <div class="mt-4 space-y-4">

                            <div class="grid grid-cols-1 gap-2">
                                <div>
                                    <x-filament::input.wrapper>
                                        <x-filament::input.select :valid="! $errors->has('langueSelected.level')" :native='false' wire:model="langueSelected.level">
                                            <option value="">Choisissez un niveau</option>
                                            <option value="Débutant">Débutant</option>
                                            <option value="Intermédiaire">Intermédiaire</option>
                                            <option value="Avancé">Avancé</option>
                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>
                                    <x-input-error for="langueSelected.level" class="mt-2" />
                                </div>

                                <div>
                                    <x-filament::input.wrapper>
                                        <x-filament::input.select :valid="! $errors->has('langueSelected.name')" :native='false'
                                            wire:model="langueSelected.name">
                                            <option value="">Choisissez un niveau</option>
                                            <option value="Français">Français</option>
                                            <option value="Anglais">Anglais</option>
                                            <option value="Lingala">Lingala</option>
                                            <option value="Kikongo">Kikongo</option>
                                            <option value="Tshiluba">Tshiluba</option>
                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>
                                    <x-input-error for="langueSelected.name" class="mt-2" />
                                </div>


                            </div>
                            <div class="space-x-2 text-right">

                                <x-filament::button color="danger" outlined size="lg" wire:click='resetAll()' @click="showModalLangue=false">
                                                <span>annuler</span>

                                            </x-filament::button>

                                @if($langueEdit)


                                <x-filament::button outlined size="lg" wire:click='modifierLangue()'>
                                    <span>Modifuer</span>

                                </x-filament::button>

                                @else

                                <x-filament::button outlined size="lg" wire:click='addLanguage()'>
                                            <span>ajouter</span>

                                        </x-filament::button>


                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div x-on:opencerti.window="showModalCertificate=true">


        <div x-on:close.window="showModalCertificate=false">

            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModalCertificate" role="dialog" @keydown.window.escape="showModalCertificate = false">
                <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60"
                    @click="showModalCertificate = false" x-show="showModalCertificate" x-transition:enter="ease-out"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
                <div class="relative w-full max-w-lg transition-all duration-300 origin-top bg-white rounded-lg dark:bg-navy-700"
                    x-show="showModalCertificate" x-transition:enter="easy-out"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="easy-in" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex justify-between px-4 py-3 rounded-t-lg bg-slate-200 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Certificat
                        </h3>
                        <button @click="showModalCertificate = !showModalCertificate"
                            class="btn2 -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-4 py-4 sm:px-5">

                        <div class="mt-4 space-y-4">

                            <div class="grid grid-cols-1 gap-4">

                                <div>
                                    <x-filament::input.wrapper :valid="! $errors->has('certificate.certificate')">
                                        <x-filament::input type="text" id="name" placeholder="Certificat" wire:model="certificate.certificate" />
                                    </x-filament::input.wrapper>
                                    <x-input-error for="certificate.certificate" class="mt-2" />
                                </div>

                                <div>
                                    <x-filament::input.wrapper :valid="! $errors->has('certificate.delivrer')">
                                        <x-filament::input type="text" id="name" placeholder="diplome" wire:model="certificate.delivrer" />
                                    </x-filament::input.wrapper>
                                    <x-input-error for="certificate.delivrer" class="mt-2" />
                                </div>

                                <div>
                                    <x-filament::input.wrapper>
                                        <x-filament::input.select :valid="! $errors->has('certificate.annee')" :native='false'
                                            wire:model="certificate.annee">
                                            <option value="">Choisissez l'annee</option>

                                            @foreach ($date as $key=>$value)

                                            <option value="{{$value}}">{{$value}}</option>

                                            @endforeach


                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>
                                    <x-input-error for="certificate.annee" class="mt-2" />
                                </div>


                            </div>

                            <div class="space-x-2 text-right">

                                <x-filament::button color="danger" outlined size="lg" wire:click='resetAll()' @click="showModalCertificate=false">
                                    <span>annuler</span>

                                </x-filament::button>



                                @if($certificateEdit)


                                <x-filament::button outlined size="lg" wire:click='modifierCertificate()'>
                                    <span>Modifier</span>

                                </x-filament::button>
                                @else
                                <x-filament::button outlined size="lg" wire:click='addCertificate()'>
                                    <span>ajouter</span>

                                </x-filament::button>



                                @endif
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

   <div x-on:opencompte.window="showModalCompte=true">

        <div x-on:close.window="showModalCompte=false">

            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModalCompte" role="dialog" @keydown.window.escape="showModalLangue = false">
                <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60"
                    @click="showModalCompte = false" x-show="showModalCompte" x-transition:enter="ease-out"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
                <div class="relative w-full max-w-lg transition-all duration-300 origin-top bg-white rounded-lg dark:bg-navy-700"
                    x-show="showModalCompte" x-transition:enter="easy-out" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="easy-in"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex justify-between px-4 py-3 rounded-t-lg bg-slate-200 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Comptes
                        </h3>
                        <button @click="showModalCompte = !showModalCompte"
                            class="btn2 -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-4 py-4 sm:px-5">

                        <div class="mt-4 space-y-4">

                            <div class="grid grid-cols-1 gap-2">



                                <div>
                                    <x-filament::input.wrapper>
                                        <x-filament::input.select :valid="! $errors->has('compte.comptes')" :native='false'
                                            wire:model="compte.comptes">
                                            <option value="">Choisissez un Resau</option>
                                            <option value="Tiktok">Tiktok</option>
                                            <option value="instagram">instagram</option>
                                            <option value="twitter">twitter</option>
                                            <option value="Facebook">Facebook</option>




                                        </x-filament::input.select>
                                    </x-filament::input.wrapper>
                                    <x-input-error for="compte.comptes" class="mt-2" />
                                </div>

                                <div>
                                    <x-filament::input.wrapper suffix-icon='heroicon-m-globe-alt' :valid="! $errors->has('compte.lien')">
                                        <x-filament::input type="text" id="name" placeholder="diplome" wire:model="compte.lien" />
                                    </x-filament::input.wrapper>
                                    <x-input-error for="compte.lien" class="mt-2" />
                                </div>


                            </div>
                            <div class="space-x-2 text-right">

                                <x-filament::button color="danger" outlined size="lg" wire:click='resetAll()' @click="showModalCompte=false">
                                    <span>annuler</span>

                                </x-filament::button>



                                @if($comptesEdit)

                                <x-filament::button outlined size="lg" wire:click='modifierCompte()'>
                                                    <span>Modifier</span>

                                </x-filament::button>
                                    @else

                                <x-filament::button outlined size="lg" wire:click='addComptes()'>
                                    <span>ajouter</span>

                                </x-filament::button>




                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div x-on:openskill.window="showModalCompetence=true">

        <div x-on:close.window="showModalCompetence=false">

            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModalCompetence" role="dialog" @keydown.window.escape="showModalLangue = false">
                <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60"
                    @click="showModalCompetence = false" x-show="showModalCompetence" x-transition:enter="ease-out"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
                <div class="relative w-full max-w-lg transition-all duration-300 origin-top bg-white rounded-lg dark:bg-navy-700"
                    x-show="showModalCompetence" x-transition:enter="easy-out"
                    x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="easy-in" x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">
                    <div class="flex justify-between px-4 py-3 rounded-t-lg bg-slate-200 dark:bg-navy-800 sm:px-5">
                        <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                            Competences
                        </h3>
                        <button @click="showModalCompetence = !showModalCompetence"
                            class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-4 py-4 sm:px-5">

                        <div class="mt-4 space-y-4">
                            <div>
                                <x-filament::input.wrapper>
                                    <x-filament::input.select :valid="! $errors->has('competences.level')" :native='false'
                                        wire:model="competences.level">
                                        <option value="">Choisissez un niveau</option>
                                        <option value="Débutant">Débutant</option>
                                        <option value="Intermédiaire">Intermédiaire</option>
                                        <option value="expert">expert</option>
                                    </x-filament::input.select>
                                </x-filament::input.wrapper>
                                <x-input-error for="competences.level" class="mt-2" />
                            </div>
                            <div>
                                <x-filament::input.wrapper  :valid="! $errors->has('competences.skill')">
                                    <x-filament::input type="text" id="name" placeholder="competences" wire:model="competences.skill" />
                                </x-filament::input.wrapper>
                                <x-input-error for="competences.skill" class="mt-2" />
                            </div>






                            <div class="space-x-2 text-right">


                                    <x-filament::button color="danger" outlined size="lg" wire:click='resetAll()' @click="showModalCompetence=false">
                                                <span>annuler</span>

                            </x-filament::button>

                                @if($compentenceEdit)

                                <x-filament::button outlined size="lg" wire:click='modifierCompentences()'>
                                    <span>Modifier</span>

                                </x-filament::button>
                                @else

                                <x-filament::button outlined size="lg" wire:click='addCompetences()'>
                                    <span>ajouter</span>

                                </x-filament::button>

                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
