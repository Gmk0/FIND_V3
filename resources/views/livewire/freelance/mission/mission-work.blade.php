<div>

    <div class="flex flex-col items-start py-3 space-x-4 lg:py-3">
        <h2 class="mb-4 text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
            Details de la mission
        </h2>

        <div>
            @include('include.bread-cumb-freelance',['missionAccepter'=>'mission','missionView'=>\Illuminate\Support\Str::limit($projet->mission_numero,10
            )])
        </div>
    </div>


    <section class="py-4 xl:px-12">

        <div class="md:max-w-8xl">



            <!-- Contenu de la section -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                <!-- Informations sur la commande -->
                <div class="grid grid-cols-1 gap-3 px-6 py-4 md:grid-cols-2 ">
                    <p class="mb-2 text-lg text-gray-800 font-inter dark:text-gray-200">Mission #{{$projet->mission_numero}}
                    </p>
                    <p class="mb-2 text-lg text-gray-800 dark:text-gray-200">Titre : {{$projet->title}}</p>
                    <p class="text-base text-gray-600 dark:text-gray-300">Date de debut : {{$projet->begin_mission->format('d F, Y')}}</p>
                    <p class="text-base text-gray-600 dark:text-gray-300">Délai de livraison :
                        {{$projet->end_mission->format('d F, Y')}} </p>

                    <p class="text-base text-gray-600 dark:text-gray-300">Paiement :


                        @if (isset($projet->is_paid))
                        <span class="font-bold text-green-600">Payer</span>
                        @else
                        <span class="font-bold text-yellow-200">En attente</span>
                        @endif
                    </p>

                    <p class="text-base  text-gray-600 dark:text-gray-300">Versement :


                        @if ($projet->status =='completed')
                        <span class="font-bold text-green-600">Paiement verser</span>
                        @else
                        <span class="font-bold text-yellow-200">En attente</span>
                        @endif
                    </p>

                    <p class="text-base text-gray-600 dark:text-gray-300">statut :



                        @if($projet->feedbackmission->etat =="En attente de traitement")
                        <span class="text-red-300 px-1.5 py-0.5 rounded-lg ">En attente de traitement</span>
                        @elseif ($projet->feedbackmission->etat =="Livré")
                        <span class="text-green-500 px-1.5 py-0.5 rounded-lg ">Livré</span>

                        @elseif ($projet->feedbackmission->etat =="En cours de préparation")
                        <span class="text-red-200 px-1.5 py-0.5 rounded-lg ">En cours de préparation</span>
                        @else
                        <span class="bg-red-500 px-1.5 py-0.5 rounded-lg ">En transit</span>
                        @endif
                    </p>

                    <p class="text-base text-gray-600 dark:text-gray-300">Progression : <span
                            class="font-bold text-green-600">{{$projet->progress}} %</span>
                    </p>


                </div>

                <!-- Freelance lié à la commande -->
                <div class="px-6 py-4 border-t border-gray-200">
                    <p class="mb-2 text-lg text-gray-600 dark:text-gray-400">Client </p>
                    <div class="flex items-center">
                        @component("components.user-photo" ,['user'=>$projet->user,'taille'=>12])
                        @endcomponent
                        <div class="ml-4">
                            <p class="text-sm text-gray-700 dark:text-gray-300">{{$projet->user->name}}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                {{$projet->user->email}}</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200">
                    <p class="mb-2 text-lg text-gray-600 dark:text-gray-400">Description </p>
                    <div class="flex items-center">

                        <p class="text-sm text-gray-700 dark:text-gray-300">{{$projet->description}}</p>


                    </div>
                </div>

                <div class="px-6 py-4 border-t border-gray-200">
                    <p class="mb-2 text-lg dark:text-gray-300 text-gray-700">Fichier </p>
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
                                <a class="px-3 text-gray-800" href="{{ Storage::disk('local')->url($value) }}"
                                    target="_blank">
                                    {{ $value }}
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
                <div x-data="{open:false}" class="px-6 py-4 border-t border-gray-200">

                    <h2 class="mb-4 text-lg font-semibold">Gestion de projet</h2>


                    @if($livre)

                    <div>
                        <h1 class="mb-4 text-dark-800">Vous avez deja livrer(realiser) la commande</h1>

                        <div class="mb-4">
                            <h1 class="text-dark-800">Le feedback Projet du client</h1>
                        </div>

                        <div class="p-4 mb-4 bg-gray-100 rounded-lg dark:bg-gray-600">

                            <p class="text-sm text-gray-700 md:text-base dark:text-gray-300">
                                {{$projet->feedbackmission->commentaires?
                                $projet->feedbackmission->commentaires:'pas de commentaire'}}</p>

                            <div class="flex items-center my-4">
                                <svg class="w-4 h-4 mr-1 text-yellow-500 fill-current"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M10 14.155L4.284 17.84l.828-5.076L.898 7.865l5.059-.736L10 2l2.043 5.129 5.059.736-3.215 3.9.828 5.076z" />
                                </svg>

                                <span
                                    class="text-sm font-semibold text-gray-700 dark:text-gray-100">({{$projet->feedbackmission->satisfaction?$projet->feedbackmission->satisfaction:0}})
                                </span>
                            </div>
                            <div class="flex items-center gap-3 mb-4">

                                @component("components.user-photo" ,['user'=>$projet->user])
                                @endcomponent

                                <p class="font-bold text-gray-800">{{$projet->user->name}}</p>
                            </div>
                          <div class="flex gap-4">

                                <div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" wire:model.live="publier" x-on:change='$wire.toogle()'>
                                        <div
                                            class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                        <span class="ml-3 text-sm font-medium text-gray-400 dark:text-gray-500">Publier</span>
                                    </label>
                                </div>





                                <x-filament::button wire:click='modifier()'>
                                    <span wire:loading.remove wire:target='modifier'>Modifier</span>

                                </x-filament::button>


                                {{--
                                <x-toggle wire:model="publier" x-on:change='$wire.toogle()' label="Publier" />--}}
                            </div>
                        </div>


                    </div>


                    @else

                    <div class="flex flex-col ">

                        {{$this->gestionForm}}

                        <div class="flex items-center justify-center mt-4">

                            <x-filament::button size="lg" wire:click='modLivre()'>
                                <span wire:loading.remove wire:target='modLivre'>Soumettre</span>
                                <span wire:loading wire:target='modLivre'>Soumission</span>
                            </x-filament::button>


                        </div>


                    </div>


                    @endif



                </div>

                <!-- Avancement de la commande -->


                <div class="w-full p-4 bg-white border-t border-gray-200 rounded-lg shadow-md">


                    @if(!$livre)

                    <div class="flex flex-col p-4 space-y-4">
                        <label class="text-sm font-semibold" for="progress">Rapport d'avancement</label>
                            {{$this->rapportForm}}

                            <div class="flex items-center justify-center mt-4">

                                <button wire:click="SendRapport()" class="self-end px-4 py-2 mb-3 text-white bg-blue-500 rounded-md">
                                    <span wire:target='SendRapport' wire:loading.remove>Soumettre</span> <span wire:loading
                                        wire:target='SendRapport'>Soumission...</span></button>
                            </div>

                    </div>

                    @endif




                    <div>
                        <div x-data="{open:false}" class="relative mb-3">
                            <h6 class="mb-0">
                                <button @click="open=!open"
                                    class="relative flex items-center w-full p-4 text-base font-semibold text-left text-gray-600 transition-all ease-in border-b border-solid cursor-pointer border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                                    data-collapse-target="animated-collapse-1">
                                    <span>Rapport Envoyer</span>
                                    <i :class="open? 'rotate-180 transition-transform':''"
                                        class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                                </button>
                            </h6>
                            <div x-show="open" x-collapse
                                class="overflow-hidden transition-all duration-300 ease-in-out ">
                                <div class="p-4 text-sm leading-normal">
                                    @forelse ($projet->rapports as $rappors)
                                 <div x-data="{show: false}" @mouseover="show = true" @mouseleave="show = false" class="p-3 border-b border-gray-400">
                                        <div class="mb-3 text-base text-gray-600 cursor-pointer dark:text-gray-300">{!! $rappors->description !!}
                                        </div>
                                        <Span class="mt-4 text-sm text-gray-500">{{$rappors->created_at->formatLocalized('%e
                                            %B')}}</Span>

                                        <div x-collapse x-show="show" class="p-2">

                                            <x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer"
                                                wire:click="effacerRapport({{$rappors->id}})" />
                                        </div>



                                    </div>
                                    @empty

                                    @endforelse

                                </div>
                            </div>
                        </div>


                    </div>



                </div>


            </div>
        </div>
    </section>

</div>
