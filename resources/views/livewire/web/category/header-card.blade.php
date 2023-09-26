<div class="flex-col mx-2 mb-4 md:flex md:order-2 md:mb-0 md:w-1/3">
    <div style="top:8rem; position:sticky;" class="flex flex-col gap-2 px-2 pt-2 card-sticky ">


        <div style="top:8rem; position:sticky;" class="sticky p-2 bg-white shadow-lg dark:bg-gray-800">
            <div class=" sm:col-span-8 lg:col-span-7">
                <h2 class="flex text-2xl font-bold text-gray-800 truncate lg:hidden dark:text-gray-300 sm:pr-12">
                    {{$service->title}}</h2>

                <section aria-labelledby="information-heading" class="mt-1 ">
                    <h3 id="information-heading" class="sr-only">Product information</h3>
                    <div class="flex justify-between my-3">
                        <h4 class="sr-only">Reviews</h4>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-yellow-500 fill-current"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M10 14.155L4.284 17.84l.828-5.076L.898 7.865l5.059-.736L10 2l2.043 5.129 5.059.736-3.215 3.9.828 5.076z" />
                                </svg>

                                <span
                                    class="text-sm font-semibold text-gray-700 dark:text-gray-100">({{$service->averageFeedback()}})
                                </span>
                            </div>

                            <p class="sr-only">3 out of 5 stars</p>
                            <a href="#"
                                class="ml-3 text-sm font-medium text-amber-600 hover:text-indigo-500">{{$service->orderCount()}}
                                reviews</a>
                        </div>
                        <div class="flex justify-between mt-3">
                            <div x-data="{ like: @json($service->isFavorite()) }" class="flex items-center">
                                <button class="flex gap-1 mr-2" x-on:click="like=!like"
                                    @click="$wire.toogleFavorite({{$service->id}})">


                                    <span x-cloak x-show="!like" class="">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>

                                    </span>
                                    <span x-cloak x-show="like">
                                        <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </span>


                                </button>



                            </div>
                            <div>
                                <ul x-data="{ input: '{{ route('ServicesViewOne', ['service_numero' => $service->service_numero, 'category' => $service->category->name]) }}' }"
                                    class="z-50 flex gap-2 text-sm ">


                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button type="button" class="flex gap-1 cursor-pointer">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                                </svg>

                                            </button>
                                        </x-slot>

                                        <x-dropdown.item icon="hashtag" label="Facebook" />
                                        <x-dropdown.item @click="$clipboard(input)" icon="clipboard" separator
                                            label="Copier Lien" />

                                    </x-dropdown>




                                </ul>
                            </div>
                        </div>
                    </div>


                    @if (!empty($service->premium_price) && !empty($service->extra_price))

                    <div class="mt-4 mb-3">
                        <ul x-data="{level: @entangle('level').live}"
                            class="flex items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full sm:border-r dark:border-gray-600" @click="level = 'Basic'"
                                :class="level === 'Basic' ? 'border-b-4 border-amber-600' : ''">
                                <button
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 focus:outline-none">
                                    Basic
                                </button>
                            </li>
                            <li class="w-full sm:border-r dark:border-gray-600" @click="level = 'Premium'"
                                :class="level === 'Premium' ? 'border-b-4 border-amber-600' : ''">
                                <button
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 focus:outline-none">
                                    Premium
                                </button>
                            </li>
                            <li class="w-full dark:border-gray-600" @click="level = 'Extra'"
                                :class="level === 'Extra' ? 'border-b-4 border-amber-600' : ''">
                                <button
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300 focus:outline-none">
                                    Extra
                                </button>
                            </li>
                        </ul>
                    </div>
                    @endif

                    <div class="flex justify-between gap-2 px-4 ">
                        <p class="py-2 text-lg text-gray-800">{{$level}} </>
                        <p class="text-lg font-bold text-gray-800">{{$price}} $</p>
                    </div>

                    <div>
                        <div id="" class="mt-4">

                            <div class="px-4">
                                <ul class="flex gap-4">
                                    @if($level==='Basic')

                                    @foreach ($service->basic_support as $key=>$value)
                                    <li>{{$value}}</li>
                                    @endforeach
                                    @elseif ($level==='Premium')

                                    @foreach ($service->premium_support as $key=>$value)
                                    <li>{{$value}}</li>
                                    @endforeach
                                    @else
                                    @foreach ($service->extra_support as $key=>$value)
                                    <li>{{$value}}</li>
                                    @endforeach

                                    @endif

                                </ul>
                            </div>
                        </div>

                    </div>


                </section>

                <section aria-labelledby="options-heading" class="px-4 mt-1">
                    <h3 id="options-heading" class="sr-only">Service options</h3>

                    <div>




                        <div class="flex justify-between mt-4">

                            <p class="flex gap-2 font-medium text-gray-700 dark:text-gray-100">
                                <x-icon class="w-5" name="clock"></x-icon>

                                <span>
                                    @if($level==='Basic')

                                    {{$service->basic_delivery_time}}

                                    @elseif ($level==='Premium')

                                    {{$service->premium_delivery_time}}
                                    @else
                                    {{$service->extra_delivery_time}}

                                    @endif

                                    Jours Delai</span>
                            </p>

                            <p class="flex gap-2 font-medium text-gray-700 dark:text-gray-100">
                                <x-icon class="w-5" name="clock"></x-icon>

                                <span>
                                    @if($level==='Basic')

                                    {{$service->basic_revision}}

                                    @elseif ($level==='Premium')

                                    {{$service->premium_revision}}
                                    @else
                                    {{$service->extra_revision}}

                                    @endif

                                    Revisions</span>

                            </p>

                        </div>

                        <div class="flex">
                            <button wire:click="add_cart()" type="button" id=""
                                class="flex items-center justify-center w-full gap-1 px-8 py-3 mt-4 text-base font-medium text-white bg-indigo-600 border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>

                                <span wire:loading.remove wire:target='add_cart'>Ajouter
                                    au Panier</span>
                                <span wire:loading wire:target='add_cart'>Ajout...
                                </span>
                            </button>
                        </div>






                    </div>
                </section>
            </div>

            <div class="grid w-full gap-2 p-6 bg-white rounded-lg dark:bg-gray-800">



                <x-button x-on:click="contactMe = !contactMe" label="Contacter" success spinner="Contacter" />





            </div>
        </div>


    </div>



</div>
