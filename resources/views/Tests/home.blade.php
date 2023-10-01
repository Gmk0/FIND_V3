<x-web-layout>

    <div x-data="{showFiltre: false}" class="pt-16">

        <div id="page-content">

            <div class="collection-header">
                <div class="collection-hero">
                    <div class="collection-hero__image"><img class="blur-up lazyload" data-src="/test/assets/images/cat-women2.jpg"
                            src="/test/assets/images/cat-women2.jpg" alt="Women" title="Women" /></div>
                    <div class="collection-hero__title-wrapper">
                        <h1 class="collection-hero__title page-width"></h1>
                    </div>
                </div>
            </div>
            <!--End Collection Banner-->

            <div class="container mt-4 px-4">

                <div class="grid h-auto grid-cols-12">
                    <div class="lg:col-span-3"></div>

                    <div class="lg:col-span-9 col-span-12 grid lg:grid-cols-2  gap-4 lg:gap-2 ">
                        <div class="px-4">
                            <x-input class="!rounded-full   !shadow-md" wire:model.live.debounce.100ms='search' placeholder="recherche"
                                icon='search' />
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

                                </div>
                                <div>
                                    <x-select placeholder="Trier par" class="!rounded-xl !shadow-md"
                                        wire:model.live.debounce.100ms="trie">
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
                <div class="grid grid-cols-12">
                    <!--Sidebar-->
                    <div class="col-span-3 p-2  ">

                        <div x-bind:class="showFiltre? 'fixed inset-0  top-0  bottom-0  dark:bg-gray-800 bg-white z-50 p-4 transition-all duration-200 w-full' : 'hidden w-full mt-0   z-20'"
                            class="overflow-x-hidden overflow-y-auto   rounded-md   lg:h-auto lg:block">
                            <div class="p-2 flex flex-col">
                                <h1 class="text-lg font-bold mb-2 text-gray-800">Sous category</h1>

                                <div class="grid lg:grid-cols-1 grid-cols-2 gap-2">

                                    @forelse (\App\Models\Category::all() as $item)
                                    <div>
                                        <button wire:click="setCategory({{ $item->id }})"
                                            class="flex gap-2 transition-all rounded-lg shadow-sm transform p-2 {{ 3 == $item->id ? 'bg-amber-400 text-gray-50 translate-x-4 ' : 'bg-white text-gray-600' }} hover:translate-x-4 active:bg-amber-400 focus:bg-amber-400 focus:translate-x-4 focus:text-gray-50 active:translate-x-4">
                                            <img src="{{Storage::disk('local')->url('public/'.$item->illustration) }}"
                                                class="w-8 p-1 object-fill rounded-md" alt="">
                                            <span class="">{{$item->name}}</span>
                                            <!-- Adjusted span for the number -->
                                            <span
                                                class="ml-2 bg-white text-gray-600  px-1 py-0.5 text-[10px] rounded-full">{{count($item->services)}}</span>
                                        </button>
                                    </div>
                                    @empty
                                    <!-- Handle empty case here -->

                                    @endforelse

                                </div>

                                <div class="mt-4">

                                    <h1 class="text-lg font-bold mb-4 text-gray-800">Prix</h1>
                                    <fieldset x-data="{message:'10'}" class="space-y-1 sm:w-48 dark:text-gray-100">
                                        <input type="range" x-model="message" wire:model.live.debounce.100ms="price_range"
                                            class="w-full accent-amber-400" min="10" max="10000">

                                        <div aria-hidden="true" class="flex justify-between px-1">
                                            <span>10$</span>

                                            <span class="flex">

                                                <span x-text="message"></span>
                                                    <span>$</span>
                                            </span>


                                        </div>
                                    </fieldset>

                                </div>


                                <div x-data="{showCategoryFilter:false}" class="mt-4 mb-4 border-t py-3  relative border-gray-400 ">
                                    <button @click="showCategoryFilter=!showCategoryFilter"
                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                        <span class="text-base dark:text-gray-100"> Niveau Freelannce</span>
                                        <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                        </svg>
                                        <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                        </svg>
                                    </button>
                                    <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'" class="">

                                       <div>
                                            <x-checkbox label='Niveau' />
                                            <x-checkbox label='Niveau 1' />
                                            <x-checkbox label='Nivea 2' />
                                            <x-checkbox label='Niveau 3' />
                                            <x-checkbox label='Niveau 4' />


                                        </div>
                                </div>

                                <div x-data="{showCategoryFilter:false}" class="mt-4 mb-4 border-t py-3  relative border-gray-400 ">
                                    <button @click="showCategoryFilter=!showCategoryFilter"
                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                        <span class="text-base dark:text-gray-100"> Temps de livraison</span>
                                        <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                        </svg>
                                        <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                        </svg>
                                    </button>
                                    <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'" class="">


                                           <x-select class="!w-full" />



                                    </div>
                                </div>
                                <div x-data="{showCategoryFilter:false}" class="mt-4 mb-4 border-t py-3  relative border-gray-400 ">
                                    <button @click="showCategoryFilter=!showCategoryFilter"
                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                        <span class="text-base dark:text-gray-100"> Localisation</span>
                                        <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                        </svg>
                                        <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                        </svg>
                                    </button>
                                    <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'" class="">

                                        <x-select class="w-full" wire:model.live.debounce.100ms="category" placeholder="Compentences"
                                            :async-data="route('api.services')" option-label="name" option-value="name" />
                                    </div>
                                </div>
                                <div x-data="{showCategoryFilter:true}" class="mt-4 mb-4 border-t py-3  relative border-gray-400 ">
                                    <button @click="showCategoryFilter=!showCategoryFilter"
                                        class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                        <span class="text-base dark:text-gray-100"> Tag de recherche</span>
                                        <svg x-show="!showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                        </svg>
                                        <svg x-show="showCategoryFilter" class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                        </svg>
                                    </button>
                                    <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'" class="">

                                        <x-select class="w-full" wire:model.live.debounce.100ms="category" placeholder="Compentences"
                                            :async-data="route('api.services')" option-label="name" option-value="name" />
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                    <!--End Sidebar-->
                    <!--Main Content-->
                    <div class="col-span-9  pt-8 ">




                        <!--End Main Content-->
                    </div>
                </div>
            </div>
    </div>

</x-web-layout>
