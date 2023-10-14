

<div>
    <div class="min-h-screen py-2 bg-gray-50 md:px-4 dark:bg-gray-900"
        x-data="{ isOpen:false,contactMe:false,isLoading: true,showFilters: false,showSearch: false }"
        x-init="setTimeout(() => { isLoading = false }, 3000)">

        <div class="px-2">
            @include('include.bread-cumb',['category'=>'cagegory','categoryName'=>
            \Illuminate\Support\Str::limit($service->category->name,
            10),'ServiceId'=>$service->service_numero])
        </div>
        <div>
            <x-button flat  href="{{ url()->previous()}}">Retour</x-button>
        </div>

        <div>
            <div x-show="isLoading">

                <div class="flex flex-row flex-1 h-screen p-8 overflow-y-hidden">
                    <div
                        class="order-first hidden w-full h-screen p-2 px-2 mx-2 overflow-y-auto bg-gray-300 rounded-md dark:bg-gray-600 md:w-2/3 animate-pulse custom-scrollbar md:flex ">
                        <div>

                        </div>
                    </div>
                    <div
                        class="flex-col flex-1 h-screen p-4 mx-4 mb-4 overflow-y-auto text-xs bg-gray-200 border-r border-indigo-300 rounded-md dark:bg-gray-600 md:flex md:order-2 md:mb-0 md:w-1/3 animate-pulse custom-scrollbar">


                    </div>
                </div>
            </div>

        </div>

        <div x-show="!isLoading" x-cloak class="px-4 py-4 mx-auto ">


            <div class="flex flex-col md:flex-row md:space-x-4">

                @include('livewire.web.category.header-card')


                <div x-data="{step:1, showExemple:false}" class="w-full bg-white md:w-2/3">
                    <div class="p-4 dark:bg-gray-800">
                        <div class="flex flex-col mb-4">

                            <div>
                                <p class="mb-4 text-lg font-bold text-gray-700 md:text-xl dark:text-gray-200">
                                    {{$service->title}}
                                </p>

                            </div>


                        <div class="flex gap-4 mt-2">
                            @component("components.user-photo" ,['user'=>$service->freelance->user,'taille'=>18])
                            @endcomponent
                            <div class="flex flex-col gap-3 my-auto">
                                <a href="{{route('profileFreelance',$service->freelance->identifiant)}}" class="text-base font-medium text-gray-500 underline">{{$service->freelance->user->name}}</a>
                                <div class="flex flex-row gap-2">

                                    <span class="text-base font-medium">Niveau {{$service->freelance->level}}
                                        @if($commandeFinis)
                                        ({{$commandeFinis}})
                                        @endif
                                    </span>
                                    @if($commandeEncours)
                                    <span class="text-base font-medium">{{$commandeEncours}} commande en cours</span>
                                    @endif
                                </div>

                            </div>

                        </div>



                        </div>









                        <div class="">
                            <div x-init="$nextTick(()=>$el._x_swiper = new Swiper($el,{ navigation: {prevEl: '.swiper-button-prev', nextEl: '.swiper-button-next'}, pagination: { el: '.swiper-pagination',type: 'progressbar'},lazy: true,}))"
                                class="w-10/12 rounded-lg swiper">
                                <div class="swiper-wrapper">

                                    @foreach($service->files as $key=> $image)


                                    <div class="p-2 swiper-slide">


                                        <a class="example-image-link" href="{{Storage::disk('local')->url($image) }}" data-lightbox="{{$service->id}}" data-title="Presentation.">
                                           <img class="object-fill rounded-md h-10/12 swiper-lazy" src="{{Storage::disk('local')->url($image) }}" alt="" />
                                        </a>



                                        <div class="hidden swiper-lazy-preloader"></div>
                                    </div>
                                    @endforeach


                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-next btn2"></div>
                                <div class="swiper-button-prev btn2"></div>
                            </div>
                        </div>



                        <div class="hidden">
                            <p class="mt-4 text-lg font-bold text-gray-800 md:text-2xl dark:text-gray-200">
                                {{$service->title}}</p>

                        </div>







                        <div class="w-full tabs">
                            <a @click="step = 1" :class="step == 1 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered">info</a>
                            <a @click="step = 2" :class="step == 2 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered ">Example </a>




                            <a @click="step = 4" :class="step == 4 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered">Commentaires</a>
                        </div>







                        <div x-show.transition="step==1" class="py-5 min-h-64">
                            <div class="mb-4 text-base text-gray-800 md:text-base dark:text-gray-200">


                                {!! $service->description !!}

                            </div>


                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Support :</p>
                                    <div id="support" class="text-gray-800">
                                        <div class="px-2 mt-2">
                                            <ul class="list-disc">
                                                @foreach ($service->basic_support as $key=>$value)
                                                <li>{{$value}}</li>
                                                @endforeach

                                            </ul>

                                        </div>

                                    </div>


                                </div>


                            </div>

                            <div class="grid hidden grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Prix :</p>
                                    <p class="px-2 mt-2 text-gray-700 dark:text-gray-300">à partir de
                                        <span class="text-lg text-green-700">{{$service->price()}}</span>
                                    </p>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Délai :</p>
                                    <p class="text-gray-700 dark:text-gray-300">{{$service->basic_delivery_time}} jours
                                    </p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">

                                @if($service->category->name=="Photographie")
                                <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Format :</p>
                                    <p class="text-gray-700 dark:text-gray-300">Jpg , jepg</p>
                                </div>
                                @endif

                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Besoin pour ce service :</p>
                                     {!! $service->need_service !!}
                                    </div>
                            </div>


                            @include('livewire.web.category.level')
                        </div>




                        <div x-show.transition="step==2" class="py-5 min-h-72">

                           <div class="grid grid-cols-1 gap-4 ">
                            @empty(!$service->example)

                            <div class="p-4 bg-white rounded-md shadow">
                                <div class="flex flex-row gap-2 p-4 mb-4">
                                    <div x-init="$nextTick(()=>$el._x_swiper = new Swiper($el,{ navigation: {prevEl: '.swiper-button-prev', nextEl: '.swiper-button-next'}, pagination: { el: '.swiper-pagination',type: 'progressbar'},lazy: true,}))"
                                        class="rounded-lg swiper">
                                        <div class="swiper-wrapper">

                                            @foreach($service->example['image'] as $key=> $image)


                                            <div class="p-2 swiper-slide">
                                                <img class="object-fill w-full h-full rounded-md swiper-lazy"
                                                    src="{{Storage::disk('local')->url($image) }}" alt="" />
                                                <div class="hidden swiper-lazy-preloader"></div>
                                            </div>
                                            @endforeach


                                        </div>
                                        <div class="swiper-pagination"></div>
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                                <div class="p-4 mt-2 font-sans text-gray-700 dark:text-gray-200">
                                    {!! $service->example['description'] !!}
                                </div>
                            </div>

                            @endempty
                        </div>



                        </div>





                        <div x-show.transition="step==4" class="py-5 min-h-72">


                            @if(!empty($service->orders))
                            @forelse ($commentaires as $commentaire)

                            @if ($loop->index < 6) <div class="p-4 mb-4 bg-gray-100 rounded-lg dark:bg-gray-600">

                                <p class="text-sm text-gray-700 md:text-base dark:text-gray-300">
                                    {{$commentaire->commentaires}}</p>

                                <div class="flex items-center my-4">
                                    <svg class="w-4 h-4 mr-1 text-yellow-500 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M10 14.155L4.284 17.84l.828-5.076L.898 7.865l5.059-.736L10 2l2.043 5.129 5.059.736-3.215 3.9.828 5.076z" />
                                    </svg>

                                    <span
                                        class="text-sm font-semibold text-gray-700 dark:text-gray-100">({{$commentaire->satisfaction}})
                                    </span>
                                </div>
                                <div class="flex items-center gap-3">

                                    @component("components.user-photo" ,['user'=>$commentaire->order->user])
                                    @endcomponent

                                    <p class="font-bold text-gray-800">{{$commentaire->order->user->name}}</p>
                                </div>
                        </div>

                        @endif
                        @empty

                        <div class="p-4 mb-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                            <p class="text-sm text-gray-700 md:text-base dark:text-gray-300">
                                Pas de commentaires .</p>

                        </div>

                        @endforelse


                        @else

                        <div class="p-4 mb-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                            <p class="text-sm text-gray-700 md:text-base dark:text-gray-300">
                                Pas de commentaires .</p>

                        </div>

                        @endif






                    </div>


                    <div class="px-4">
                        <p class="mb-4 text-lg font-medium text-gray-800 dark:text-gray-200">À propos du freelance
                        </p>
                        <div class="flex items-center gap-4 mb-8">


                            @component("components.user-photo" ,['user'=>$service->freelance->user,'taille'=>18])
                            @endcomponent


                            <div>
                                <p class="font-bold text-gray-800 dark:text-gray-300">
                                    {{$service->freelance->user->name}}</p>
                                <p class="block text-gray-700 truncate dark:text-gray-300">
                                    {{$service->freelance->category->name}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <div x-show="!isLoading ">
        <div class="px-4">
            <p class="text-lg font-bold text-gray-800 dark:text-gray-200">Du meme Categorie</p>
        </div>


        <div class="grid gap-4 px-4 py-4 mx-auto md:grid-cols-4">

            @forelse ($servicesOther as $serviceOther)



            @livewire('web.card.service-card',['service' => $serviceOther],key($serviceOther->id))
            @empty

            @endforelse



        </div>
    </div>



    <div x-show="!navOpen"
        class="fixed bottom-0 left-0 z-40 items-center hidden p-2 m-4 bg-white shadow-lg md:flex rounded-xl dark:bg-gray-800">
        <div class="w-10 h-10 mr-4 overflow-hidden rounded-full md:w-12 md:h-12">


          {{--  @component("components.user-photo" ,['user'=>$service->freelance->user])
            @endcomponent--}}
        </div>
        <div>
            <div class="font-bold dark:text-gray-200 ">{{$service->freelance->user->name}}</div>
            <div class="text-sm text-gray-500">{{$service->freelance->user->is_online ? 'online':'pas disponible'}}
            </div>
        </div>

    </div>


<div x-show="contactMe" x-cloak
        class="fixed bottom-[4rem] top-[8rem] left-[2rem] sm:top-1/2 sm:left-1/2 transform sm:-translate-x-1/2 sm:-translate-y-1/2 md:top-[8rem] md:left-[2rem] md:transform-none z-[85] flex flex-col bg-white dark:bg-gray-900 shadow-lg bg-opacity-20"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-x-full"
    x-transition:enter-end="opacity-100 transform -translate-x-0" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform -translate-x-0"
    x-transition:leave-end="opacity-0 transform -translate-x-full">



        @if(!$messageSent)

        <div class="flex flex-col justify-center flex-grow w-full max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-lg">
            <!-- Bouton de fermeture -->
            <button @click="contactMe=!contactMe"
                class="absolute top-0 right-0 p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- En-tête du chat -->
            <div class="flex flex-col items-start justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-semibold">{{$service->freelance->user->name}}</span>
                    <span
                        class="{{$service->freelance->user->is_online ?'bg-green-400':'bg-gray-400'}}   rounded-full h-2 w-2"></span>
                    <span class="text-xs text-gray-500">{{$service->freelance->user->is_online ? 'En ligne':'pas
                        disponible'}}</span>
                </div>
                <span class="text-xs text-gray-500">Temps de réponse : 2 heures</span>
            </div>

            <!-- Corps du chat -->
            <div x-data="{ message: @entangle('body') }" class="flex-grow space-y-2">

                <textarea x-model="message"
                    class="w-full p-2 rounded-lg focus:ring-0 dark:bg-gray-800 dark:text-gray-100 focus:border-amber-500"
                    rows="4" placeholder="Votre message..."></textarea>

                <div class="flex flex-col gap-2">


                    <div class="flex flex-col gap-2">
                        <div @click="message += ' Quelle est la durée estimée pour la réalisation de ce service ?'"
                            class="p-1 transition bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-700 hover:bg-gray-200">
                            <p>Quelle est la durée estimée pour la réalisation de ce service ?</p>
                        </div>
                        <div @click="message += ' Quels sont les détails spécifiques inclus dans ce service ?'"
                            class="p-1 transition bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-700 hover:bg-gray-200">
                            <p>Quels sont les détails spécifiques inclus dans ce service ?</p>
                        </div>
                        <div @click="message += ' Pouvez-vous me fournir plus d\'informations sur les tarifs ?'"
                            class="p-1 transition bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-700 hover:bg-gray-200">
                            <p>Pouvez-vous me fournir plus d'informations sur les tarifs ?</p>
                        </div>
                    </div>


                </div>
            </div>



            <!-- Champ de texte et bouton pour envoyer -->
            <div class="flex justify-between mt-4 space-x-2">
                <div class="flex gap-3">
                    <button
                        class="flex items-center p-2 rounded-full shrink-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                    </button>
                </div>
                <x-filament::button icon="heroicon-m-paper-airplane" icon-position="after" @click="$wire.contacter()" color="info">
                    Envoyer
                </x-filament::button>



            </div>
        </div>
        @else
        <div class="flex flex-col justify-center flex-grow w-full max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-lg">
            <!-- Bouton de fermeture -->
            <button @click="contactMe=!contactMe"
                class="absolute top-0 right-0 p-2 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- En-tête du chat -->
            <div class="flex flex-col items-start justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-semibold">{{$service->freelance->user->name}}</span>
                    <span
                        class="{{$service->freelance->user->is_online ?'bg-green-400':'bg-gray-400'}}   rounded-full h-2 w-2"></span>
                    <span class="text-xs text-gray-500">{{$service->freelance->user->is_online ? 'En ligne':'pas
                        disponible'}}</span>
                </div>
                <span class="text-xs text-gray-500">Temps de réponse : 2 heures</span>
            </div>


            <div x-data="" class="flex-grow space-y-2">



                <div class="flex flex-col gap-2">

                    <div
                        class="p-1 transition bg-gray-100 rounded-lg cursor-pointer dark:bg-gray-700 hover:bg-gray-200">
                        <p>Votre Message a ete envoyer au freelance</p>
                    </div>


                    <div class="flex justify-around">


                        <x-filament::button color="success" icon="heroicon-m-eye" href="{{route('MessageUser')}}" tag="a">
                                voir les messages
                        </x-filament::button>





                    </div>


                </div>
            </div>

            <div class="flex justify-between mt-4 space-x-2">
                <div class="flex gap-3">
                    <button
                        class="flex items-center p-2 rounded-full shrink-0 text-slate-500 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-200 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                    </button>
                </div>

                <button @click="$wire.contacter()"
                    class="px-4 py-2 text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">Envoyer</button>
            </div>
        </div>


        @endif
    </div>





</div>


</div>


