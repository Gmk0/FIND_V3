<div class="relative min-h-screen pt-16 border-t border-gray-100" x-data="{step: @entangle('step') }" x-cloak>

    <div>
        <header class="bg-white top-0 lg:relative sticky lg:z-0 z-[60] shadow dark:bg-gray-800">
            <div class="px-4 py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col justify-between md:flex-row md:items-center">
                    <ul class="items-center justify-around hidden gap-6 lg:flex">
                        <li :class=" step === 1 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                            <span :class=" step === 1 ? 'bg-amber-600 text-white ' : ''"
                                class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">

                                1
                            </span>
                            <span>Compentences
                            </span>

                        </li>
                        <li :class=" step === 2 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                            <span :class=" step === 2 ? 'bg-amber-600 text-white ' : ''"
                                class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">2
                            </span>
                            <span>Information personnelles
                            </span>

                        </li>
                        <li :class=" step === 3 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                            <span :class=" step === 3 ? 'bg-amber-600 text-white ' : ''"
                                class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">3
                            </span>
                            <span>Formations
                            </span>

                        </li>
                        <li :class=" step === 4 ? 'text-amber-600 ' : ''" class="flex px-1 cursor-pointer ">

                            <span :class=" step === 4 ? 'bg-amber-600 text-white ' : ''"
                                class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">4
                            </span>
                            <span>Comptes lié
                            </span>

                        </li>
                        <li x-on:click.prevent="step = 5" :class=" step === 5 ? 'text-amber-600 ' : ''"
                            class="flex px-1 cursor-pointer ">

                            <span :class=" step === 5 ? 'bg-amber-600 text-white ' : ''"
                                class="flex items-center justify-center w-6 h-6 mr-2 border border-gray-200 rounded-full ">4
                            </span>
                            <span>Sécurite du compte
                            </span>

                        </li>
                    </ul>



                    <div class="block mb-2 rounded-lg dark:bg-gray-800 dark:p-3 lg:hidden">
                        <div class="mb-1 text-xs font-bold leading-tight tracking-wide uppercase text-dark"
                            x-text="`Etape: ${step} of 5`"></div>

                        <div class="flex-1">
                            <div x-show="step === 1">
                                <div class="text-lg font-bold leading-tight text-dark">Compentences
                                </div>
                            </div>
                            <div x-show="step === 2">
                                <div class="text-lg font-bold leading-tight text-dark">Informations Personnelles
                                </div>
                            </div>
                            <div x-show="step === 3">
                                <div class="text-lg font-bold leading-tight text-dark">Formations</div>
                            </div>

                            <div x-show="step === 4">
                                <div class="text-lg font-bold leading-tight text-dark">Comptes lies</div>
                            </div>

                            <div x-show="step === 5">
                                <div class="text-lg font-bold leading-tight text-dark">Securite Du compte
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="items-center w-full md:w-64">
                        <div class="w-full mr-2 bg-gray-100 rounded-full dark:bg-gray-800">
                            <div class="h-2 text-xs leading-none text-center text-white bg-green-500 rounded-full"
                                :style="'width: '+ parseInt(step/ 5 * 100) +'%'"></div>
                        </div>
                        <div class="w-10 text-xs text-dark" x-text="parseInt(step / 5* 100) +'%'">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="mt-8">


            <div class="px-6" x-show.transition.opacity.duration.500ms="step === 1">
                <div class="mb-4 lg:grid lg:grid-cols-3 lg:gap-6">
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                {{ __('VOS COMPTENCES') }}
                            </h3>

                            <p class="mt-1 text-gray-600 text-md dark:text-gray-100">
                                {{ __('Parlez nous un peu de vous. Ces informations apparaîtront sur votre profil
                                public, afin que les acheteurs potentiels
                                puissent mieux vous connaître.') }}
                            </p>
                        </div>
                    </div>

                </div>
                <!-- Categorie  -->
                <x-section-border />
                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Categorie') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Commencez par nous dire dans quel categorie vous vous situer') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div x-data="{showDateInputs: false}"
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="gap-6 md:grid md:grid-cols-1 md:mb-2">
                                    <div class="gap-6 md:grid ">

                                        {{$this->editPostForm}}




                                        <div wire:loading wire:target='category'>
                                            <div class="flex items-center justify-center">
                                                <div class="spinners"></div>




                                            </div>
                                        </div>


                                    </div>

                                    <div class="mt-4 mb-6">
                                        <div x-cloak x-show="showDateInputs" x-collapse>

                                            <p class="mb-3 text-sm italic text-gray-700 dark:text-gray-100">Veuillez
                                                choisir des
                                                competences speciales au
                                                max:3</p>


                                        </div>

                                    </div>




                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <!-- Compentences  -->
                <x-section-border />
                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __(' Compentences') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __("Énumérez les compétences liées aux services que vous offrez et ajoutez votre
                                niveau
                                d'expérience.") }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="">


                                    <div>
                                        <p class="mb-2 text-lg font-bold">Commpetences :</p>
                                        <ul class="mb-4">
                                            - @forelse($selectedSkill as $index => $skill)
                                            <li class="flex items-center">
                                                <span class="mr-1">{{ $skill['skill'] }} - {{ $skill['level']
                                                    }}
                                                </span>

                                                <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="removeLanguage({{$index}},'skill')" />

                                            </li>
                                            @empty
                                            <li>Cliquer sur ajouter </li>
                                            @endforelse
                                        </ul>
                                    </div>


                                    <div class="grid gap-2 mb-4 ">

                                        {{$this->skillForm}}


                                        <div>

                                            <x-filament::button outlined type="button" wire:click='addSkill()'>
                                                <span wire:loading.remove wire:target='addSkill'>Ajouter</span><span wire:loading
                                                    wire:target='addSkill'>Ajout...</span>
                                            </x-filament::button>



                                        </div>

                                    </div>
                                    <div>
                                        @error('skill')
                                        <p>Veuillez rajouter une compences</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Prix  -->
                <x-section-border />
                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre taux Journalier') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __("Indiquez Votre taux journalier moyen , sachant qu'une journee represente
                                environ 8 heures de travail") }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="">

                                <x-inputs.currency placeholder="Taux" icon="currency-dollar" thousands="." decimal="," precision="4"
                                wire:model="currency" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>



                <!-- Localisation  -->
                <x-section-border />
                <div class='md:grid md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Localisation') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Ou travaillez-vous le plus souvent.') }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="grid gap-2 md:grid-cols-3">



                                    <x-select class="w-full" wire:model.live="localisation.ville" placeholder="Ville"
                                        :async-data="route('api.city')" option-label="ville" option-value="ville" />


                                        <x-input id="name" placeholder="{{__('commune')}}" type="text" wire:model='localisation.commune' />

                                    <x-input id="name" placeholder="{{__('avenue')}}" type="text"
                                        wire:model='localisation.avenue' />











                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="flex justify-between md:col-span-1">

                        </div>
                        <div class="mt-2 md:mt-4 md:col-span-2">
                            {{--
                            <x-errors only="SousCategorie" />--}}
                        </div>

                    </div>

                </div>

            </div>

            <div class="px-6 " x-show.transition.opacity.duration.500ms="step === 2">
                <div class="mb-4 lg:grid lg:grid-cols-3 md:gap-6">
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                {{ __('INFORMATIONNS PERSONNELLES') }}
                            </h3>

                            <p class="mt-1 text-gray-600 text-md dark:text-gray-100">
                                {{ __('Parlez nous un peu de vous. Ces informations apparaîtront sur votre
                                profil
                                public, afin que les acheteurs potentiels
                                puissent mieux vous connaître.') }}
                            </p>
                        </div>
                    </div>

                </div>
                <x-section-border />
                <div class='md:grid md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Nom & Prenom') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Prive*') }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="grid gap-6 md:grid-cols-2 md:mb-2">




                                    <div>
                                        <x-input class="dark:bg-gray-800" id="name" placeholder="{{__('Nom')}}" type="text" wire:model='newFreelance.name' />
                                            <x-input-error for="name" class="mt-2" />

                                    </div>

                                    <div>
                                        <x-input class="dark:bg-gray-800" id="prenom" placeholder="{{__('Prenom')}}" type="text" wire:model='newFreelance.prenom' />
                                        <x-input-error for="prenom" class="mt-2" />

                                    </div>





                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <x-section-border />
                <div class='mt-4 md:grid md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Photo de Profile') }} <span class="text-red-600">*</span>
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Ajoutez une photo de profil de vous-même afin que les clients sachent
                                exactement
                                avec qui ils travailleront.') }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                <div class="gap-6 md:grid">
                                    {{$this->imageForm}}

                                </div>

                            </div>


                        </form>
                    </div>
                </div>

                <x-section-border />
                <div class='mt-4 md:grid md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Description') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __("Partagez un peu votre experience de travail; les projets interessant
                                que vous
                                avez realiser et votre Domaine d'expertise") }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">

                                <div x-data="{ message: '' }">




                                        <x-textarea x-model="message" x-on:keyup="validateTextarea" wire:model="newFreelance.description"/>

                                    <div class="mt-4 text-sm italic text-gray-700 dark:text-gray-100"
                                        x-show="message.length < 150">
                                        La
                                        description doit contenir au moins 150 caractères</div>
                                    <div class="text-sm text-right text-gray-500">
                                        <span x-text="message.length"></span>/6000
                                    </div>



                                </div>





                                <script>
                                    function validateTextarea() {
                                                            const message = this.message;
                                                            if (message.length < 250) {

                                                            } else {

                                                            }
                                                        }
                                </script>







                            </div>


                        </form>
                    </div>
                </div>

                <x-section-border />
                <div class='md:grid md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Langue parler') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Sélectionnez les langues dans lesquelles vous pouvez communiquer et
                                votre
                                niveau
                                de compétence.') }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="">


                                    <div>

                                        <ul class="mb-4">
                                            @forelse($selectedLanguages as $index => $language)
                                            <li class="flex items-center">
                                                <span class="mr-1">{{ $language['name'] }} - {{
                                                    $language['level']
                                                    }}
                                                </span>

                                                <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="removeLanguage({{$index}},'langue')" />


                                            </li>
                                            @empty
                                            <li class="text-sm italic">Choisissez et cliquer sur ajouter
                                            </li>
                                            @endforelse
                                        </ul>

                                    </div>

                                    <p class="mb-2 text-lg font-bold">Ajouter une langue :</p>
                                    <div class="grid gap-4 mb-4 ">


                                        {{$this->langueForm}}

                                        <div>

                                            <x-filament::button type="button" outlined  wire:click='addLanguage()'>
                                                <span wire:loading.remove wire:target='addLanguage'>Ajouter</span><span wire:loading
                                                    wire:target='addLanguage'>Ajout...</span>
                                            </x-filament::button>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="px-6" x-show.transition.opacity.duration.100ms="step === 3">
                <!-- Education -->
                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Education') }} <span class="text-sm italic"> (facultatif)</span>
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Ajoutez tous les détails de formation pertinents qui aideront les
                                clients à
                                mieux
                                vous
                                connaître.') }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div x-data="{selectedDiplome: @entangle('selectedDiplome')}">
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div>
                                    <div x-show="selectedDiplome.length > 0" class="flex flex-col mb-2">

                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                                <div
                                                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                                    <table class="min-w-full divide-y divide-gray-200">
                                                        <thead class="bg-gray-50 dark:bg-gray-900">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                    Diplomee En
                                                                </th>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                    Universite
                                                                </th>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                                    Annee
                                                                </th>
                                                                <th scope="col" class="relative px-6 py-3">


                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">

                                                            @forelse ($selectedDiplome as $index => $item)

                                                            <tr>
                                                                <td
                                                                    class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                    {{$item['diplome']}}
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                    {{$item['universite']}}
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                    {{$item['annee']}}
                                                                </td>

                                                                <td
                                                                    class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">


                                                                    <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="removeLanguage({{$index}},'universite')" />


                                                                </td>
                                                            <tr>
                                                                @empty

                                                                @endforelse




                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid gap-4 mt-4 md:grid-cols-3 md:mb-2">
                                        <x-input id="name" placeholder="{{__('universite')}}" type="text"
                                            wire:model='newDiplome.diplome' />
                                        <x-input id="name" placeholder="{{__('avenue')}}" type="text"
                                            wire:model='newDiplome.universite' />
                                        <div class="grid gap-2 md:grid-cols-2">
                                            <x-select placeholder="Annee" :options=$annee wire:model="newDiplome.annee" />



                                            <div>
                                                <x-filament::button type="button" outlined wire:click='addDiplome()'>
                                                    <span wire:loading.remove wire:target='addDiplome'>Ajouter</span><span wire:loading
                                                        wire:target='addDiplome'>Ajout...</span>
                                                </x-filament::button>

                                            </div>

                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <x-section-border />

                <!-- Certification -->
                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Certification') }}<span class="text-sm italic"> (facultatif)</span>
                            </h3>

                            <p class="text-sm italic text-slate-800">facultatif</p>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Ajoutez tous les détails de certification pertinents qui aideront les
                                clients
                                à
                                mieux
                                vous
                                connaître.') }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div x-data="{selectedCertificat: @entangle('selectedCertificat')}">
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div>
                                    <div x-show="selectedCertificat.length > 0" class="flex flex-col mb-2">

                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                                <div
                                                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                                    <table class="min-w-full divide-y divide-gray-200">
                                                        <thead class="bg-gray-50 dark:bg-gray-800">
                                                            <tr>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                                                    Certificat
                                                                </th>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                                                    Delivrer par
                                                                </th>
                                                                <th scope="col"
                                                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-200">
                                                                    Annee
                                                                </th>
                                                                <th scope="col" class="relative px-6 py-3">


                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">

                                                            @forelse ($selectedCertificat as $index =>
                                                            $item)

                                                            <tr>
                                                                <td
                                                                    class="px-6 py-4 text-sm font-medium text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                    {{$item['certificate']}}
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200 whitespace-nowrap">
                                                                    {{$item['delivrer']}}
                                                                </td>
                                                                <td
                                                                    class="px-6 py-4 text-sm text-gray-500 dark:text-gray-200whitespace-nowrap">
                                                                    {{$item['annee']}}
                                                                </td>

                                                                <td
                                                                    class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">

                                                                    <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                                            wire:click="removeLanguage({{$index}},'certificate')" />


                                                                </td>
                                                            <tr>
                                                                @empty

                                                                @endforelse




                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid gap-4 mt-4 md:grid-cols-3 md:mb-2">


                                        <x-input id="name" placeholder="{{__('Certificat ou Recompense')}}"
                                            type="text" wire:model='newCertificate.certificate' />
                                        <x-input id="name" placeholder="{{__('Certifier Par')}}" type="text"
                                            wire:model='newCertificate.delivrer' />
                                        <div class="grid gap-2 md:grid-cols-2">
                                            <x-select placeholder="Annee" :options=$annee wire:model="newCertificate.annee" />



                                            <div>

                                                <x-filament::button type="button" outlined wire:click='addCertificate()'>
                                                        <span wire:loading.remove wire:target='addCertificate'>Ajouter</span><span wire:loading
                                                            wire:target='addCertificate'>Ajout...</span>
                                            </x-filament::button>


                                            </div>

                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <x-section-border />

                <!-- Personnal website -->

                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Sites Web') }} <span class="text-sm italic"> (facultatif)</span>
                            </h3>



                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __('Incluez un lien vers votre site Web personnel ou votre
                                portfolio avec vos
                                échantillons de
                                travail.') }}
                            </p>
                        </div>


                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="grid md:mb-2">




                                    <x-input  class="!pl-[6.5rem]" label="Website" placeholder="your-website.com" prefix="https://www."  placeholder="{{__('Lien du site web ou portfolio ')}}"
                                        type="text" wire:model='newFreelance.site' />

                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <x-section-border />


            </div>

            <div class="px-6 mx-auto my-auto" x-show.transition.opacity.duration.100ms="step === 4">

                <div class='mb-4 lg:grid lg:mb-0 lg:grid-cols-3 lg:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Comptes Lies') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __("Prendre le temps de vérifier et de lier vos comptes peut
                                améliorer votre
                                crédibilité
                                et
                                nous aider à vous offrir plus
                                d'affaires. Ne vous inquiétez pas, vos informations sont et
                                resteront toujours
                                privées..")
                                }}
                            </p>
                        </div>


                    </div>


                </div>
                <x-section-border />

                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Presence Sociale ') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("") }}
                            </p>
                        </div>


                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="grid grid-cols-2 gap-4">
                            <label for="google">Google</label>
                            @if (!empty($user->google_id))


                            @else

                            <x-filament::button type="button" outlined>
                                connecter
                            </x-filament::button>

                            @endif







                        </div>

                    </div>


                </div>

                <x-section-border />

                <div class='mb-4 lg:grid lg:mb-0 lg:grid-cols-3 lg:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Presence Professionnelle ') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("") }}
                            </p>
                        </div>


                    </div>


                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div>
                            <div
                                class="px-4 py-5 bg-white dark:bg-gray-800 dark:border dark:border-gray-200 rounded-lg  sm:p-6 shadow {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }}">
                                <div class="">


                                    <div>
                                        <p class="mb-2 text-lg font-bold">Commptes lies :</p>
                                        <ul class="mb-4">
                                            @forelse($selectedComptes as $index => $comptes)
                                            <li class="flex items-center">
                                                <span class="mr-1">{{ $comptes['comptes'] }} - {{ $comptes['lien']
                                                    }}
                                                </span>

                                                <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                    wire:click="removeLanguage({{$index}},'skill')" />


                                            </li>
                                            @empty
                                            <li>Cliquer sur ajouter </li>
                                            @endforelse
                                        </ul>
                                    </div>


                                    <div class="grid gap-4 mb-4 ">

                                        {{$this->addCompteForm}}

                                        <div>

                                            <x-filament::button type="button" outlined wire:click='addComptes()'>
                                                <span wire:loading.remove wire:target='addComptes'>Ajouter</span><span wire:loading
                                                    wire:target='addComptes'>Ajout...</span>
                                            </x-filament::button>


                                        </div>
                                    </div>
                                    <div>
                                        @error('skill')
                                        <p>Veuillez rajouter une compences</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>

            <div class="px-6"x-show.transition.opacity.duration.100ms="step === 5">

                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Securite Du Compte') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                {{ __("La confiance et la sécurité sont importantes dans notre
                                communauté. Veuillez
                                vérifier
                                votre adresse e-mail et votre
                                numéro de téléphone afin que nous puissions sécuriser votre
                                compte.") }}
                            </p>
                        </div>


                    </div>


                </div>
                <x-section-border />

                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Email ') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("") }}
                            </p>
                        </div>


                    </div>
                    <div x-data="{open:false}" class="mt-5 md:mt-0 md:col-span-2">

                        <div class="grid gap-4 mb-4 md:grid-cols-2">


                            <x-input wire:model="userAuth.email" />

                            @if (empty($userAuth['email_verified_at']))
                            <div>
                                <x-button spinner="sendMail" label="Verifier" outline gray sm icon="check-circle" />
                            </div>
                            @else
                            <div class="italic text-gray-600">Email verifier</div>
                            @endif






                        </div>
                        {{-- <div x-show="open">
                            <div class="grid gap-4 mb-4 md:grid-cols-3">

                                <label for="google">verification</label>

                                <x-input wire:model.defer="code" />
                                <x-button wire:click="verifyCode()" spinner="verifyCode" label="valider" outline gray sm
                                    icon="check-circle" />
                            </div>
                            <div>
                                @error('codeV')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                                <p class="italic left">un code a 6 chiffres a ete envoyer a votre email</p>
                            </div>


                        </div>--}}



                    </div>


                </div>
                <x-section-border />

                <div class='mb-4 md:grid md:mb-0 md:grid-cols-3 md:gap-6'>
                    <div class="flex justify-between md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Votre Numero ') }}
                            </h3>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("") }}
                            </p>
                        </div>


                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">




                        <div class="grid gap-4 md:grid-cols-2">


                            <x-input wire:model="userAuth.phone" placeholder="" />



                            <div>
                                <x-button wire:click="" spinner="" label="verifier" outline gray sm
                                    icon="check-circle" />
                                <p class="hidden text-sm italic text-red-600">fonctionalites no disponible</p>
                            </div>


                        </div>


                    </div>


                </div>

            </div>
        </div>
        <div class="flex justify-between p-3 mt-auto">
            <div class="w-1/2">
                {{--
                <x-button label="Retour" onclick="scroolTop()" warning x-show="step > 1" @click="step--" />
                --}}
                <button x-show="step > 1" @click="step--"
                    class="middle none center rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    data-ripple-light="true">
                    Retour
                </button>
            </div>
            <div class="w-1/2 text-right">
                {{--
                <x-button label="Continuer" spinner="increaseStep" primary x-show="step < 5"
                    @click="$wire.increaseStep()" />--}}

                <button x-show="step < 5" wire:click="increaseStep()"
                    class="middle none center rounded-lg bg-amber-600 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-orange-500/20 transition-all hover:shadow-lg hover:shadow-orange-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    data-ripple-light="true">
                    Continuer
                </button>

                <button x-show="step == 5" wire:click="register()"
                    class="middle none center rounded-lg bg-amber-600 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-orange-500/20 transition-all hover:shadow-lg hover:shadow-orange-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    data-ripple-light="true">

                    <span wire:loading.remove wire:target='addComptes'>S'inscrire</span>
                    <span wire:loading wire:target='addComptes'>Inscription...</span>

                </button>




                {{--
                <x-button label="Envoyer" spinner="register" wire:click="register()" positive x-show="step == 5" />--}}
            </div>
        </div>

    </div>

    <x-filament-actions::modals />

    <script>
        window.addEventListener('stepChanged', function() {

                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });



    </script>
</div>
