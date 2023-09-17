<div>

    <div class="min-h-screen  x-data="{message:@entangle('openMessage')}">


        <div class="lg:px-8 md:px-6 xl:px-20">
            <div class="max-w-3xl mb-8">
                <h2 class="mb-8 text-xl font-semibold tracking-wide uppercase text-amber-600">Détails de la Mission</h2>
            </div>

            <div>
                @include('include.bread-cumb-user',['projet'=>'Mission','projectId'=>$projet->mission_numero])
            </div>

        </div>


        <section class="px-2 py-6 dark:text-gray-400 md:px-6 lg:px-8 xl:px-20">



            <div class="max-w-6xl mx-auto">

                <!-- Titre de la section -->

                <!-- Contenu de la section -->
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <!-- Informations sur la commande -->
                    <div class="grid grid-cols-1 px-6 py-4 lg:grid-cols-2">

                        <p class="mb-4 text-lg text-gray-800 md:mb-2 dark:text-gray-300">Mission : <span>
                                {{$projet->title}}</span> </p>
                        <p class="mb-4 text-base text-gray-600 dark:text-gray-400 md:mb-2">Date de creation :
                            <span>{{$projet->created_at}}</span>
                        </p>
                        <p class="mb-4 text-base font-medium text-gray-600 md:mb-2 dark:text-gray-300">Délai d'echance :
                            Du {{$projet->begin_mission->format('d F, Y')}} au
                            {{$projet->end_mission->format('d F, Y')}}
                        </p>

                        <p class="mb-4 text-base text-gray-600 md:mb-2 dark:text-gray-300">Budjet :
                            <span class="font-bold">{{$projet->budget}}$</span>



                        </p>
                        <p class="mb-4 text-base text-gray-600 md:mb-2 dark:text-gray-300">Proposition :
                            <span class="font-bold">{{$response->budget}}$</span>



                        </p>
                        <p class="mb-4 text-base text-gray-600 md:mb-2 dark:text-gray-300">Paiement :

                            @if (isset($projet->is_paid))

                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Payer</span>

                            @else
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">en
                                Attente</span>
                            @endif


                        </p>
                        @if ($projet->status=="completed")
                        <p class="mb-4 text-base text-gray-600 md:mb-2 dark:text-gray-300">Paiement :



                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Paiement debloquer</span>






                        </p>
                        @endif

                        <p class="mb-4 text-base text-gray-600 md:mb-2 dark:text-gray-300">statut :


                            @if($response->mission->feedbackmission->etat =="En attente de traitement")
                            <span class="text-red-300 px-1.5 py-0.5 rounded-lg ">En attente de traitement</span>
                            @elseif ($response->mission->feedbackmission->etat =="Livré")
                            <span class="text-green-500 px-1.5 py-0.5 rounded-lg ">Livré</span>

                            @elseif ($response->mission->feedbackmission->etat =="En cours de préparation")
                            <span class="text-red-200 px-1.5 py-0.5 rounded-lg ">En cours de préparation</span>
                            @else
                            <span class="bg-red-500 px-1.5 py-0.5 rounded-lg ">En transit</span>
                            @endif




                        </p>
                    </div>

                    <!-- Avancement de la commande -->
                    <div class="px-6 py-4 bprojet-t bprojet-gray-200">
                        <p class="mb-2 text-lg text-gray-800">Avancement</p>
                        <div class="flex items-center">
                            <div class="flex-1">
                                <div class="w-full h-3 bg-gray-300 rounded-lg">
                                    <div class="h-3 bg-green-500 rounded-lg" style="width:{{$projet->progress}}%;"></div>
                                </div>
                            </div>
                            <p class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{$projet->progress}}%</p>
                        </div>
                    </div>

                    <!-- Freelance lié à la commande -->
                    <div class="px-6 py-4 bprojet-t bprojet-gray-300">

                        <h1 class="flex items-start gap-2 text-lg font-bold cursor-pointer lg:text-xl">
                            Freelance lié

                        </h1>
                        <div class="flex items-center mt-4">
                            @if (!empty($response->freelance->user->profile_photo_path))
                            <img class="w-12 h-12 rounded-full"
                                src="{{Storage::disk('local')->url($response->freelance->user->profile_photo_path) }}"
                                alt="">
                            @else
                            <img class="w-12 h-12 rounded-full" src="{{ $response->freelance->user->profile_photo_url }}"
                                alt="">
                            @endif
                            <div class="ml-4">
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{$response->freelance->user->name}}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">
                                    {{$response->freelance->user->email}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mx-4">
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
                            <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                                <div class="p-4 text-sm leading-normal">
                                    @forelse ($projet->rapports as $rappors)
                                    <div>
                                        <div class="text-base text-gray-600 dark:text-gray-300">{!! $rappors->description!!}
                                        </div>
                                        <Span class="mt-4 text-sm text-gray-500">{{$rappors->created_at->formatLocalized('%e
                                            %B')}}</Span>

                                    </div>

                                    @empty

                                    @endforelse

                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="px-6 py-4 bprojet-t bprojet-gray-200">
                        <p class="mb-2 text-lg text-gray-800">Options supplémentaires</p>
                        <div class="flex flex-col gap-2 md:flex-row">

                            <div class="flex gap-2 lg:flex-row">


                                @empty($projet->transaction)
                                <div class="lg:w-full">

                                    <x-filament::button icon="heroicon-m-currency-dollar" tag='a'
                                        href="{{route('missionPaiement',$response->response_numero)}}" size="lg"
                                        type="submit">
                                        Payer
                                    </x-filament::button>
                                </div>
                                @endempty

                                @if($projet->feedbackmission->etat=="Livré")

                                @if(empty($projet->feedbackmission->satisfaction) ||
                                empty($projet->feedbackmission->commentaires))
                                <div class="lg:w-1/2">
                                    <x-filament::button x-on:click="$dispatch('open-modal', { id: 'evaluer' })" icon=""
                                        size="lg" color="success">
                                        Evaluer
                                    </x-filament::button>
                                </div>
                                @endif
                                @endif

                                @if(($projet->feedbackmission->etat =="Livré") && !$projet->isFinish())
                                <div class="w-full">
                                   {{$this->accepterAction}}
                                </div>

                                @endif

                                <div class="lg:w-1/2">

                                    <x-filament::button x-on:click="$dispatch('open-modal', { id: 'contacter' })"
                                        color="success">
                                        Contacter
                                    </x-filament::button>
                                </div>
                                @if(!($projet->feedbackmission->etat=="Livré"))
                                <div class="lg:w-full">
                                    <x-filament::button wire:click='openModal()' icon="" tag='a' href="" size="lg"
                                        color="danger">
                                        Annuler
                                    </x-filament::button>
                                </div>
                                @endif

                            </div>



                        </div>

                    </div>

                    <div class="mx-4">
                        <div x-data="{open:false}" class="relative mb-3">
                            <h6 class="mb-0">
                                <button @click="open=!open"
                                    class="relative flex items-center w-full p-4 text-lg font-semibold text-left text-gray-600 transition-all ease-in border-b border-solid cursor-pointer border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                                    data-collapse-target="animated-collapse-1">
                                    <span>Transaction lier</span>
                                    <i :class="open? 'rotate-180 transition-transform':''"
                                        class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                                </button>
                            </h6>
                            <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                                <div class="p-4 text-sm leading-normal">
                                    @if (!empty($projet->transaction))


                                    <div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Numéro de transaction :
                                            #{{$projet->transaction->transaction_numero}}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Méthode de paiement :

                                            @if(isset($projet->transaction->payment_method['brand']) )

                                            @switch($projet->transaction->payment_method['brand'])
                                            @case("visa")
                                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 256 83">
                                                <defs>
                                                    <linearGradient id="logosVisa0" x1="45.974%" x2="54.877%" y1="-2.006%"
                                                        y2="100%">
                                                        <stop offset="0%" stop-color="#222357" />
                                                        <stop offset="100%" stop-color="#254AA5" />
                                                    </linearGradient>
                                                </defs>
                                                <path fill="url(#logosVisa0)"
                                                    d="M132.397 56.24c-.146-11.516 10.263-17.942 18.104-21.763c8.056-3.92 10.762-6.434 10.73-9.94c-.06-5.365-6.426-7.733-12.383-7.825c-10.393-.161-16.436 2.806-21.24 5.05l-3.744-17.519c4.82-2.221 13.745-4.158 23-4.243c21.725 0 35.938 10.724 36.015 27.351c.085 21.102-29.188 22.27-28.988 31.702c.069 2.86 2.798 5.912 8.778 6.688c2.96.392 11.131.692 20.395-3.574l3.636 16.95c-4.982 1.814-11.385 3.551-19.357 3.551c-20.448 0-34.83-10.87-34.946-26.428m89.241 24.968c-3.967 0-7.31-2.314-8.802-5.865L181.803 1.245h21.709l4.32 11.939h26.528l2.506-11.939H256l-16.697 79.963h-17.665m3.037-21.601l6.265-30.027h-17.158l10.893 30.027m-118.599 21.6L88.964 1.246h20.687l17.104 79.963h-20.679m-30.603 0L53.941 26.782l-8.71 46.277c-1.022 5.166-5.058 8.149-9.54 8.149H.493L0 78.886c7.226-1.568 15.436-4.097 20.41-6.803c3.044-1.653 3.912-3.098 4.912-7.026L41.819 1.245H63.68l33.516 79.963H75.473"
                                                    transform="matrix(1 0 0 -1 0 82.668)" />
                                            </svg>

                                            @break
                                            @case('mastercard')
                                            <svg class="w-7 h-7" aria-hidden="true" enable-background="new 0 0 780 500"
                                                viewBox="0 0 780 500" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m449.01 250c0 99.143-80.371 179.5-179.51 179.5s-179.5-80.361-179.5-179.5c0-99.133 80.362-179.5 179.5-179.5 99.137 0 179.51 80.371 179.51 179.5"
                                                    fill="#d9222a" />
                                                <path
                                                    d="m510.49 70.496c-46.379 0-88.643 17.596-120.5 46.467-6.49 5.889-12.548 12.237-18.125 18.996h36.267c4.965 6.037 9.536 12.387 13.685 19.012h-63.635c-3.827 6.122-7.281 12.469-10.342 19.008h84.313c2.894 6.185 5.431 12.53 7.601 19.004h-99.513c-2.09 6.234-3.832 12.58-5.217 19.008h109.94c2.689 12.49 4.045 25.231 4.042 38.008 0 19.935-3.254 39.112-9.254 57.021h-99.513c2.164 6.477 4.7 12.824 7.596 19.008h84.316c-3.063 6.541-6.519 12.889-10.347 19.013h-63.625c4.147 6.62 8.719 12.966 13.685 18.996h36.259c-5.57 6.772-11.63 13.127-18.13 19.013 31.857 28.866 74.117 46.454 120.5 46.454 99.139 0 179.51-80.361 179.51-179.5 0-99.129-80.371-179.5-179.51-179.5"
                                                    fill="#ee9f2d" />
                                                <path
                                                    d="m666.07 350.06c0-3.199 2.592-5.801 5.796-5.801s5.796 2.602 5.796 5.801-2.592 5.801-5.796 5.801-5.796-2.602-5.796-5.801zm5.796 4.408c2.434-.001 4.407-1.974 4.408-4.408 0-2.432-1.971-4.402-4.402-4.404h-.006c-2.429-.003-4.4 1.963-4.404 4.391v.014c-.002 2.433 1.968 4.406 4.4 4.408.001-.001.003-.001.004-.001zm-.783-1.86h-1.187v-5.096h2.149c.45 0 .908 0 1.305.254.413.279.646.771.646 1.279 0 .571-.338 1.104-.884 1.312l.938 2.25h-1.315l-.779-2.017h-.871zm0-2.89h.658c.246 0 .505.021.726-.1.195-.125.296-.359.296-.584-.005-.209-.112-.402-.288-.518-.207-.129-.536-.101-.758-.101h-.634zm-443.5-80.063c-2.046-.238-2.945-.301-4.35-.301-11.046 0-16.638 3.787-16.638 11.268 0 4.611 2.729 7.545 6.987 7.545 7.939 0 13.659-7.559 14.001-18.512zm14.171 32.996h-16.146l.371-7.676c-4.926 6.065-11.496 8.949-20.426 8.949-10.563 0-17.804-8.25-17.804-20.229 0-18.024 12.596-28.541 34.217-28.541 2.208 0 5.042.199 7.941.57.604-2.441.763-3.488.763-4.801 0-4.908-3.396-6.737-12.5-6.737-9.533-.108-17.396 2.271-20.625 3.333.204-1.229 2.7-16.659 2.7-16.659 9.712-2.846 16.116-3.917 23.325-3.917 16.732 0 25.596 7.513 25.579 21.712.033 3.805-.597 8.5-1.579 14.671-1.691 10.734-5.32 33.721-5.816 39.325zm-62.158 0h-19.487l11.162-69.997-24.925 69.997h-13.279l-1.642-69.597-11.733 69.597h-18.242l15.237-91.056h28.021l1.7 50.968 17.092-50.968h31.167zm354.97-32.996c-2.037-.238-2.941-.301-4.342-.301-11.041 0-16.634 3.787-16.634 11.268 0 4.611 2.726 7.545 6.983 7.545 7.94 0 13.664-7.559 13.993-18.512zm14.184 32.996h-16.146l.366-7.676c-4.926 6.065-11.5 8.949-20.422 8.949-10.565 0-17.8-8.25-17.8-20.229 0-18.024 12.588-28.541 34.213-28.541 2.208 0 5.037.199 7.934.57.604-2.441.763-3.488.763-4.801 0-4.908-3.392-6.737-12.496-6.737-9.533-.108-17.387 2.271-20.629 3.333.204-1.229 2.709-16.659 2.709-16.659 9.712-2.846 16.112-3.917 23.313-3.917 16.74 0 25.604 7.513 25.587 21.712.032 3.805-.597 8.5-1.579 14.671-1.684 10.734-5.321 33.721-5.813 39.325zm-220.39-1.125c-5.333 1.679-9.491 2.398-14 2.398-9.962 0-15.399-5.725-15.399-16.267-.142-3.271 1.433-11.88 2.671-19.737 1.125-6.917 8.449-50.529 8.449-50.529h19.371l-2.263 11.208h11.699l-2.642 17.796h-11.742c-2.25 14.083-5.454 31.625-5.491 33.95 0 3.816 2.037 5.483 6.671 5.483 2.221 0 3.94-.227 5.254-.7zm59.392-.6c-6.654 2.034-13.075 3.017-19.879 3-21.684-.021-32.987-11.346-32.987-33.032 0-25.313 14.38-43.947 33.899-43.947 15.971 0 26.171 10.433 26.171 26.796 0 5.429-.7 10.729-2.388 18.212h-38.574c-1.305 10.741 5.57 15.217 16.837 15.217 6.935 0 13.188-1.429 20.142-4.663zm-10.888-43.9c.107-1.543 2.055-13.217-9.013-13.217-6.171 0-10.583 4.704-12.38 13.217zm-123.42-5.017c0 9.367 4.542 15.826 14.842 20.676 7.892 3.709 9.112 4.81 9.112 8.17 0 4.617-3.479 6.701-11.191 6.701-5.813 0-11.221-.908-17.458-2.922 0 0-2.563 16.321-2.68 17.102 4.43.967 8.38 1.861 20.279 2.19 20.563 0 30.059-7.829 30.059-24.75 0-10.175-3.976-16.146-13.737-20.634-8.171-3.75-9.108-4.587-9.108-8.045 0-4.004 3.237-6.046 9.537-6.046 3.825 0 9.05.408 14 1.112l2.775-17.175c-5.046-.8-12.696-1.442-17.15-1.442-21.801.001-29.347 11.388-29.28 25.063m229.09-23.116c5.412 0 10.458 1.421 17.412 4.921l3.188-19.763c-2.854-1.121-12.904-7.7-21.417-7.7-13.041 0-24.065 6.471-31.82 17.15-11.309-3.746-15.958 3.825-21.657 11.367l-5.063 1.179c.383-2.483.729-4.95.612-7.446h-17.896c-2.445 22.917-6.778 46.128-10.171 69.075l-.884 4.976h19.496c3.254-21.143 5.037-34.68 6.121-43.842l7.341-4.084c1.097-4.078 4.529-5.458 11.417-5.291-.926 5.008-1.389 10.091-1.383 15.184 0 24.225 13.07 39.308 34.05 39.308 5.404 0 10.041-.712 17.221-2.658l3.43-20.759c-6.458 3.181-11.759 4.677-16.559 4.677-11.329 0-18.184-8.363-18.184-22.185 0-20.051 10.196-34.109 24.746-34.109" />
                                                <path
                                                    d="m185.21 297.24h-19.491l11.171-69.988-24.926 69.988h-13.283l-1.642-69.588-11.733 69.588h-18.241l15.237-91.042h28.021l.788 56.362 18.904-56.362h30.267z"
                                                    fill="#fff" />
                                                <path
                                                    d="m647.52 211.6-4.321 26.309c-5.329-7.013-11.054-12.088-18.612-12.088-9.833 0-18.783 7.455-24.642 18.425-8.158-1.692-16.597-4.563-16.597-4.563l-.004.067c.658-6.134.921-9.875.862-11.146h-17.9c-2.438 22.917-6.771 46.128-10.157 69.075l-.893 4.976h19.492c2.633-17.096 4.648-31.291 6.133-42.551 6.658-6.016 9.992-11.266 16.721-10.916-2.979 7.205-4.725 15.503-4.725 24.017 0 18.513 9.366 30.725 23.533 30.725 7.142 0 12.621-2.462 17.967-8.171l-.913 6.884h18.435l14.842-91.042zm-24.371 73.941c-6.634 0-9.983-4.908-9.983-14.596 0-14.555 6.271-24.875 15.112-24.875 6.695 0 10.32 5.104 10.32 14.509.001 14.679-6.37 24.962-15.449 24.962z" />
                                                <path
                                                    d="m233.19 264.26c-2.042-.236-2.946-.299-4.346-.299-11.046 0-16.634 3.787-16.634 11.266 0 4.604 2.729 7.547 6.979 7.547 7.947-.001 13.668-7.559 14.001-18.514zm14.178 32.984h-16.146l.367-7.663c-4.921 6.054-11.5 8.95-20.421 8.95-10.567 0-17.805-8.25-17.805-20.229 0-18.032 12.592-28.542 34.217-28.542 2.208 0 5.042.2 7.938.571.604-2.441.763-3.487.763-4.808 0-4.909-3.392-6.729-12.496-6.729-9.537-.108-17.396 2.271-20.629 3.321.204-1.225 2.7-16.637 2.7-16.637 9.708-2.858 16.12-3.929 23.32-3.929 16.737 0 25.604 7.517 25.588 21.704.029 3.821-.604 8.513-1.584 14.675-1.687 10.724-5.319 33.724-5.812 39.316zm261.38-88.592-3.191 19.767c-6.95-3.496-12-4.92-17.407-4.92-14.551 0-24.75 14.058-24.75 34.106 0 13.821 6.857 22.181 18.184 22.181 4.8 0 10.096-1.492 16.554-4.675l-3.421 20.75c-7.184 1.957-11.816 2.67-17.225 2.67-20.977 0-34.051-15.084-34.051-39.309 0-32.55 18.059-55.3 43.888-55.3 8.507.001 18.561 3.609 21.419 4.73m31.443 55.608c-2.041-.236-2.941-.299-4.347-.299-11.041 0-16.633 3.787-16.633 11.266 0 4.604 2.729 7.547 6.983 7.547 7.938-.001 13.663-7.559 13.997-18.514zm14.178 32.984h-16.15l.371-7.663c-4.925 6.054-11.5 8.95-20.421 8.95-10.563 0-17.804-8.25-17.804-20.229 0-18.032 12.596-28.542 34.212-28.542 2.213 0 5.042.2 7.941.571.601-2.441.763-3.487.763-4.808 0-4.909-3.393-6.729-12.495-6.729-9.533-.108-17.396 2.271-20.63 3.321.204-1.225 2.704-16.637 2.704-16.637 9.709-2.858 16.116-3.929 23.316-3.929 16.741 0 25.604 7.517 25.583 21.704.033 3.821-.596 8.513-1.579 14.675-1.682 10.724-5.323 33.724-5.811 39.316zm-220.39-1.121c-5.338 1.679-9.496 2.408-14 2.408-9.962 0-15.399-5.726-15.399-16.268-.138-3.279 1.438-11.88 2.675-19.736 1.12-6.926 8.445-50.534 8.445-50.534h19.368l-2.26 11.212h9.941l-2.646 17.788h-9.975c-2.25 14.092-5.463 31.62-5.496 33.95 0 3.83 2.041 5.482 6.671 5.482 2.221 0 3.938-.216 5.254-.691zm59.391-.592c-6.65 2.033-13.079 3.012-19.879 3-21.685-.021-32.987-11.346-32.987-33.033 0-25.321 14.379-43.95 33.899-43.95 15.971 0 26.171 10.429 26.171 26.8 0 5.434-.7 10.733-2.384 18.212h-38.574c-1.306 10.741 5.569 15.222 16.837 15.222 6.93 0 13.188-1.435 20.138-4.677zm-10.891-43.912c.116-1.538 2.06-13.217-9.013-13.217-6.167 0-10.579 4.717-12.375 13.217zm-123.42-5.005c0 9.367 4.542 15.818 14.842 20.675 7.892 3.709 9.112 4.812 9.112 8.172 0 4.616-3.483 6.699-11.188 6.699-5.816 0-11.225-.908-17.467-2.921 0 0-2.554 16.321-2.671 17.101 4.421.967 8.375 1.85 20.275 2.191 20.566 0 30.059-7.829 30.059-24.746 0-10.18-3.971-16.15-13.737-20.637-8.167-3.759-9.113-4.584-9.113-8.046 0-4 3.246-6.059 9.542-6.059 3.821 0 9.046.421 14.004 1.125l2.771-17.179c-5.042-.8-12.692-1.441-17.146-1.441-21.804 0-29.346 11.379-29.283 25.066m398.45 50.63h-18.438l.917-6.893c-5.347 5.717-10.825 8.18-17.968 8.18-14.166 0-23.528-12.213-23.528-30.726 0-24.63 14.521-45.392 31.708-45.392 7.559 0 13.279 3.087 18.604 10.096l4.325-26.308h19.221zm-28.746-17.109c9.075 0 15.45-10.283 15.45-24.953 0-9.405-3.629-14.509-10.325-14.509-8.837 0-15.115 10.315-15.115 24.875-.001 9.686 3.357 14.587 9.99 14.587zm-56.842-56.929c-2.441 22.917-6.773 46.13-10.162 69.063l-.892 4.976h19.491c6.972-45.275 8.658-54.117 19.588-53.009 1.742-9.267 4.982-17.383 7.399-21.479-8.163-1.7-12.721 2.913-18.688 11.675.471-3.788 1.333-7.467 1.162-11.225zm-160.42 0c-2.446 22.917-6.779 46.13-10.167 69.063l-.888 4.976h19.5c6.963-45.275 8.646-54.117 19.57-53.009 1.75-9.267 4.991-17.383 7.399-21.479-8.154-1.7-12.717 2.913-18.679 11.675.471-3.788 1.324-7.467 1.162-11.225zm254.57 68.241c-.004-3.199 2.586-5.795 5.784-5.799h.012c3.197-.004 5.793 2.586 5.796 5.783v.016c-.001 3.201-2.595 5.795-5.796 5.797-3.201-.002-5.795-2.596-5.796-5.797zm5.796 4.405c2.431.002 4.402-1.969 4.403-4.399v-.004c.003-2.433-1.968-4.406-4.399-4.408h-.004c-2.435.001-4.407 1.974-4.408 4.408.002 2.432 1.975 4.403 4.408 4.403zm-.784-1.871h-1.188v-5.082h2.153c.446 0 .909.009 1.296.254.417.283.654.767.654 1.274 0 .575-.337 1.112-.888 1.317l.941 2.236h-1.32l-.779-2.009h-.87zm0-2.879h.653c.246 0 .513.019.729-.1.196-.125.296-.361.296-.588-.009-.21-.114-.404-.287-.523-.204-.117-.542-.084-.763-.084h-.629z"
                                                    fill="#fff" />
                                            </svg>

                                            @break
                                            @default

                                            @endswitch






                                            <span>••• {{$projet->transaction->payment_method['last4']}}</span>
                                            @endif
                                        </p>

                                        <div class="flex gap-4 mt-4">
                                            <div>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">Montant payé :
                                                    {{$projet->transaction->amount}}
                                                </p>

                                            </div>


                                            <div>

                                                <x-filament::button  tag='a'
                                                    href="{{route('transactionOneUser',[$projet->transaction->transaction_numero])}}" outlined>
                                                    voir
                                                </x-filament::button>

                                            </div>
                                        </div>
                                    </div>

                                    @else
                                    <div>
                                        <p class="text-base text-gray-600 dark:text-gray-300">Numéro de transaction :
                                            Pas de transaction en cours</p>




                                    </div>

                                    @endif

                                </div>
                            </div>
                        </div>


                    </div>


                </div>


                <x-filament::modal :close-by-clicking-away="false" slide-over id="evaluer">

                    <x-slot name="heading">
                        Evaluation
                    </x-slot>

                    <div class="flex flex-col">
                        <div>

                            <div class="flex items-center">
                                <p class="mr-2">Notez votre satisfaction :</p>
                                <div wire:ignore class="flex justify-center">
                                    <div class="flex items-center ">
                                        <input value="0" type="" class="hidden" id="rating" name="rating">
                                        <label for="star1" class="text-gray-400 cursor-pointer" onclick="updateRating(1)">
                                            <svg id="star1" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                            </svg>
                                        </label>
                                        <label for="star2" class="text-gray-400 cursor-pointer" onclick="updateRating(2)">
                                            <svg id="star2" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                            </svg>
                                        </label>
                                        <label for="star3" class="text-gray-400 cursor-pointer" onclick="updateRating(3)">
                                            <svg id="star3" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                            </svg>
                                        </label>
                                        <label for="star4" class="text-gray-400 cursor-pointer" onclick="updateRating(4)">
                                            <svg id="star4" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                            </svg>
                                        </label>
                                        <label for="star5" class="text-gray-400 cursor-pointer" onclick="updateRating(5)">
                                            <svg id="star5" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                            </svg>
                                        </label>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8">
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                message</label>
                            <textarea id="message" rows="4" wire:model='feedback.description'
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write your thoughts here..."></textarea>
                        </div>

                        <x-slot name="footerActions">


                            <x-filament::button outlined wire:click='sendFeedback' size="lg" color="success">
                                Envoyer
                            </x-filament::button>

                            <x-filament::button outlined x-on:click='close' icon="" size="lg" color="danger">
                                Fermer
                            </x-filament::button>



                        </x-slot>


                    </div>
                </x-filament::modal>

            <x-filament::modal slide-over id="contacter">

                <x-slot name="heading">
                    Contacter
                </x-slot>



                <div>
                    <div>
                        <div class="flex flex-col items-start justify-between mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-lg font-semibold">{{$response->freelance->user->name}}</span>
                                <span
                                    class="{{$response->freelance->user->is_online ?'bg-green-400':'bg-gray-400'}}   rounded-full h-2 w-2"></span>
                                <span class="text-xs text-gray-500">{{$response->freelance->user->is_online ? 'En ligne':'pas
                                    disponible'}}</span>
                            </div>
                            <span class="text-xs text-gray-500">Temps de réponse : 1 heures</span>
                        </div>
                    </div>
                    <div>
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="comment" class="sr-only">Votre Message</label>
                                <textarea id="comment" rows="4"
                                    class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Ecrire un message..." required></textarea>
                            </div>
                            <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                    Envoyer
                                </button>
                                <div class="flex pl-0 space-x-1 sm:pl-2">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <x-slot name="footerActions">


                        <x-filament::button outlined tag='a' href="" size="lg" color="success">
                            Voir  les messages
                        </x-filament::button>

                        <x-filament::button outlined x-on:click='close' icon="" size="lg" color="danger">
                            Fermer
                        </x-filament::button>



                    </x-slot>
            </x-filament::modal>

            </div>


        </section>







            <script>
                function updateRating(rating) {
                  document.getElementById('rating').value = rating;

                  for (let i = 1; i <= 5; i++) {
                    const star = document.getElementById('star' + i);
                    if (i <= rating) {
                      star.classList.add('text-yellow-400');
                    } else {
                      star.classList.remove('text-yellow-400');
                    }
                  }
                  @this.satisfaction=rating;
                }
            </script>

<x-filament-actions::modals />


    </div>
</div>
