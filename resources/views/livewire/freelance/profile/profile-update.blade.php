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

                <div class="px-4 py-5 bg-white rounded-lg shadow dark:bg-navy-800 ">
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
                            <x-filament::input.select :valid="! $errors->has('freelance.experience')" :native='false'
                                wire:model="freelance.experience">
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
                        class="flex items-center justify-end px-4 py-3 mt-2 text-right shadow bg-gray-50 dark:bg-navy-800 sm:rounded-bl-md sm:rounded-br-md">
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
                        class="px-4 py-5 bg-white dark:bg-navy-800  rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                        <div class="grid gap-6 md:grid-cols-2 md:mb-2">

                            <x-filament::input.wrapper :valid="! $errors->has('freelance.localisation.avenue')">
                                <x-filament::input type="text" placeholder="avenue"
                                    wire:model="freelance.localisation.avenue" />
                            </x-filament::input.wrapper>

                            <x-filament::input.wrapper :valid="! $errors->has('freelance.localisation.ville')">
                                <x-filament::input type="text" placeholder="ville"
                                    wire:model="freelance.localisation.ville" />
                            </x-filament::input.wrapper>
                            <x-filament::input.wrapper :valid="! $errors->has('freelance.localisation.commune')">
                                <x-filament::input type="text" placeholder="commune"
                                    wire:model="freelance.localisation.commune" />
                            </x-filament::input.wrapper>

                            <x-filament::input.wrapper suffix-icon="heroicon-m-globe-alt">
                                <x-filament::input type="text" wire:model="freelance.site" />
                            </x-filament::input.wrapper>





                        </div>

                        <div
                            class="flex items-center justify-end px-4 py-3 mt-4 text-right shadow bg-gray-50 dark:bg-navy-800 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">
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

        <div>

            <div class="flex justify-between md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Description') }}
                    </h3>
                </div>

            </div>

            <div class="px-4 py-5 bg-white dark:bg-navy-800">

                <div class="mt-5 md:mt-0 md:col-span-2">

                    <x-textarea wire:model="freelance.description">

                    </x-textarea>



                </div>
                <div
                    class="flex items-center justify-end px-4 py-3 mt-4 text-right shadow bg-gray-50 dark:bg-navy-800 sm:px-6 sm:rounded-bl-md sm:rounded-br-md">

                    <x-filament::button outlined size="lg" wire:click='updateDescription()'>
                        <span>Modifier</span>

                    </x-filament::button>
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
                        class="px-4 py-5 bg-white dark:bg-navy-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
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

                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                wire:click="remove({{$key}},'certificate')" />


                                            <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier"
                                                wire:click="modalCertificate({{$key}})" />






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
                        class="px-4 py-5 bg-white dark:bg-navy-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

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


                                            <span>{{$value['diplome'] ?? null}}</span>


                                        </td>
                                        <td
                                            class="p-3 text-gray-700 truncate border border-grey-light dark:text-gray-200 dark:hover:bg-gray-800 hover:bg-gray-100">


                                            <span>{{$value['annee']?? null}}</span>



                                        </td>
                                        <td
                                            class="flex gap-1 p-3 border-t cursor-pointer border-grey-light lg:border hover:bg-gray-100 dark:hover:bg-gray-800 hover:font-medium">

                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                wire:click="remove({{$key}},'universite')" />


                                            <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier"
                                                wire:click="modalDiplome({{$key}})" />







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
                        class="px-4 py-5 bg-white dark:bg-navy-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

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

                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                wire:click="remove({{$key}},'skill')" />


                                            <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier"
                                                wire:click="modaleCompentences({{$key}})" />





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
                        class="px-4 py-5 bg-white dark:bg-navy-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

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

                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                wire:click="remove({{$key}},'Langue')" />


                                            <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier"
                                                wire:click="modalLangue({{$key}})" />
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
                        class="px-4 py-5 bg-white dark:bg-navy-800 dark:border dark:border-gray-300 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

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


                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                wire:click="remove({{$key}},'Comptes')" />


                                            <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Modifier"
                                                wire:click="modalComptes({{$key}})" />




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
