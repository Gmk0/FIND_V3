@push('style')

<style>
    #support ul {
        list-style-type: disc;
        /* Type de puce */
        padding-left: 20px;
        /* Espacement à gauche */
    }

    #support li {
        margin-bottom: 5px;
        /* Espacement entre chaque élément de la liste */
    }
</style>

@endpush

<div>
    <div class="min-h-screen py-2 bg-gray-100 md:px-8 dark:bg-gray-900"
        x-data="{ isOpen:false,contactMe:false,isLoading: true,showFilters: false,showSearch: false }"
        x-init="setTimeout(() => { isLoading = false }, 3000)">

        <div class="px-2">
            @include('include.bread-cumb',['category'=>'cagegory','categoryName'=>
            \Illuminate\Support\Str::limit($service->category->name,
            10),'ServiceId'=>$service->service_numero])
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

        <div x-show="!isLoading" x-cloak class="container px-4 py-8 mx-auto">


            <div class="flex flex-col md:flex-row md:space-x-8">

                <div class="flex-col mx-2 mb-4 md:flex md:order-2 md:mb-0 md:w-1/3">
                    <div style="top:8rem; position:sticky;" class="flex flex-col gap-2 px-2 pt-2 card-sticky ">


                        <div style="top:8rem; position:sticky;" class="sticky p-2 bg-white shadow-lg dark:bg-gray-800">
                            <div class="p-3 sm:col-span-8 lg:col-span-7">
                                <h2 class="text-2xl font-bold text-gray-800 truncate dark:text-gray-300 sm:pr-12">
                                    {{$service->title}}</h2>

                                <section aria-labelledby="information-heading" class="px-4 mt-1">
                                    <h3 id="information-heading" class="sr-only">Product information</h3>
                                    <div class="my-3">
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
                                                class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500">{{$service->orderCount()}}
                                                reviews</a>
                                        </div>
                                    </div>


                                    @if (!empty($service->premium_price) && !empty($service->extra_price))
                                    <div class="mt-4 mb-3 ">


                                        <ul
                                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li
                                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="horizontal-list-radio-license" type="radio" value="Basic"
                                                        wire:model.live="level" name="list-radio"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-license"
                                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Basic </label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="horizontal-list-radio-id" type="radio" value="Premium"
                                                        wire:model.live="level" name="list-radio"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-id"
                                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Premium
                                                    </label>
                                                </div>
                                            </li>
                                            <li
                                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                                <div class="flex items-center pl-3">
                                                    <input id="horizontal-list-radio-millitary" type="radio"
                                                       wire:model.live="level" value="Extra" name="list-radio"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="horizontal-list-radio-millitary"
                                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                        Extra</label>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    @endif

                                    <div class="flex gap-2">
                                        <span class="py-2 text-gray-400">A partir de </span>
                                        <p class="text-2xl font-bold text-green-500">{{$price}} $</p>
                                    </div>

                                    <!-- Reviews -->
                                </section>

                                <section aria-labelledby="options-heading" class="px-4 mt-1">
                                    <h3 id="options-heading" class="sr-only">Service options</h3>

                                    <div>
                                        <!-- Colors -->
                                        <div id="support" class="hidden">
                                            <h4 class="mb-2 text-lg font-medium text-gray-900 unde dark:text-gray-200">
                                                Support</h4>
                                            <div class="px-4">
                                                <ul class=list-disc>
                                                    @foreach ($service->basic_support as $key=>$value)
                                                    <li>{{$value}}</li>
                                                    @endforeach

                                                </ul>

                                            </div>
                                        </div>


                                        <!-- Sizes -->

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

                                        <div class="flex justify-between mt-3">
                                            <div x-data="{ like: @json($service->isFavorite()) }"
                                                class="flex items-center">
                                                <button class="flex gap-1 mr-2" x-on:click="like=!like"
                                                    @click="$wire.toogleFavorite({{$service->id}})">


                                                    <span x-cloak x-show="!like" class="">
                                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                        </svg>

                                                    </span>
                                                    <span x-cloak x-show="like">
                                                        <svg class="w-5 h-5 text-red-500"
                                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                        </svg>
                                                    </span>
                                                    <span x-show="!like" class="text-sm"> a jouter aux favoris</span>
                                                    <span x-show="like" class="text-sm"> retirer de favoris</span>

                                                </button>



                                            </div>
                                            <div>
                                                <ul class="flex gap-2 text-sm text-gray-300">
                                                    <a class="hidden" id="clipboardContent1"
                                                        href="{{route('ServicesViewOne',['service_numero'=>$service->service_numero,'category'=>$service->category->name])}}"></a>

                                                    {{--<x-dropdown>
                                                        <x-slot name="trigger">
                                                            <button type="button" class="flex gap-1 cursor-pointer">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="1.5"
                                                                    stroke="currentColor" class="w-5 h-5">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                                                </svg>
                                                                <span class="text-sm">Share</span>
                                                            </button>
                                                        </x-slot>

                                                        <x-dropdown.item icon="hashtag" label="Facebook" />
                                                        <x-dropdown.item @click="$clipboard({
                                                content:document.querySelector('#clipboardContent1').innerText,
                                                success:()=>$notification({text:'Text Copied',variant:'success'}),
                                                error:()=>$notification({text:'Error',variant:'error'})
                                              })" icon="clipboard" separator label="Copier Lien" />

                                                    </x-dropdown>--}}


                                                </ul>
                                            </div>
                                        </div>
{{--
                                        @if(!empty($service->recomandations()) && $service->recomandations()->count()
                                        >2)
                                        <div class="mt-4">


                                            <div class="flex gap-1 space-x-0 font-mono text-sm text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                                </svg>



                                                <strong
                                                    class="text-red-500">{{$service->recomandations()->count()}}</strong>
                                                Personnes ont recommandés ce
                                                service
                                            </div>
                                        </div>

                                        @endif--}}
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="sticky flex gap-2 p-6 bg-white rounded-lg dark:bg-gray-800">





                            <div>

                                <x-filament::button x-on:click="contactMe = !contactMe" color="success">
                                    Message
                                </x-filament::button>


                            </div>
                            <div class="hidden">
                                <x-button primary x-on:click="isOpen=true" x-on:click="$openModal('modal')"
                                    label="Recommander" success spinner="recommander" />

                            </div>


                        </div>

                    </div>



                </div>
                <div x-data="{step:1, showExemple:false}" class="w-full md:w-2/3">
                    <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">


                        <div x-data="{ image: @entangle('images') }" class="flex flex-col items-center justify-center">


                            <img x-bind:src="'/storage/' + image"
                                class="object-contain  w-full mr-4 rounded-md max:h-[100px]" alt="Product Name">

                            <div class="flex justify-between mt-4 space-x-2 items-cetnter">
                                @foreach ($service->files as $key=>$value)
                                <img @click="image = '{{$value}}'" src="{{ url('/storage/' . $value) }}"
                                    alt="Product Name"
                                    class="w-24 h-24 border rounded-lg cursor-pointer 2xl:w-24 hover:opacity-80">
                                @endforeach

                            </div>
                        </div>



                        <div>
                            <p class="mt-4 text-lg font-bold text-gray-800 md:text-2xl dark:text-gray-200">
                                {{$service->title}}</p>

                        </div>







                        <div class="w-full tabs">
                            <a @click="step = 1" :class="step == 1 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered">info</a>
                            <a @click="step = 2" :class="step == 2 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered ">Example </a>

                            @if(!empty($service->premium_support) &&
                            !empty($service->premium_price) &&
                            !empty($service->premium_delivery_time))
                            <a @click="step = 3" :class="step == 3 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered ">Comparaison </a>

                            @endif


                            <a @click="step = 4" :class="step == 4 ? 'tab-active':''"
                                class="tab md:tab-lg tab-bordered">Review</a>
                        </div>







                        <div x-show.transition="step==1" class="py-5 min-h-64">
                            <div class="mb-4 text-sm text-gray-800 md:text-base dark:text-gray-200">


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

                                <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Révision :</p>
                                    <p class="text-gray-700 dark:text-gray-300">{{$service->basic_revision}}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="font-bold text-gray-500 dark:text-gray-200">Prix :</p>
                                    <p class="px-2 mt-2 text-gray-700 dark:text-gray-300">à partir de
                                        <span>{{$service->price()}}</span>
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
                        </div>




                        <div x-show.transition="step==2" class="py-5 min-h-72">


                            {!! $service->samples !!}

                        </div>


                        @if(!empty($service->premium_support) &&
                        !empty($service->premium_price) &&
                        !empty($service->premium_delivery_time))
                        <div x-show.transition="step==3" class="py-5 min-h-72">


                            <div class="py-10 bg-gray-100 dark:bg-gray-900">
                                <div class="container px-4 mx-auto">
                                    <h2 class="mb-4 text-2xl font-semibold text-gray-800">Comparaison de Support</h2>
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                        <!-- Basic -->
                                        <div class="p-6 bg-white rounded-lg shadow-md">
                                            <div class="flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 mr-2 text-blue-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4.732 4.732l14.536 14.536M19.268 4.732L4.732 19.268" />
                                                </svg>
                                                <h3 class="text-xl font-semibold text-gray-800">Basic</h3>
                                            </div>
                                            <ul class="text-gray-700">

                                                @foreach ($service->basic_support as $key=>$value)

                                                <li class="flex items-center mb-2">
                                                    <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
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
                                                    <svg fill="#f00000" class="w-4 h-6 mr-2" version="1.1" id="Layer_1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
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

                                                @if(!empty($service->extra_support) &&
                                                !empty($service->extra_price) &&
                                                !empty($service->extra_delivery_time))
                                                @forelse ($service->extra_support as $key=>$value)

                                                <li class="flex items-center mb-2">
                                                    <svg fill="#f00000" class="w-4 h-6 mr-2" version="1.1" id="Layer_1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
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
                                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                    <span class="text-gray-400 dark:text-gray-200">Delai :
                                                        {{$service->basic_delivery_time}}-{{$service->delivery_time_unit?$service->delivery_time_unit:'jours'}}</span>
                                                </li>


                                            </ul>
                                            <div class="mt-6">
                                                <span
                                                    class="text-2xl font-semibold text-gray-800">{{$service->basic_price}}
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
                                                <svg class="w-8 h-8 mr-2 text-green-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4.732 4.732l14.536 14.536M19.268 4.732L4.732 19.268" />
                                                </svg>
                                                <h3 class="text-xl font-semibold text-gray-800">Extra</h3>
                                            </div>
                                            <ul class="text-gray-700">
                                                @foreach ($service->basic_support as $key=>$value)

                                                <li class="flex items-center mb-2">
                                                    <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
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
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
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
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
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
                                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                    <span class="text-gray-400 dark:text-gray-200">Delai :
                                                        {{$service->premium_delivery_time}} jours</span>
                                                </li>


                                            </ul>
                                            <div class="mt-6">
                                                <span
                                                    class="text-2xl font-semibold text-gray-800">{{$service->premium_price}}
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
                                                <svg class="w-8 h-8 mr-2 text-red-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4.732 4.732l14.536 14.536M19.268 4.732L4.732 19.268" />
                                                </svg>
                                                <h3 class="text-xl font-semibold text-gray-800">Premium</h3>
                                            </div>
                                            <ul class="text-gray-700">
                                                @foreach ($service->basic_support as $key=>$value)

                                                <li class="flex items-center mb-2">
                                                    <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                    </svg>

                                                    <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                                                </li>
                                                @endforeach
                                                @forelse ($service->premium_support as $key=>$value)

                                                <li class="flex items-center mb-2">
                                                    <svg class="flex-shrink-0 w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
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
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                                    </svg>
                                                    <span class="text-gray-600 dark:text-gray-200">{{$value}}</span>
                                                </li>
                                                @empty
                                                @endforelse




                                                <li class="flex items-center mb-2">
                                                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                    <span class="text-gray-400 dark:text-gray-200">Delai :
                                                        {{$service->extra_delivery_time}} jours</span>
                                                </li>


                                            </ul>
                                            <div class="mt-6">
                                                <span
                                                    class="text-2xl font-semibold text-gray-800">{{$service->extra_price}}
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

                        @endif


                        <div x-show.transition="step==4" class="py-5 min-h-72">


                            @if(!empty($commentaires))
                            @foreach ($commentaires as $commentaire)

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
                        @endforeach


                        @else

                        <div class="p-4 mb-4 bg-gray-100 rounded-lg dark:bg-gray-700">
                            <p class="text-sm text-gray-700 md:text-base dark:text-gray-300">
                                Pas de commentaires .</p>

                        </div>

                        @endif






                    </div>


                    <div class="">
                        <p class="mb-4 text-lg font-bold text-gray-800 dark:text-gray-200">À propos du freelance
                        </p>
                        <div class="flex items-center gap-4 mb-8">


                            @component("components.user-photo" ,['user'=>$service->freelance->user])
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
        class="fixed bottom-[4rem] top-[8rem] left-[2rem] z-[85] flex flex-col bg-white shadow-lg bg-opacity-20"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-x-full"
        x-transition:enter-end="opacity-100 transform -translate-x-0"
        x-transition:leave="transition ease-in duration-300"
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
            <div x-data="{ message: @entangle('body').defer }" class="flex-grow space-y-2">

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


                        <x-filament::button icon="heroicon-m-eye" href="{{route('MessageUser')}}" tag="a">
voir les messages
                        </x-filament::button>





                    </div>


                </div>
            </div>
            <!-- Corps du chat -->




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

                <button @click="$wire.contacter()"
                    class="px-4 py-2 text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">Envoyer</button>
            </div>
        </div>


        @endif
    </div>





</div>

{{--<x-modal wire:model.defer="modal">
    <x-card title="Success">

        <div class="flex flex-col">
            <div>

                <div class="flex items-center">
                    <p class="mr-2"> Pourquoi recommander vous ce service(facultatif) :</p>
                    <div wire:ignore class="justify-center hidden ">
                        <div class="flex items-center ">
                            <input value="0" type="" class="hidden" id="rating" name="rating">
                            <label for="star1" class="text-gray-400 cursor-pointer" onclick="updateRating(1)">
                                <svg id="star1" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                </svg>
                            </label>
                            <label for="star2" class="text-gray-400 cursor-pointer" onclick="updateRating(2)">
                                <svg id="star2" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                </svg>
                            </label>
                            <label for="star3" class="text-gray-400 cursor-pointer" onclick="updateRating(3)">
                                <svg id="star3" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                </svg>
                            </label>
                            <label for="star4" class="text-gray-400 cursor-pointer" onclick="updateRating(4)">
                                <svg id="star4" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                </svg>
                            </label>
                            <label for="star5" class="text-gray-400 cursor-pointer" onclick="updateRating(5)">
                                <svg id="star5" class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2L14.1386 7.26493L20.831 9.25184L16.6281 13.8239L17.9716 20.0291L12 17.6066L6.02837 20.0291L7.3719 13.8239L3.169 9.25184L9.86144 7.26493L12 2Z" />
                                </svg>
                            </label>


                        </div>
                    </div>
                </div>
            </div>


            <x-textarea wire:model.defer="comment" />
        </div>

        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />

                <x-button flat label="Envoyer" spinner="recommander" wire:click="recommander()" primary />


            </div>
        </x-slot>

    </x-card>

</x-modal>--}}
</div>


