<div x-data="{show:false}" x-on:openpost="show = !show">

    <div class="flex flex-col items-start py-3 space-x-4 lg:py-3">
        <h2 class="mb-4 text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            Détails de la mission
        </h2>

        <div>
            @include('include.bread-cumb-freelance',['mission'=>'mission','missionView'=>\Illuminate\Support\Str::limit($projet->mission_numero,10)])
        </div>
    </div>


    <div class="container py-8 lg:px-2">

        <div class="p-6 mb-3 bg-white rounded-lg shadow-md dark:bg-navy-800">
            <h2 class="mb-4 text-lg font-bold text-gray-800 lg:text-xl">{{$projet->title}}</h2>
            <p class="mb-4 text-gray-600 dark:text-gray-400">Description de la mission :</p>
            <p class="mb-4 leading-loose text-gray-800">
                {{$projet->description}}
            </p>
            <p class="mb-4 text-gray-600 dark:text-gray-400">Détails du projet :</p>
            <ul class="mb-4 list-disc list-inside">
                <li class="text-gray-600 dark:text-gray-400">Durée du de la mission : Du <span
                        class="font-bold text-gray-800">{{$projet->begin_mission->format('d F, Y')}}</span> au
                    <span class="font-bold text-gray-800">
                        {{$projet->end_mission->format('d F, Y')}}
                    </span>

                </li>
                <li class="mt-4 text-gray-600 dark:text-gray-400">Budget : <span
                        class="text-lg font-bold text-gray-800">{{$projet->budget()}}</span>
                </li>

            </ul>
            <p class="mb-4 text-gray-600 dark:text-gray-400">Exigences de la mission :</p>
         <div>

            {!!$projet->exigences!!}
         </div>
            <div class="flex flex-col gap-1 mb-3">

                <p class="mb-1 text-gray-600 dark:text-gray-400">Fichier Inclus :

                </p>

                @if(!empty($projet->files))
                <div>
                    <div class="flex flex-col items-start justify-start py-4">
                        <div class="flex items-start justify-between mt-4 space-x-2">
                            @foreach ($projet->files as $key => $value)
                            @php
                            $extension = pathinfo($value, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ Storage::disk('local')->url($value) }}" download>
                                <img src="{{ Storage::disk('local')->url($value) }}" alt="Nom du produit"
                                    class="w-24 h-full border cursor-pointer xl:w-24 2xl:w-28 hover:opacity-80">
                            </a>

                            @else
                            <a class="px-3 text-gray-800 " href="{{ Storage::disk('local')->url($value) }}"
                                target="_blank">

                                {{ __('Lien vers le document') }}
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                @else
                <p>Pas de fichier inclus</p>

                @endif
            </div>




            <p class="mb-4 text-lg font-extrabold text-gray-800 dark:text-gray-200">Postuler à cette mission</p>
            @if(!$modalEdit)

            <x-filament::button size="lg" wire:click='openModal()'>
                <span>Postuler</span>
            </x-filament::button>



            @else
            <div>

                <x-filament::button outlined size="lg" wire:click='openModalEdit()'>
                    <span>Voir la proposition</span>
                </x-filament::button>
            </div>
            @endif

        </div>



          <div x-cloak x-show="show" x-collapse class="p-8 mt-8 bg-white rounded-lg shadow-md">

            <div class="grid grid-cols-1 gap-4">

                <div>
                    {{$this->propositionForm}}

                </div>



                <div x-data="{isOpen: @entangle('isOpen')}" x-on:openprice="isOpen=true">

                    <div class="flex">
                        <label class="inline-flex items-center">
                            <input type="checkbox" x-model="isOpen" class="w-5 h-5 text-gray-600 rounded-full form-checkbox"
                                name="example" value="">
                            <span class="ml-2 text-sm text-gray-700 md:text-base dark:text-gray-300">Proposer un prix
                            </span>
                        </label>

                    </div>

                    <div x-show="isOpen" x-collapse class="p-4">

                        <div class="flex">
                            <span
                                class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            </span>
                            <input type="number" id="website-admin" wire:model="amount"
                                class="rounded-none rounded-r-lg bg-gray-50 border text-gray-900 focus:ring-amber-500 focus:border-amber-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500"
                                placeholder="Prix">
                        </div>




                    </div>


                </div>



                <div>

                        <div class="flex gap-4">

                        <x-filament::button color='info' size="lg" x-on:click='show=false'>
                            <span>Annuler</span>
                        </x-filament::button>

                            @if($modalEdit)

                            <x-filament::button size="lg" color="success" wire:click='editResponse()'>
                                <span>Modifier</span>
                            </x-filament::button>


                            @else



                            <x-filament::button size="lg" color="success" wire:click='sendResponse()'>
                                <span>Envoyer</span>
                            </x-filament::button>
                            @endif

                        </div>

                </div>
            </div>

          </div>







    </div>




</div>

