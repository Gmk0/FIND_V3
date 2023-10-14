<div x-data="{isScroll : false}" @scroll.window="isScroll = (window.pageYOffset > 150) ? true : false" class="min-h-screen pt-16 ">

    <div class="relative flex flex-col pb-8 bg-gray-100 dark:bg-gray-900"
        x-data="{ isOpen:false,showFilters: false,showSearch: false }">



        <div x-cloak x-show="!loading" class="relative h-24 bg-green-600">

            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="text-4xl font-bold text-white">Trouver un freelance</h1>
            </div>
            <div class="absolute inset-0 flex items-center justify-start mx-2">
                @include('include.bread-cumb',['freelance'=>'Freelance'])
            </div>
        </div>

        <div x-show="loading" class="relative w-full bg-gray-300 h-36 animate-pulse">

        </div>

        <div x-cloak x-show="!loading" class="sticky top-0 z-30 grid h-auto grid-cols-12 py-2 bg-white lg:z-0 lg:bg-transparent lg:relative ">
            <div class="hidden lg:col-span-3 lg:flex">

            </div>


            <div class="relative grid col-span-12 gap-4 py-4 lg:grid-cols-12 lg:col-span-9 lg:gap-2 ">
                <div class="px-4 lg:col-span-9">
                    <x-input class="!rounded-full   !shadow-md" wire:model.live.debounce.100ms='query' placeholder="recherche"
                        icon='search' />
                </div>
                <div class="sticky top-0 flex flex-row justify-between gap-2 px-4 lg:col-span-3">

                    <div class="block lg:hidden">

                        <x-button @click="showFilters=!showFilters" label="filtre">

                        </x-button>
                    </div>


                    <div class="flex gap-2">

                        <div>

                        </div>
                        <div class="z-40">
                            <x-native-select placeholder="Trier par" class=" z-30 !rounded-xl !shadow-md"
                                wire:model.live="trie">

                                <option value="">Trier par</option>
                                <option value="level-asc">Niveau ascendant</option>
                                <option  value="level-desc">Niveau Descendant</option>
                                <option  value="populaire-desc">Populaire</option>
                                <option  value="nouveau-desc">Nouveau</option>

                            </x-native-select>

                        </div>


                    </div>


                </div>

            </div>


        </div>




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

        <div x-cloak x-show="!loading" class="grid grid-cols-12 px-2">
            <div class="w-full col-span-3 mt-4 leading-normal text-gray-800 lg:px-2">



                <div x-bind:class="showFilters ? 'fixed inset-0  top-0  bottom-0  dark:bg-gray-800 bg-white z-[600] p-4 transition-all duration-200 w-full' : 'hidden w-full h-auto mt-0  md:top-[6rem]  inset-0 z-20'"
                    class="overflow-x-hidden overflow-y-auto border border-gray-400 rounded-md shadow lg:h-auto lg:block lg:border-transparent lg:shadow-none lg:bg-transparent custom-scrollbar"
                    id="menu-content">

                    <nav class="overflow-y-auto">
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




                                    <x-select class="w-full" wire:model.live.debounce.100ms="category" placeholder="Compentences"
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

                                     <x-select class="w-full" searchable wire:model.live.debounce.100ms='sub_category' placeholder="Specialite">
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
                                    <fieldset x-data="{message:'10'}" class="w-full space-y-1 dark:text-gray-100">
                                        <input type="range" x-model="message" wire:model.live.debounce.100ms="taux" class="w-full accent-amber-400"
                                            min="10" max="10000">

                                        <div aria-hidden="true" class="flex justify-between px-1">

                                            <div class="flex gap-4 p-2 border ">
                                                <span>10$</span>

                                                <span class="flex">

                                                    <span x-text="message"></span>
                                                    <span>$</span>
                                                </span>
                                            </div>
                                            @if(!empty($taux))
                                            <div>
                                                <x-button @click="message='10'" wire:click='PriceRest' sm label='annuler' />
                                            </div>
                                            @endif



                                        </div>
                                    </fieldset>


                                </div>
                            </div>

                           <div x-data="{showCategoryFilter:false}" class="relative py-3 mt-4 mb-4 border-gray-400 ">
                            <button @click="showCategoryFilter=!showCategoryFilter"
                                class="flex items-center justify-between w-full mb-2 font-bold text-gray-700 focus:outline-none">
                                <span class="text-base dark:text-gray-100">Disponibilte</span>
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
                                    <x-checkbox wire:click="onLine('online')" value="0" label='En ligne ({{$nowOnline}})' />

                                </div>
                            </div>
                        </div>

                            <div x-data="{showCategoryFilter:false}" class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
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

                                        <x-checkbox wire:click='level(1)' value="1" label='Nouveau' />
                                        <x-checkbox wire:click='level(2)' value="2" label='Niveau 2' />
                                        <x-checkbox wire:click='level(3)' value="3" label='Niveau 3' />
                                        <x-checkbox wire:click='level(4)' value="4" label='Niveau 4' />
                                        <x-checkbox wire:click='level(5)' value="5" label='Top seller' />


                                    </div>
                                </div>
                            </div>


                            <div x-data="{showCategoryFilter:false}" class="relative py-3 mt-4 mb-4 border-t border-gray-400 ">
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

                                    <x-select class="w-full" wire:model.live.debounce.100ms="localisation" placeholder="Ville"
                                        :async-data="route('api.city')" option-label="ville" option-value="id" />
                                </div>
                            </div>

                        </div>





                        <div class="flex w-full gap-4 md:hidden ">


                             <x-button amber x-on:click="showFilters=!showFilters" label="appliquer"></x-button>

                            <x-button x-on:click="showFilters=!showFilters" label="Fermer"></x-button>-

                        </div>


                    </nav>
                </div>


            </div>

            <div class="col-span-12 pt-2 lg:col-span-9">
                <!--Title-->

                <div class="px-4 py-4">
                    @if($count = $this->countFiltersApplied())
                    <div class="flex items-center gap-4 p-2 mb-4 rounded">

                        <span class="text-sm text-amber-600">Filtres appliqués : {{ $count }}</span>


                        <x-button.circle icon="x" wire:click='resetAll' />
                    </div>
                    @endif


                    <div class="hidden ">
                        {{$freelances->links()}}

                    </div>


                </div>




                <div class="z-0 grid gap-6 p-2 md:grid-cols-2 lg:grid-cols-3">

                    @forelse($freelances as $freelance)
                    <div wire:key='{{$freelance->id}}' class="mx-auto lg:mx-0 w-[80%]">
                        @livewire('web.card.freelance-card',['freelance' => $freelance], key($freelance->id))
                    </div>


                    @empty
                    <h1 class="text-lg text-gray-800 md:text-2xl">Pas de Resultat</h1>

                    @endforelse

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
                top: 30,
                left: 30,
                behaviour: 'smooth'
                })

            });
            function toggleAccordion() {
            return {
              open: false,
              showCategoryFilter:true,
              Langue:false,
              isOpen: false,


              showPriceFilter:true,
              Experience:false,
              SousCategorie:false,
              showAvaible:false,
              Specialite:true,
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



    </script>


</div>
