<div class="">
    <div x-data="{isOpen : false}" class="min-h-screen lg:py-4 md:px-8">

<div class="px-2">
    @include('include.bread-cumb',['category'=>'cagegory','categoryName'=>$categoryName])
</div>

        <div class="container px-4 ">
            <h2 class="mb-4 text-lg font-bold text-gray-600 md:text-2xl dark:text-gray-400">Recherche de
                Services
                "{{$categoryName}}" ({{$count}}) </h2>

        </div>
        <div>
            <div x-bind:class="isOpen ? 'fixed inset-0  top-0  bottom-0  overflow-hidden dark:bg-gray-900 bg-white z-50 p-4 transition-all duration-200 w-full' : 'w-full hidden md:flex mt-0'"
                class="">
                <div class="container px-4 mx-auto">

                    <div class="mb-8">
                        <div class="grid -mx-2 md:grid-cols-4">
                            <div class="w-full px-2 mb-4">
                        <x-select placeholder="sous categories"  wire:model.live.debounce.100ms="sous_category">

                        @forelse($subCategorie as $subCategory)
                        <x-select.option label="{{$subCategory->name}}" value="{{$subCategory->name}}" />
                        @empty
                        <x-select.option label="empty" value="" />
                        @endforelse


                            </x-select>

                            </div>


                            <div class="w-full px-2 mb-4">


                                <x-select  placeholder="Temps de livraison" wire:model.live.debounce.100ms="delivery_time"
                                    :options="['1-5'=>'1-5 jours',
                                                '5-10'=>'5-10 jours',
                                                '10-50'=>'plus de 10 jours',

                                                ]" />

                            </div>
                            <div class="w-full px-2 mb-4">



                                <x-select class="!dark:bg-gray-900" placeholder="Niveau du Freelance" wire:model.live.debounce.100ms="freelance_niveau" :options="['1'=>'niveau 1',
                                                                    '2'=>'niveau 2',
                                                                    '3'=>'niveau 3',
                                                                    '4'=>'niveau 4',
                                                                    '5'=>'niveau 5'

                                                                    ]" />


                            </div>
                            <div class="flex w-full gap-2 px-2 mb-4">

                                <x-select placeholder="Prix" wire:model.live.debounce.100ms="price_range"
                                :options="[
                                '1'=>'10$-50$',
                                '2'=>'50$-100$',
                                '3'=>'100$ +',
                                ]" />


                               {{-- <select wire:model.live.debounce.300ms='price_range'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Choisir le prix</option>



                                    <option value="1">10$-50$</option>
                                    <option value="2">50$-100$</option>
                                    <option value="3">100$ +</option>


                                </select>}}
                                {{--<x-select wire:model.debounce.100ms="orderBy" placeholder="trier par">
                                    <x-select.option label="Prix" value="basic_price" />
                                    <x-select.option label="Delai" value="basic_delivery_time" />
                                    <x-select.option label="Niveau" value="basic_delivery_time" />
                                </x-select>----}}
                            </div>


                        </div>
                        <div class="flex gap-4 md:hidden">

                            <button x-on:click="isOpen=!isOpen"
                                class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                                Resultat ({{$count}})
                            </button>

                            <x-button @click="isOpen=false" label="Fermer" />




                            {{--
                            <x-button label="Resultat ({{$count}})" @click="isOpen=false" />
                       --}}

                        </div>
                    </div>
                </div>

            </div>


            <button @click="isOpen=!isOpen"
                class="flex pl-3 no-underline dark:text-white md:hidden hover:text-amber-600" href="#">
                <svg class="w-6 fill-current hover:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                </svg> <span>
                    filtre
                </span>
            </button>

        </div>
        <div class="py-2 dark:text-gray-100">
            <div class="container p-6 mx-auto space-y-8 bg-gray-100 dark:bg-gray-800">

                <div class="grid grid-cols-1 gap-x-4 gap-y-8 md:grid-cols-4 lg:grid-cols-4">
                    @forelse ($services as $service)

                    @livewire('web.card.service-card',['service' => $service], key($service->id))
                    @empty
                    <div class="px-6">
                        <div>
                            <h3>Pas de resultat</h3>
                        </div>

                    </div>
                    @endforelse



                </div>


            </div>

            <div>
                {{$services->links()}}
            </div>
        </div>

    </div>
</div>
