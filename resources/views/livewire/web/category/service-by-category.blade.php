<div class="pt-20">
    <div x-data="{isOpen:false}" class="min-h-screen lg:py-8 md:px-8">

        <div class="px-2">

        </div>


        <div class="container px-4 ">
            <h2 class="mb-4 text-lg font-bold text-gray-600 md:text-2xl dark:text-gray-400">Recherche de
                Services
                "{{$categoryName}}" ({{$count}}) </h2>

        </div>
        <div>

            <div class="hidden w-full p-5 bg-white rounded-lg shadow ">
                <div class="relative">
                    <div class="absolute flex items-center h-full ml-2">
                        <svg class="w-4 h-4 fill-current text-primary-gray-dark" viewBox="0 0 16 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z">
                            </path>
                        </svg>
                    </div>

                    <input type="text" placeholder="Search by listing, location, bedroom number..."
                        class="w-full px-8 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                </div>

                <div class="flex items-center justify-between mt-4">
                    <p class="font-medium">
                        Filters
                    </p>

                    <button
                        class="px-4 py-2 text-sm font-medium text-gray-800 bg-gray-100 rounded-md hover:bg-gray-200">
                        Reset Filter
                    </button>
                </div>

                <div class="">
                    <div class="grid grid-cols-2 gap-4 mt-4 md:grid-cols-3 xl:grid-cols-4">
                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">All Type</option>
                            <option value="for-rent">For Rent</option>
                            <option value="for-sale">For Sale</option>
                        </select>

                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">Furnish Type</option>
                            <option value="fully-furnished">Fully Furnished</option>
                            <option value="partially-furnished">Partially Furnished</option>
                            <option value="not-furnished">Not Furnished</option>
                        </select>

                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">Any Price</option>
                            <option value="1000">RM 1000</option>
                            <option value="2000">RM 2000</option>
                            <option value="3000">RM 3000</option>
                            <option value="4000">RM 4000</option>
                        </select>

                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">Floor Area</option>
                            <option value="200">200 sq.ft</option>
                            <option value="400">400 sq.ft</option>
                            <option value="600">600 sq.ft</option>
                            <option value="800 sq.ft">800</option>
                            <option value="1000 sq.ft">1000</option>
                            <option value="1200 sq.ft">1200</option>
                        </select>

                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">Bedrooms</option>
                            <option value="1">1 bedroom</option>
                            <option value="2">2 bedrooms</option>
                            <option value="3">3 bedrooms</option>
                            <option value="4">4 bedrooms</option>
                            <option value="5">5 bedrooms</option>
                        </select>

                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">Bathrooms</option>
                            <option value="1">1 bathroom</option>
                            <option value="2">2 bathrooms</option>
                            <option value="3">3 bathrooms</option>
                            <option value="4">4 bathrooms</option>
                            <option value="5">5 bathrooms</option>
                        </select>

                        <select
                            class="w-full px-4 py-3 text-sm bg-gray-100 border-transparent rounded-md focus:border-gray-500 focus:bg-white focus:ring-0">
                            <option value="">Bathrooms</option>
                            <option value="1">1 space</option>
                            <option value="2">2 space</option>
                            <option value="3">3 space</option>
                        </select>
                    </div>
                </div>
            </div>


            <div x-bind:class="isOpen ? 'fixed inset-0  top-0  bottom-0 hidden overflow-hidden dark:bg-gray-900 bg-white z-50 p-4 transition-all duration-200 w-full' : 'w-full hidden md:flex mt-0'"
                class="">
                <div class="container px-4 mx-auto">

                    <div class="mb-8">
                        <div class="grid -mx-2 md:grid-cols-4">
                            <div class="w-full px-2 mb-4">

                                <select wire:model.live.debounce.300ms='sous_category'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Sous categorie</option>



                                    @forelse($subCategorie as $subCategory)


                                    <option value="{{$subCategory->name}}">{{$subCategory->name}}</option>
                                    @empty

                                    @endforelse


                                </select>


                            </div>


                            <div class="w-full px-2 mb-4">

                                <select wire:model.live.debounce.300ms='delivery_time'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Temps livraison</option>



                                    <option value="1-5">1-5 jours</option>
                                    <option value="5-10">5-10 jours</option>
                                    <option value="10-50">10+ jour</option>


                                </select>

                            </div>
                            <div class="w-full px-2 mb-4">
                                {{--
                                <x-select placeholder="Niveau du Freelance" wire:model.debounce.200ms="freelance_niveau"
                                    :options="['basic'=>'basic',
                                    'premium'=>'premium',
                                    'extra'=>'extra']" />--}}

                                <select wire:model.live.debounce.300ms='freelance_niveau'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="0" selected>Niveau freelance</option>



                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>


                                </select>


                            </div>
                            <div class="flex w-full gap-2 px-2 mb-4">
                                {{--
                                <x-select placeholder="Prix" wire:model.debounce.100ms="price_range" :options="[
                                '1'=>'10$-50$',
                                '2'=>'50$-100$',
                                '3'=>'100$ +',

                                ]" />--}}

                                <select wire:model.live.debounce.300ms='price_range'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="" selected>Choisir le prix</option>



                                    <option value="1">10$-50$</option>
                                    <option value="2">50$-100$</option>
                                    <option value="3">100$ +</option>


                                </select>
                                {{--<x-select wire:model.debounce.100ms="orderBy" placeholder="trier par">
                                    <x-select.option label="Prix" value="basic_price" />
                                    <x-select.option label="Delai" value="basic_delivery_time" />
                                    <x-select.option label="Niveau" value="basic_delivery_time" />
                                </x-select>--}}
                            </div>


                        </div>
                        <div class="flex gap-4 md:hidden">

                            <button x-on:click="isOpen=!isOpen"
                                class="middle none center mr-4 rounded-lg bg-blue-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-light="true">
                                Resultat ({{$count}})
                            </button>

                            <button x-on:click="isOpen=!isOpen"
                                class="middle none center mr-3 rounded-lg border border-pink-500 py-3 px-6 font-sans text-xs font-bold uppercase text-pink-500 transition-all hover:opacity-75 focus:ring focus:ring-pink-200 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                data-ripple-dark="true">
                                Fermer
                            </button>
                            {{--
                            <x-button label="Resultat ({{$count}})" @click="isOpen=false" />
                            <x-button @click="isOpen=false" label="Fermer" />--}}

                        </div>
                    </div>
                </div>

            </div>


            <button x-on:click="isOpen=!isOpen"
                class="flex pl-3 no-underline dark:text-white md:hidden hover:text-amber-600" href="#">
                <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                </svg> <span>
                    filtre
                </span>
            </button>

        </div>



        <div class="py-2 dark:text-gray-100">
            <div class="container p-6 mx-auto space-y-8 bg-gray-100 dark:bg-gray-800">

                <div class="grid grid-cols-1 gap-x-4 gap-y-8 md:grid-cols-4 lg:grid-cols-5">
                    @forelse ($services as $service)

                    @livewire('web.card.service-card',['service' => $service], key($service->id))
                    @empty
                    <div class="px-6">
                        <div>
                            <h3>Pas de services trouveeer</h3>
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
