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
            <div style="top:8rem;" class="sticky p-4 dark:bg-navy-800 card sm:p-5">
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
                            :class="activeTab === 'AccountP' ?'border-amber-600 border-b':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class=" group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'AccountP' ?'':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="">Comptes Utilisateur</span>
                        </a>
                    </li>
                    <li>
                        <a @click="activeTab = 'AccountF'"
                            :class="activeTab === 'AccountF' ?'border-amber-600 border-b':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class=" group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'AccountF' ?'':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
                                class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Comptes Freelance</span>
                        </a>
                    </li>
                    <li>
                        <a @click="activeTab = 'Notification'"
                            :class="activeTab === 'Notification' ?'border-amber-600 border-b':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class=" group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'Notification' ?'':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
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
                            :class="activeTab === 'Security' ?'border-amber-600 border-b':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class="group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                :class="activeTab === 'Security' ?'':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
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
                            :class="activeTab === 'Privacy' ?'border-amber-600 border-b':'hover:bg-slate-100 text-slate-700 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100'"
                            class="group flex items-center space-x-2 rounded-lg  px-4 py-2.5 tracking-wide  outline-none transition-all "
                            href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                :class="activeTab === 'Privacy' ?'':'transition-colors text-slate-400 group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200'"
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




        @include('livewire.freelance.profile.profile-update')



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
            <div class="mt-10 sm:mt-0 ">
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
