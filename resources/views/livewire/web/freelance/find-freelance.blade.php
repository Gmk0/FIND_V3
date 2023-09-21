<div class="min-h-screen ">


    <style>
        @media screen and (min-width: 768px) {
            #menu-content {
                top: 6rem;
            }
        }
    </style>

    <div class="flex flex-col bg-gray-100 dark:bg-gray-900"
        x-data="{ isOpen:false,isLoading: true,showFilters: false,showSearch: false }"
        x-init="setTimeout(() => { isLoading = false }, 3000)">




        <div x-show="isLoading">

            <div class="flex flex-row flex-1 h-screen p-8 overflow-y-hidden">
                <div
                    class="order-first hidden w-64 h-screen p-2 px-2 mx-2 overflow-y-auto bg-gray-300 rounded-md animate-pulse custom-scrollbar md:flex ">
                    <div>

                    </div>
                </div>
                <div
                    class="flex-1 h-screen p-4 overflow-y-auto text-xs bg-gray-200 border-r border-indigo-300 rounded-md animate-pulse custom-scrollbar">
                    <div class="h-8 mb-2 bg-gray-300 rounded-md animate-pulse">

                    </div>
                    <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-3">
                        <div class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                        <div class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                        <div class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                    </div>

                </div>
            </div>
        </div>


        <div x-cloak x-show="!isLoading" class="flex flex-wrap w-full p-6 mx-auto ">
            <div class="w-full text-xl leading-normal text-gray-800 lg:w-1/5 lg:px-2">



                <div x-bind:class="showFilters ? 'fixed inset-0  top-0  bottom-0  dark:bg-gray-800 bg-white z-50 p-4 transition-all duration-200 w-full' : 'hidden w-full h-64 mt-0  md:top-[6rem] sticky inset-0 z-20'"
                    class="overflow-x-hidden overflow-y-auto border border-gray-400 rounded-md shadow md:h-64 lg:h-auto lg:block lg:border-transparent lg:shadow-none lg:bg-transparent custom-scrollbar"
                    id="menu-content">

                    <nav>
                        <!-- Filtres -->
                        <div x-data=" toggleAccordion()"
                            class="w-full p-4 overflow-y-auto bg-white rounded-lg custom-scrollbar dark:bg-gray-800">
                            <h3 class="mb-6 font-bold text-gray-700 dark:text-gray-100">Filtres</h3>
                            <div class="mt-4 mb-4 border-t py-2.5 border-b relative border-gray-400 ">
                                <button @click="setCategory()"
                                    class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                    <span class="text-base dark:text-gray-100"> Catégorie</span>
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
                                <div x-bind:class="showCategoryFilter ?'flex relative w-full p-1 mt-2':'hidden'"  class="">




                                    <x-select wire:model.live.debounce.100ms="category" placeholder="Compentences"
                                        :async-data="route('api.services')" option-label="name" option-value="name" />
                                </div>
                            </div>

                            <div class="py-3 mb-4 border-b border-gray-400">
                                <button x-on:click="setSpecialite()"
                                    class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 dark:text-gray-100 focus:outline-none">
                                    <span class="text-base dark:text-gray-100">Specialite</span>
                                    <svg x-show="!Specialite" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                    </svg>
                                    <svg x-show="Specialite" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                    </svg>
                                </button>
                                <div  x-bind:class="Specialite ?'flex relative w-full p-1 mt-2':'hidden'" class="p-1 mt-2">

                                     <x-select searchable wire:model.live.debounce.100ms='sub_category' placeholder="Specialite">
                                        @forelse($subcategories as $specialite)

                                        <x-select.option label="{{$specialite->name}}" value="{{$specialite->name}}" />

                                        @empty
                                        @endforelse

                                    </x-select>



                                </div>
                            </div>


                            <div class="py-3 mb-4 border-b border-gray-400">
                                <button x-on:click="setExperience()"
                                    class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 dark:text-gray-100 focus:outline-none">
                                    <span class="text-base dark:text-gray-100">Experience</span>
                                    <svg x-show="!Experience" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                    </svg>
                                    <svg x-show="Experience" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                    </svg>
                                </button>
                                <div x-collapse x-show="Experience" class="mt-2">


                                    <x-radio label="0-2 Ans" id="radio" value="0-2" wire:model.live.debounce.300ms="experience" />
                                    <x-radio label="2-7 Ans" id="radio" value="2-7" wire:model.live.debounce.300ms="experience" />
                                    <x-radio label="7 + Ans" id="radio" value="7-20" wire:model.live.debounce.300ms="experience" />

                                  {{--  <select wire:model.live.debounce.300ms='experience'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Choisir l'experience</option>



                                        <option value="0-2 ans">0-2 Ans</option>
                                        <option value="2-7 ans">2-7 Ans</option>
                                        <option value="+ 7 ans">7 + Ans</option>


                                    </select>--}}

                                </div>
                            </div>


                            <div class="py-3 mb-4 border-b border-gray-400">
                                <button x-on:click="setPrice()"
                                    class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                    <span class="text-base dark:text-gray-100">Taux Journalier</span>
                                    <svg x-show="!showAvaible" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                    </svg>
                                    <svg x-show="showAvaible" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                    </svg>
                                </button>
                                <div x-collapse x-show="showPriceFilter" class="mt-2">
                                    <fieldset x-data="{message:'10'}" class="space-y-1 sm:w-48 dark:text-gray-100">
                                        <input type="range" x-model="message" wire:model.live.debounce.300ms="taux"
                                            class="w-full accent-violet-400" min="10" max="10000">
                                        <div aria-hidden="true" class="flex justify-between px-1">
                                            <span>10$</span>

                                            <span x-text="message">$</span>

                                        </div>
                                    </fieldset>


                                </div>
                            </div>

                            <div class="py-3 mb-4 border-gray-400">
                                <button x-on:click="setAvaible()"
                                    class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                    <span class="text-base dark:text-gray-100">Disponibilite</span>
                                    <svg x-show="!showAvaible" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M5.293 6.293a1 1 0 011.414 0L10 9.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" />
                                    </svg>
                                    <svg x-show="showAvaible" class="w-4 h-4 fill-current"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M14.293 15.293a1 1 0 01-1.414 0L10 12.414l-2.293 2.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                    </svg>
                                </button>
                                <div x-collapse x-show="showAvaible" class="mt-2">

                                    {{--
                                    <x-radio label="Temps partiel" id="radio" value="Temps partiel"
                                        wire:model.debounce.500ms="disponibilite" />
                                    <x-radio label="Temps plein" id="radio" value="Temps plein"
                                        wire:model.debounce.500ms="disponibilite" />--}}

                                </div>
                            </div>

                        </div>





                        <div class="flex justify-between w-full md:hidden ">


                             <x-button x-on:click="showFilters=!showFilters" label="appliquer"></x-button>

                            <x-button x-on:click="showFilters=!showFilters" label="Fermer"></x-button>-

                        </div>


                    </nav>
                </div>


            </div>

            <div class="w-full px-2 mt-4 leading-normal text-gray-900 px-auto md:px-0 lg:w-4/5 lg:mt-0 border-rounded">
                <!--Title-->

                <header id="" class="p-2 border-gray-300 ">
                    <div class="px-2 ">

                        <div x-data="{open:false}" class="">
                            <!-- search example -->

                            <div class="relative">
                                {{--<x-input wire:model.debounce.600ms="query"
                                    class="w-3/4 py-3 rounded-full focus:border-amber-600" placeholder="Serach">
                                    <x-slot name="append">
                                        <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                                            <x-button class="h-full rounded-r-md" icon="search" amber squared />
                                        </div>
                                    </x-slot>
                                </x-input>--}}

                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="search" id="default-search" wire:model.live.debounce.300ms="query"
                                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-amber-500 focus:border-amber-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500"
                                        placeholder="Recherche competences, Nom..." required>
                                    <button type="submit"
                                        class="text-white absolute right-2.5 bottom-2.5 bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:outline-none focus:ring-amber-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-amber-600 dark:hover:bg-amber-700 dark:focus:ring-amber-800">Search</button>
                                </div>

                                <!-- search result -->

                                <!-- end search result -->
                            </div>


                        </div>
                    </div>
                    <div class="flex flex-wrap justify-between mt-4 ">

                        <div class='flex flex-wrap gap-2'>
                            @empty(!$query)
                            <div class="flex items-center gap-1 flex-nowrap">

                                <span
                                    class=" items-center py-1 pl-2 pr-0.5 rounded-md text-[12px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    <span style="" class="">{{$query}} </span>
                                    <button
                                        class="flex items-center justify-center w-4 h-4 shrink-0 text-secondary-400 hover:text-secondary-500"
                                        wire:click="unselect('query')" type="button">
                                        <ion-icon wire:ignore name="close-circle-outline" class="w-4 h-4"></ion-icon>

                                    </button>
                                </span>

                            </div>
                            @endempty
                            @empty(!$category)
                            <div class="flex items-center gap-1 flex-nowrap">

                                <span
                                    class=" items-center py-1 pl-2 pr-0.5 rounded-md text-[12px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    <span style="" class="">{{$category}} </span>
                                    <button
                                        class="flex items-center justify-center w-4 h-4 shrink-0 text-secondary-400 hover:text-secondary-500"
                                        wire:click="unselect('category')" type="button">
                                        <ion-icon wire:ignore name="close-circle-outline" class="w-4 h-4"></ion-icon>

                                    </button>
                                </span>

                            </div>
                            @endempty
                            @empty(!$sub_category)
                            <div class="flex items-center gap-1 flex-nowrap">

                                <span
                                    class=" items-center py-1 pl-2 pr-0.5 rounded-md text-[12px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    <span style="" class="">{{$sub_category}} </span>
                                    <button
                                        class="flex items-center justify-center w-4 h-4 shrink-0 text-secondary-400 hover:text-secondary-500"
                                        wire:click="unselect('sub_category')" type="button">
                                        <ion-icon wire:ignore name="close-circle-outline" class="w-4 h-4"></ion-icon>

                                    </button>
                                </span>

                            </div>
                            @endempty
                            @empty(!$experience)
                            <div class="flex items-center gap-1 flex-nowrap">

                                <span
                                    class="inline-flex items-center py-1 pl-2 pr-0.5 rounded-full text-[12px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    <span style="max-width: 6rem" class="truncate">{{$experience}} Ans </span>
                                    <button
                                        class="flex items-center justify-center w-4 h-4 shrink-0 text-secondary-400 hover:text-secondary-500"
                                        wire:click="unselect('experience')" type="button">
                                        <ion-icon wire:ignore name="close-circle-outline" class="w-4 h-4"></ion-icon>

                                    </button>
                                </span>

                            </div>
                            @endempty
                            @empty(!$taux)
                            <div class="flex items-center gap-1 flex-nowrap">

                                <span
                                    class="inline-flex items-center py-1 pl-2 pr-0.5 rounded-full text-[12px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                                    <span style="max-width: 6rem" class="truncate">10 a {{$taux}} $</span>
                                    <button
                                        class="flex items-center justify-center w-4 h-4 shrink-0 text-secondary-400 hover:text-secondary-500"
                                        wire:click="unselect('taux')" type="button">
                                        <ion-icon wire:ignore name="close-circle-outline" class="w-4 h-4"></ion-icon>

                                    </button>
                                </span>

                            </div>
                            @endempty
                        </div>


                        <div class="flex justify-between lg:flex-nowrap">
                            <button @click="showFilters=!showFilters"
                                class="inline-flex md:hidden  px-2  py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm16 5a1 1 0 01-1 1H2a1 1 0 010-2h16a1 1 0 011 1zm-2 5a1 1 0 01-1 1H6a1 1 0 110-2h10a1 1 0 011 1z"
                                        clip-rule="evenodd"></path>
                                </svg>

                            </button>





                        </div>


                    </div>
                </header>



                <div class="grid grid-cols-1 gap-8 md:mx-auto md:px-2 lg:grid-cols-3 md:grid-cols-2">



                    @forelse($freelances as $freelance)



                            <livewire:web.card.freelance-card :$freelance :key="$freelance->id" />









                    @empty
                    <h1 class="text-lg text-gray-800 md:text-2xl">Pas de Resultat</h1>

                    @endforelse
                    <div wire:loading wire:target="query" class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                    <div wire:loading wire:target="query" class="h-64 bg-gray-300 rounded-md animate-pulse"></div>
                    <div wire:loading wire:target="query" class="h-64 bg-gray-300 rounded-md animate-pulse"></div>


                </div>

                <div class="mt-4">

                    {{$freelances->links()}}
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
            function toggleAccordion() {
            return {
              open: false,
              showCategoryFilter:false,
              Langue:false,
              isOpen: false,


              showPriceFilter:false,
              Experience:false,
              SousCategorie:false,
              showAvaible:false,
              Specialite:false,
              setLangue(){
                this.Langue=!this.Langue
              },
              setSpecialite(){
                this.Specialite=!this.Specialite
              },
              setExperience(){
                this.Experience = !this.Experience
              },
              setAvaible (){
        this.showAvaible = !this.showAvaible
              },
              setSousCategorie(){
        this.SousCategorie = !this.SousCategorie
              },
              setCategory(){
                this.showCategoryFilter = !this.showCategoryFilter
              },
              setPrice(){
            this.showPriceFilter = !this.showPriceFilter
            },
              toggle() {
                this.open = !this.open
              }
            }
          }


        // Récupérer l'élément div
        var fixedDiv = document.getElementById("fixed-div");

        var fixedNav= document.getElementById('fixed-nav');

        // Récupérer la position de l'élément div par rapport au haut de la page
     ///   var divOffsetTop = fixedDiv.offsetTop;



        // Ajouter un événement de défilement à la fenêtre

    </script>


</div>
