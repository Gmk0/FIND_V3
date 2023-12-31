<div class="min-h-screen py-16 pb-12">

    <div x-data="{showFiltre: false}" class="">

        <div id="page-content">

            <div x-cloak x-show="!loading" class="relative h-24 bg-skin-fill">
                <img class="hidden object-cover w-full h-full opacity-70" src="" alt=""
                    title="" />
                <div class="absolute inset-0 flex items-center justify-center">
                    <h1 class="text-lg font-bold text-white lg:text-4xl">{{$subcategoryName}}</h1>
                </div>
            </div>
            <!--End Collection Banner-->

            <div x-show="loading" class="relative w-full bg-gray-300 h-36 animate-pulse">

            </div>


           <div class="mt-4 ">
            <div x-show="loading">

            <div class="flex flex-row flex-1 h-screen p-8 overflow-y-hidden">
                <div
                    class="order-first hidden w-64 h-screen p-2 px-2 mx-2 overflow-y-auto bg-gray-300 rounded-md animate-pulse custom-scrollbar md:flex ">
                    <div>

                    </div>
                </div>
                <div
                    class="flex-1 h-screen p-4 overflow-y-auto text-xs bg-gray-200 border-r border-indigo-300 rounded-md animate-pulse custom-scrollbar">
                    <div class="h-8 mb-2 bg-gray-200 rounded-md animate-pulse">

                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-3">
                        <div class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                        <div class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                        <div class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                    </div>

                </div>
            </div>
        </div>

                <div class="sticky top-0 z-30 grid h-auto grid-cols-12 px-4 py-2 bg-white lg:z-0 lg:bg-transparent lg:relative">
                    <div class="flex items-center lg:col-span-3">

                        <nav class="hidden py-4">
                            <ul class="flex items-center space-x-2 text-sm text-gray-600">
                               <li class="flex items-center">
                                    <a rel="noopener noreferrer" href="{{url('/')}}" title="Back to homepage" class="hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-5 h-5 pr-1 dark:text-gray-400">
                                            <path
                                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                            </path>
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <span class="mx-2">/</span>
                                </li>


                                <li class="text-gray-800">
                                    <a href="/" class="hover:text-gray-800">Categorie</a>
                                </li>



                            </ul>
                        </nav>


                    </div>

                    <div class="grid col-span-12 gap-4 lg:col-span-9 lg:grid-cols-12 lg:gap-2 ">
                        <div class="px-4 lg:col-span-10">
                            <x-input class="!rounded-full   !shadow-md" wire:model.live.debounce.100ms='search'
                                placeholder="recherche" icon='search' />
                        </div>
                        <div class="flex flex-row justify-between gap-2 px-4 lg:col-span-2">
                            <div class="">
                                <div class="block lg:hidden">

                                    <x-button @click="showFiltre=!showFiltre" label="filtre">

                                    </x-button>
                                </div>

                            </div>
                            <div class="flex gap-2">


                                <div>
                                    <x-select placeholder="Trier par" class="!rounded-xl !shadow-md"
                                        wire:model.live.debounce.100ms="trie">
                                        <x-select.option label="Prix ascendant" value="basic_price-asc" />
                                        <x-select.option label="Prix Descendant" value="basic_price-desc" />
                                        <x-select.option label="Niveau ascendant" value="level-asc" />
                                        <x-select.option label="Niveau Descendant" value="level-desc" />
                                        <x-select.option label="Populaire" value="populaire-desc" />
                                        <x-select.option label="Nouveau" value="nouveau-desc" />

                                    </x-select>

                                </div>


                            </div>


                        </div>

                    </div>


                </div>
                <div class="grid grid-cols-12">
                    <!--Sidebar-->
                    <div class="relative col-span-3 p-2">

                        <div x-bind:class="showFiltre? 'fixed inset-0   top-0  bottom-0  dark:bg-gray-800 bg-white z-50 p-4 transition-all duration-200 w-full' : 'hidden w-full mt-0   z-20'"
                            class="overflow-x-hidden overflow-y-auto rounded-md lg:h-auto lg:block">
                            <div class="flex flex-col p-2">
                                <h1 class="mb-2 text-lg font-bold text-gray-800">Sous category</h1>

                                <div class="grid grid-cols-2 gap-2 lg:grid-cols-1">

                                   {{-- @forelse ($subcat as $item)
                                    <div>
                                        <button wire:click="setCategory({{ $item->id }})"
                                            class="flex gap-2 transition-all rounded-lg shadow-sm transform p-2 {{ $sous_category == $item->id ? 'border-2 border-amber-500 bg-amber-100 text-amber-700 translate-x-4 ' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }} hover:translate-x-4 focus:translate-x-4 active:translate-x-4">
                                            <img src="{{Storage::disk('local')->url('public/'.$item->illustration) }}"
                                                class="object-fill w-8 p-1 rounded-md" alt="">
                                            <span class="">{{$item->name}}</span>
                                            <!-- Adjusted span for the number -->
                                            <span
                                                class="ml-2 bg-white text-gray-600  px-1 py-0.5 text-[10px] rounded-full">{{count($item->services())}}</span>
                                        </button>
                                    </div>
                                    @empty
                                    <!-- Handle empty case here -->

                                    @endforelse--}}

                                </div>

                                <div class="mt-4">

                                    <h1 class="mb-4 text-lg font-bold text-gray-800">Prix</h1>
                                    <fieldset x-data="{message:'10'}" class="w-full space-y-1 dark:text-gray-100">
                                        <input type="range" x-model="message"
                                            wire:model.live.debounce.100ms="price_range" class="w-full accent-amber-400"
                                            min="10" max="10000">

                                        <div aria-hidden="true" class="flex justify-between px-1">

                                            <div class="flex gap-4 p-2 border ">
                                                <span>10$</span>

                                                <span class="flex">

                                                    <span x-text="message"></span>
                                                    <span>$</span>
                                                </span>
                                            </div>
                                            @if(!empty($price_range))
                                            <div>
                                                <x-button @click="message='10'" wire:click='PriceRest' sm
                                                    label='annuler' />
                                            </div>
                                            @endif



                                        </div>
                                    </fieldset>

                                </div>


                                <div x-data="{showCategoryFilter:false}"
                                    class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                    <button @click="showCategoryFilter=!showCategoryFilter"
                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                        <span class="text-base dark:text-gray-100"> Niveau Freelannce</span>
                                        <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                        </svg>
                                        <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                        </svg>
                                    </button>
                                    <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'"
                                        class="">

                                        <div>
                                           <x-checkbox wire:click='level(1)' value="1" label='Nouveau' />
                                            <x-checkbox wire:click='level(2)' value="2" label='Niveau 2' />
                                            <x-checkbox wire:click='level(3)' value="3" label='Niveau 3' />
                                            <x-checkbox wire:click='level(4)' value="4" label='Niveau 4' />
                                            <x-checkbox wire:click='level(4)' value="5" label='Top prestataire' />


                                        </div>
                                    </div>

                                    <div x-data="{showCategoryFilter:false}"
                                        class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                        <button @click="showCategoryFilter=!showCategoryFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100"> Temps de livraison</span>
                                            <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'"
                                            class="">


                                            <x-select wire:model.live.100ms='delivery_time' class="!w-full" :options="['1-5'=>'1-5 jours',
                                                        '5-10'=>'5-10 jours',
                                                        '10-50'=>'plus de 10 jours',]" />



                                        </div>
                                    </div>
                                    <div x-data="{showCategoryFilter:false}"
                                        class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                        <button @click="showCategoryFilter=!showCategoryFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100"> Localisation</span>
                                            <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'"
                                            class="">

                                            <x-select class="w-full" wire:model.live.debounce.100ms="localisation"
                                                placeholder="Ville" :async-data="route('api.city')" option-label="ville"
                                                option-value="id" />
                                        </div>
                                    </div>
                                    <div x-data="{showCategoryFilter:true}"
                                        class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
                                        <button @click="showCategoryFilter=!showCategoryFilter"
                                            class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                            <span class="text-base dark:text-gray-100"> Tag de recherche</span>
                                            <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                            </svg>
                                            <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                            </svg>
                                        </button>
                                        <div x-bind:class="showCategoryFilter ? 'flex flex-wrap relative w-full p-1 mt-2' : 'hidden'"
                                            class="">
                                            @foreach($tags as $tag)
                                            <span
                                                class="inline-block cursor-pointer rounded-full px-3 py-1 text-sm font-semibold mr-2 mb-2
                                                    {{ $selectedTag === $tag ? 'border-2 border-amber-500 bg-amber-100 text-amber-700' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200' }}"
                                                wire:click="filterByTag('{{ $tag }}')">
                                                {{ $tag }}
                                            </span>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="flex gap-4 lg:hidden">
                                <x-button amber x-on:click="showFiltre=!showFiltre" label="appliquer">
                                </x-button>
                                <x-button x-on:click="showFiltre=!showFiltre" label="Fermer">


                                </x-button>
                            </div>

                        </div>
                        <!--End Sidebar-->
                        <!--Main Content-->


                    </div>

                    <div class="col-span-12 pt-8 lg:col-span-9">

                        <div class="px-4 py-4">
                            @if($count = $this->countFiltersApplied())
                            <div class="flex gap-4 p-2 mb-4 rounded">

                                <span class="text-sm text-amber-600">Filtres appliqués : {{ $count }}</span>



                            </div>
                            @endif
                            <div wire:loading class="flex items-center justify-center p-2">
                               <div class="flex gap-2">
                                <div class="w-5 h-5 bg-blue-600 rounded-full animate-pulse"></div>
                                <div class="w-5 h-5 bg-blue-600 rounded-full animate-pulse"></div>
                                <div class="w-5 h-5 bg-blue-600 rounded-full animate-pulse"></div>
                            </div>
                            </div>


                            <div class="hidden lg:block">
                                {{$services->links()}}

                            </div>


                        </div>

                        <div class="grid gap-4 px-4 md:grid-cols-2 lg:grid-cols-3">

                            @forelse ($services as $service)

                            @livewire('web.card.service-card',['service' => $service], key($service->id))



                            @empty
                            <div class="flex items-center justify-center h-64">
                                <span class="text-lg font-medium text-gray-500">
                                    Aucun élément trouvé.
                                </span>
                            </div>
                            @endforelse





                        </div>

                        <div class="py-4">


                            <div>
                                {{$services->links()}}

                            </div>


                        </div>

                    </div>
                </div>


                <div class="grid px-4 pt-16 lg:grid-cols-12 ">
                    <div class="hidden lg:col-span-3 lg:block">

                    </div>
                    <div class="lg:col-span-9">

                        <div class="items-center mb-4">
                            <h1 class="text-lg font-semibold text-center">Du meme Categories</h1>
                        </div>
                        <div class="flex flex-wrap gap-4">
                            @forelse ($subcatgeoryElement as $item)
                            <div>
                                <a href="{{route('SubcategoryName',[$categoryElement->name,$item->name])}}"
                                    class="flex gap-2 p-2 transition-all transform bg-gray-200 rounded-lg shadow-sm dark:bg-gray-700 hover:scale-95 active:bg-amber-400 focus:bg-amber-400 focus:text-gray-50 ">
                                   @if(!empty($item->illustration))
                                    <img src="{{Storage::disk('local')->url('public/'.$item->illustration) }}"
                                        class="object-fill w-8 p-1 rounded-md" alt="">
                                    @endif
                                    <span class="">{{$item->name}}</span>
                                    <!-- Adjusted span for the number -->

                                    <div
                                        class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-2 dark:border-gray-900">
                                        {{count($item->services())}}</div>
                                </a>
                            </div>
                            @empty


                            @endforelse

                        </div>



                    </div>



                </div>

            </div>
            <script>
                window.addEventListener('gotoTop',function(){

                window.scrollTo({
                top: 15,
                left: 15,
                behaviour: 'smooth'
                })

                });
            </script>

        </div>
