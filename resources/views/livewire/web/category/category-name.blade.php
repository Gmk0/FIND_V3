<div x-data="{showFiltre: false}" class="min-h-screen py-8 px-4 bg-[#fcf9f6] md:pt-4 md:px-8">

    <div class="mx-2">
        @include('include.bread-cumb',['category'=>'category'])
    </div>

    <div class="flex flex-col">

        <div class=" grid h-auto grid-cols-12">
            <div class="lg:col-span-3"></div>

            <div class="lg:col-span-9 col-span-12 grid lg:grid-cols-2  gap-4 lg:gap-2 ">
                <div class="px-4">
                    <x-input class="!rounded-full   !shadow-md" wire:model.live.debounce.100ms='search' placeholder="recherche" icon='search' />
                </div>
                <div class="flex px-4 flex-row justify-between gap-2">
                    <div class="">
                        <div class="block lg:hidden">

                            <x-button @click="showFiltre=!showFiltre" label="filtre">

                            </x-button>
                        </div>

                    </div>
                    <div class="flex gap-2">

                        <div>
                            <x-select placeholder="Trier par" class="!rounded-xl !shadow-md" wire:model.live.debounce.100ms="filter">
                                <x-select.option label="Populaire" value="Populaire" />
                                <x-select.option label="Niveau" value="Nouveau" />
                                <x-select.option label="Ancien" value="Ancien" />
                                <x-select.option label="Mieux coter" value="cote" />
                            </x-select>

                        </div>
                        <div>
                            <x-select placeholder="Trier par" class="!rounded-xl !shadow-md" wire:model.live.debounce.100ms="trie">
                                <x-select.option label="Prix ascendant" value="basic_price-asc" />
                                <x-select.option label="Prix Descendant" value="basic_price-desc" />
                                <x-select.option label="Niveau ascendant" value="level-asc" />
                                <x-select.option label="Niveau Descendant" value="level-desc" />

                            </x-select>

                        </div>


                    </div>


                </div>

            </div>


        </div>
        <div class="grid lg:grid-cols-12 w-full gap-2">
            <div x-bind:class="showFiltre? 'fixed inset-0  top-0  bottom-0  dark:bg-gray-800 bg-white z-50 p-4 transition-all duration-200 w-full' : 'hidden w-full mt-0   z-20'"
            class="lg:col-span-3 overflow-x-hidden overflow-y-auto   rounded-md   lg:h-auto lg:block">
                <div class="p-2 flex flex-col">
                    <h1 class="text-lg font-bold mb-2 text-gray-800">Categorie</h1>


                    <div class="grid lg:grid-cols-1 grid-cols-2 gap-2">*

                       @forelse ($categories as $item)
                    <div>
                        <button wire:click="setCategory({{ $item->id }})"
                            class="flex gap-2 transition-all rounded-lg shadow-sm transform p-2 {{ $category == $item->id ? 'bg-amber-400 text-gray-50 translate-x-4 ' : 'bg-white text-gray-600' }} hover:translate-x-4 active:bg-amber-400 focus:bg-amber-400 focus:translate-x-4 focus:text-gray-50 active:translate-x-4">
                            <img src="{{Storage::disk('local')->url('public/'.$item->illustration) }}"
                                class="w-8 p-1 object-fill rounded-md" alt="">
                            <span class="">{{$item->name}}</span>
                            <!-- Adjusted span for the number -->
                            <span class="ml-2 bg-white text-gray-600  px-1 py-0.5 text-[10px] rounded-full">{{count($item->services)}}</span>
                        </button>
                    </div>
                    @empty
                    <!-- Handle empty case here -->

                        @endforelse

                    </div>

                    <div class="mt-4">

                        <h1 class="text-lg font-bold mb-4 text-gray-800">Prix</h1>
                        <fieldset x-data="{message:'10'}" class="space-y-1 sm:w-48 dark:text-gray-100">
                            <input type="range" x-model="message" wire:model.live.debounce.100ms="price_range" class="w-full accent-amber-400" min="10"
                                max="10000">
                            <div aria-hidden="true" class="flex justify-between px-1">
                                <span>10$</span>

                                <span x-text="message">$</span>

                            </div>
                        </fieldset>

                    </div>



                </div>

            </div>
            <div class="lg:col-span-9 col-span-12">

                <div class="py-4 px-4">


                    <div class="hidden lg:block">
                        {{$services->links()}}

                    </div>


                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

                    @forelse ($services as $service)

                    <div x-show="loading"
                        class="lg:h-[23rem] h-52  overflow-hidden bg-white rounded-xl animate-pulse shadow-md dark:text-gray-200 dark:bg-gray-900">

                    </div>

                    <div x-cloak x-show="!loading" x-data="{linkHover: false}"  @mouseover="linkHover = true" @mouseleave="linkHover = false" class="lg:h-[23rem] h-52  overflow-hidden bg-white rounded-xl shadow-md dark:text-gray-200 dark:bg-gray-900 ">

                        <div class="flex flex-row lg:flex-col">

                           <div x-data="{ activeSlide: 0, slides: [] }" x-init="slides = {{ json_encode($service->files) }}"
                            class="relative group w-[48%] lg:w-full">

                            <!-- Slides -->
                            <template x-for="(slide, index) in slides" :key="index">
                                <div x-show="activeSlide === index" class="p-3 ">
                                    <div class="w-full transition border border-red-300 duration-500 ease-out bg-center bg-cover rounded-xl h-48 lg:h-40"
                                        :style="'background-image: url(/storage/' + slide + ')'">
                                    </div>
                                </div>
                            </template>

                           <div class="px-4 ">
                            <button x-cloak x-show="slides.length > 1 && activeSlide !== 0"
                                @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                                class="absolute top-1/2 left-0 ml-3 btn-outline btn-circle btn-sm p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                ❮
                                <!-- Left arrow -->
                            </button>
                            <button x-cloak x-show="slides.length > 1 && activeSlide !== slides.length - 1"
                                @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                                class="absolute top-1/2 right-0 mr-3 opacity-0 group-hover:opacity-100 P-4 transition-opacity btn2 btn-outline btn-circle btn-sm">
                                ❯
                                <!-- Right arrow -->
                            </button>

                           </div>


                            <!-- Indicators -->
                            <div x-cloak x-show="slides.length > 1" class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2">
                                <template x-for="(slide, index) in slides" :key="index">
                                    <span :class="activeSlide === index ? 'bg-red-500' : 'bg-gray-300'"
                                        class="block w-2 h-2 rounded-full"></span>
                                </template>
                            </div>

                        </div>



                            <div class="w-[52%]  md:w-full flex gap-1 lg:px-4 px-2 pt-1 pb-2 flex-col">
                                <div class="flex lg:mt-0 mt-1   justify-between ">
                                  <div class="flex gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1 text-yellow-200" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10 13.165l-4.53 2.73 1.088-5.997L.976 6.305l6.018-.873L10 0l2.006 5.432 6.018.873-4.582 3.593 1.088 5.997L10 13.165z" />
                                    </svg>
                                    <p class="text-sm text-gray-700 dark:text-gray-300">{{$service->averageFeedback()}}
                                        ({{$service->orderCount()}})
                                    </p>
                                  </div>
                                  <div class="flex">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">
                                        {{$service->freelance->level}}</p>

                                        @auth
                                        <div wire:ignore x-data="{ like: @json($service->isFavorite()) }" class="flex items-center">
                                            <button class="mr-2" x-on:click="like=!like" @click="$wire.toogleFavorite({{$service->id}})">


                                                <span x-cloak x-show="!like" class="">
                                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </span>
                                                <span x-cloak x-show="like">
                                                    <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    </svg>
                                                </span>


                                            </button>



                                        </div>
                                        @endauth

                                  </div>

                                </div>
                                <div class="mt-1">
                                    <a  href="{{route('ServicesViewOne',['service_numero'=>$service->service_numero,'category'=>$service->category->name])}}

                                        " wire:navigate
                                        class="mr-1 hover:text-amber-600 text-gray-600 font-bold ">
                                            {{$service->title}}
                                    </a>
                                    <p class="md:text-sm text-[11px] text-gray-600 mt-1">
                                        {!! \Illuminate\Support\Str::limit($service->description, 50) !!}

                                    </p>

                                </div>
                                <div class="flex md:mt-3 mt-auto mb-2  justify-between">
                                    <div class="flex gap-1">
                                        @component("components.user-photo" ,['user'=>$service->freelance->user,])
                                        @endcomponent
                                        <div class="flex flex-col">
                                            <span class="text-xs flex md:hidden">{{ \Illuminate\Support\Str::limit($service->freelance->user->name, 10) }}</span>
                                            <span class="text-xs md:flex hidden">{{$service->freelance->user->name}}</span>
                                            <span class="text-xs">
                                                {{ \Illuminate\Support\Str::limit($service->freelance->category->name, 10) }}

                                            </span>
                                        </div>

                                    </div>
                                    <div class="">

                                        <button class="px-4 py-2 font-medium rounded-br-xl rounded-md bg-skin-fill w-full text-white ">
                                            {{$service->basic_price}} $
                                        </button>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                 @empty
                <div class="flex justify-center items-center h-64">
                    <span class="text-gray-500 text-lg font-medium">
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




    </div>


  {{--  <div class="grid grid-cols-2 gap-4 md:gap-6 md:grid-cols-4 xl:gap-8">

        @forelse ($categories as $category)

        <a href="{{route('categoryByName',[$category->name])}}"
            class="flex flex-col items-center px-2 py-4 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="{{Storage::disk('local')->url('public/'.$category->illustration) }}" class="w-20 h-20 rounded-md"
                alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px]   font-semibold text-slate-600 duration-200 group-hover:text-white">
                {{$category->name}}</h4>

        </a>
        @empty




        <div
            class="flex flex-col items-center px-2 py-4 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/develloper.png" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px]   font-semibold text-slate-600 duration-200 group-hover:text-white">
                Programation</h4>

        </div>

        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/designer.png" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px] font-semibold text-slate-600 duration-200 group-hover:text-white">
                Graphisme & Designer</h4>

        </div>

        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-blue-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/photo.png" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px]  font-semibold text-slate-600 duration-200 group-hover:text-white">
                Photographie</h4>

        </div>

        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/marketing.png" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px] font-semibold text-slate-600 duration-200 group-hover:text-white">
                marketing Digital</h4>

        </div>

        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/deco.png" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px] font-semibold text-slate-600 duration-200 group-hover:text-white">
                Decoration</h4>

        </div>

        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/business.svg" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px]  font-semibold text-slate-600 duration-200 group-hover:text-white">
                Bussiness</h4>

        </div>
        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/redaction.svg" class="w-20 h-20 rounded-md" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px] font-semibold text-slate-600 duration-200 group-hover:text-white">
                Redaction & Traduction</h4>

        </div>
        <div
            class="flex flex-col items-center px-5 py-8 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
            <img src="/images/services/loisir.svg" class="w-20 h-20 rounded-md hover:bg-white" alt="">
            <h4
                class="mt-3 mb-1 md:text-[20px] text-[16px]  font-semibold text-slate-600 duration-200 group-hover:text-white">
                Loisirs</h4>

        </div>
        @endforelse
    </div>--}}
</div>
