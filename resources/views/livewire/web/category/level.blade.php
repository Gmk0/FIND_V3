{{--@if(!empty($service->premium_support) &&
!empty($service->premium_price) &&
!empty($service->premium_delivery_time))
<div class="py-5 min-h-72">

    <div class="py-1 dark:bg-gray-900">
        <div class="container px-4 mx-auto">
            <h2 class="mb-4 text-2xl font-semibold text-gray-800">Comparaison de Support</h2>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <!-- Basic -->
                <div class="p-6 bg-white shadow-md rounded-xl">
                    <div class="flex items-center justify-center mb-4">

                        <h3 class="text-xl font-semibold text-gray-800">Basic</h3>
                    </div>
                    <ul class="text-gray-700">

                        @foreach ($service->basic_support as $key=>$value)

                        <li class="flex items-center mb-2">
                            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>

                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                        </li>
                        @endforeach







                        <li class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-gray-400 dark:text-gray-200">Delai :
                                {{$service->basic_delivery_time}}-{{$service->delivery_time_unit?$service->delivery_time_unit:'jours'}}</span>
                        </li>


                    </ul>
                    <div class="mt-auto">
                        <span class="text-2xl font-semibold text-gray-800">{{$service->basic_price}}
                            $</span>
                    </div>
                    <button type="button" wire:click="addBasic()"
                        class="flex items-center justify-center w-full gap-1 px-5 py-2 mt-4 text-base font-medium text-white bg-indigo-600 border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Choisir</button>
                </div>

                <!-- Extra -->


                @if(!empty($service->extra_support) &&
                !empty($service->extra_price) &&
                !empty($service->extra_delivery_time))
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.732 4.732l14.536 14.536M19.268 4.732L4.732 19.268" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Extra</h3>
                    </div>
                    <ul class="text-gray-700">
                        @foreach ($service->basic_support as $key=>$value)

                        <li class="flex items-center mb-2">
                            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>

                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                        </li>
                        @endforeach
                        @if(!empty($service->premium_support) &&
                        !empty($service->premium_price) &&
                        !empty($service->premium_delivery_time))
                        @forelse ($service->premium_support as $key=>$value)

                        <li class="flex items-center mb-2">
                            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>


                        </li>
                        @empty
                        @endforelse
                        @endif

                        @if(!empty($service->extra_support) &&
                        !empty($service->extra_price) &&
                        !empty($service->extra_delivery_time))
                        @forelse ($service->extra_support as $key=>$value)

                        <li class="flex items-center mb-2">
                            <svg fill="#f00000" class="w-4 h-6 mr-2" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 512 512" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="M437.016,74.984c-99.979-99.979-262.075-99.979-362.033,0.002c-99.978,99.978-99.978,262.073,0.004,362.031 c99.954,99.978,262.05,99.978,362.029-0.002C536.995,337.059,536.995,174.964,437.016,74.984z M406.848,406.844 c-83.318,83.318-218.396,83.318-301.691,0.004c-83.318-83.299-83.318-218.377-0.002-301.693 c83.297-83.317,218.375-83.317,301.691,0S490.162,323.549,406.848,406.844z">
                                                </path>
                                                <path
                                                    d="M361.592,150.408c-8.331-8.331-21.839-8.331-30.17,0l-75.425,75.425l-75.425-75.425c-8.331-8.331-21.839-8.331-30.17,0 s-8.331,21.839,0,30.17l75.425,75.425L150.43,331.4c-8.331,8.331-8.331,21.839,0,30.17c8.331,8.331,21.839,8.331,30.17,0 l75.397-75.397l75.419,75.419c8.331,8.331,21.839,8.331,30.17,0c8.331-8.331,8.331-21.839,0-30.17l-75.419-75.419l75.425-75.425 C369.923,172.247,369.923,158.74,361.592,150.408z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>

                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                        </li>
                        @empty
                        @endforelse

                        @endif
                        <li class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-gray-400 dark:text-gray-200">Delai :
                                {{$service->premium_delivery_time}} jours</span>
                        </li>


                    </ul>
                    <div class="mt-6">
                        <span class="text-2xl font-semibold text-gray-800">{{$service->premium_price}}
                            $</span>
                    </div>
                    <button type="button" wire:click="addPremium()"
                        class="flex items-center justify-center w-full gap-1 px-5 py-2 mt-4 text-base font-medium text-white bg-indigo-600 border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Choisir</button>
                </div>

                @endif

                <!-- Premium -->

                @if(!empty($service->premium_support) &&
                !empty($service->premium_price) &&
                !empty($service->premium_delivery_time))
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.732 4.732l14.536 14.536M19.268 4.732L4.732 19.268" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-800">Premium</h3>
                    </div>
                    <ul class="text-gray-700">
                        @foreach ($service->basic_support as $key=>$value)

                        <li class="flex items-center mb-2">
                            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>

                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                        </li>
                        @endforeach
                        @forelse ($service->premium_support as $key=>$value)

                        <li class="flex items-center mb-2">
                            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>


                        </li>

                        @empty

                        @endforelse
                        @forelse ($service->extra_support as $key=>$value)

                        <li class="flex items-center mb-2">

                            <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                            </svg>
                            <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                        </li>
                        @empty
                        @endforelse




                        <li class="flex items-center mb-2">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            <span class="text-gray-400 dark:text-gray-200">Delai :
                                {{$service->extra_delivery_time}} jours</span>
                        </li>


                    </ul>
                    <div class="mt-6">
                        <span class="text-2xl font-semibold text-gray-800">{{$service->extra_price}}
                            $</span>
                    </div>
                    <button type="button" wire:click="addExtra()"
                        class="flex items-center justify-center w-full gap-1 px-5 py-2 mt-4 text-base font-medium text-white bg-indigo-600 border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Choisir</button>
                </div>

                @endif
            </div>
        </div>
    </div>

</div>

@endif--}}



<div class="w-full">
    <div class="mx-auto overflow-x-auto">
        <div class="overflow-hidden border rounded-lg shadow-md md:border-none">

            <div class="divide-y divide-gray-200">
                <!-- Mobile View -->
                <div class="block md:hidden">
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-200">
                        <span class="text-sm font-semibold tracking-wider uppercase">Basic</span>
                       <x-button label="Choisir" spinner="addExtra" wire:click="addExtra()" slate />
                    </div>

                    <div class="px-4 py-3">
                        <div class="flex gap-4">
                            <span class="text-base">Prix: </span>

                            <span class="text-base font-bold">{{$service->basic_price}} $</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Temps de livraison :</span>

                            <span class="text-base font-medium text-gray-600">{{$service->basic_delivery_time}} Jours</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Revisions:</span>

                            <span class="text-base font-medium text-gray-600">{{$service->basic_revision}}</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Support:</span>

                            <p>

                                    @foreach ($service->basic_support as $key=>$value)
                                    <span class="mb-2">
                                        <span class="font-medium text-gray-600 dark:text-gray-200">{{$value}}</span>
                                    </span> ;
                                    @endforeach

                            </p>
                        </div>
                    </div>
                </div>
                <div class="block md:hidden">
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-200">
                        <span class="text-sm font-semibold tracking-wider uppercase">Standard</span>
                       <x-button label="Choisir" spinner="addExtra" wire:click="addPremium()" slate />
                    </div>
                   <div class="px-4 py-3">
                        <div class="flex gap-4">
                            <span class="text-base">Prix: </span>

                            <span class="text-base font-bold">{{$service->premium_price}} $</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Temps de livraison :</span>

                            <span class="text-base font-medium text-gray-600">{{$service->premium_delivery_time}} Jours</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Revisions:</span>

                            <span class="text-base font-medium text-gray-600">{{$service->premium_revision}}</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Support:</span>

                            @if(!empty($service->premium_support))
                            <p>

                                @forelse ($service->premium_support as $key=>$value)
                                <span class="mb-2">
                                    <span class="font-medium text-gray-600 dark:text-gray-200">{{$value}}</span>
                                </span> ;

                                @empty

                                @endforelse

                            </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="block md:hidden">
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-200">
                        <span class="text-sm font-semibold tracking-wider uppercase">Premium</span>
                     <x-button label="Choisir" spinner="addExtra" wire:click="addExtra()" slate />
                    </div>
                   <div class="px-4 py-3">
                        <div class="flex gap-4">
                            <span class="text-base">Prix: </span>

                            <span class="text-base font-bold">{{$service->extra_price}} $</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Temps de livraison :</span>

                            <span class="text-base font-medium text-gray-600">{{$service->extra_delivery_time}} Jours</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Revisions:</span>

                            <span class="text-base font-medium text-gray-600">{{$service->extra_revision}}</span>
                        </div>
                        <div class="flex gap-4">
                            <span class="text-base">Support:</span>

                            <p>

                                @foreach ($service->extra_support as $key=>$value)
                                <span class="mb-2">
                                    <span class="font-medium text-gray-600 dark:text-gray-200">{{$value}}</span>
                                </span> ;
                                @endforeach

                            </p>
                        </div>
                    </div>
                </div>

                <!-- Desktop View -->
                <div class="w-full p-2 ">
                    <div class="mx-auto overflow-x-auto max-w-7xl">
                        <div class="overflow-hidden rounded-lg shadow-md md:border">
                            <!-- Desktop View -->
                            <div class="hidden w-full md:table">
                                <div class="table-header-group text-gray-700 bg-gray-200">
                                    <div class="table-row">
                                        <div
                                            class="table-cell px-4 py-3 font-semibold tracking-wider text-center uppercase">
                                            Features</div>
                                        <div
                                            class="table-cell px-4 py-3 font-semibold tracking-wider text-center uppercase">
                                            Basic</div>
                                        <div
                                            class="table-cell px-4 py-3 font-semibold tracking-wider text-center uppercase">
                                            Premium</div>
                                        <div
                                            class="table-cell px-4 py-3 font-semibold tracking-wider text-center uppercase">
                                            Extra</div>
                                    </div>
                                </div>
                                <div class="table-row-group">
                                    <div class="table-row">
                                        <div class="table-cell px-4 py-3 text-center">Price</div>
                                        <div class="table-cell px-4 py-3 font-medium text-center">{{$service->basic_price}} $</div>
                                        <div class="table-cell px-4 py-3 font-medium text-center">{{$service->premium_price}} $</div>
                                        <div class="table-cell px-4 py-3 font-medium text-center">{{$service->extra_price}} $</div>
                                    </div>
                                    <div class="table-row divide-y">
                                        <div class="table-cell px-4 py-3 text-center divide-y">Delivery Time</div>
                                      <div class="table-cell px-4 py-3 text-center">{{$service->basic_delivery_time}} Jours</div>
                                        <div class="table-cell px-4 py-3 text-center">{{$service->premium_delivery_time}} Jours</div>
                                        <div class="table-cell px-4 py-3 text-center">{{$service->extra_delivery_time}} Jours</div>
                                    </div>
                                    <div class="table-row divide-y">
                                        <div class="table-cell px-4 py-3 text-center">Revisions</div>
                                        <div class="table-cell px-4 py-3 text-center">{{$service->basic_revision}}</div>
                                        <div class="table-cell px-4 py-3 text-center">{{$service->premium_revision}}</div>
                                        <div class="table-cell px-4 py-3 text-center">{{$service->extra_revision}}</div>
                                    </div>
                                    <div class="table-row divide-y">
                                        <div class="table-cell px-4 py-3 text-center">Support</div>
                                        <div class="table-cell px-4 py-3 text-center">
                                            <ul class="text-center">
                                                @foreach ($service->basic_support as $key=>$value)
                                                <li class="mb-2 text-center">
                                                    <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                                                </li>
                                                @endforeach
                                            </ul>


                                        </div>
                                        <div class="table-cell px-4 py-3 text-center">

                                            <ul>
                                                @foreach ($service->premium_support as $key=>$value)
                                                <li class="mb-2 text-center">
                                                    <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="table-cell px-4 py-3 text-center break-before-auto">
                                           <ul>
                                                @foreach ($service->extra_support as $key=>$value)
                                                <li class="mb-2 text-center">
                                                    <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                                                </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="table-row">
                                        <div class="table-cell px-4 py-3 text-center"></div>
                                        <div class="table-cell px-4 py-3 text-center">
                                            <x-button label="Choisir" spinner="addBasic" wire:click="addBasic()"  slate />
                                        </div>
                                        <div class="table-cell px-4 py-3 text-center">
                                          <x-button label="Choisir" spinner="addPremium" wire:click="addPremium()"  slate />
                                        </div>
                                        <div class="table-cell px-4 py-3 text-center">
                                           <x-button label="Choisir" spinner="addExtra" wire:click="addExtra()"  slate/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
