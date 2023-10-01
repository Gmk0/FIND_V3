

<div class="w-[52%]  md:w-full flex gap-1 lg:px-4 px-2 pt-1 pb-2 flex-col">
    <div class="flex lg:mt-0 mt-1   justify-between ">
        <div class="flex gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1 text-yellow-200" viewBox="0 0 20 20"
                fill="currentColor">
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
            <div wire:ignore x-data="{ like: @json($service->isFavorite()) }"
                class="flex absolute top-4 left-4 lg:right-4 items-center">
                <button class="mr-2" x-on:click="like=!like" @click="$wire.toogleFavorite({{$service->id}})">


                    <span x-cloak x-show="!like" class="">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </span>
                    <span x-cloak x-show="like">
                        <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24" stroke="currentColor">
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
        <a href="{{route('ServicesViewOne',['service_numero'=>$service->service_numero,'category'=>$service->category->name])}}

                                                                            " wire:navigate
            class="mr-1 hover:text-amber-600 text-gray-600 font-bold ">
            {{$service->title}}
        </a>


    </div>
    <div class="mt-2">
        <div class="flex items-center gap-1">
            @component("components.user-photo" ,['user'=>$service->freelance->user,])
            @endcomponent
            <a href="{{route('profileFreelance',$service->freelance->identifiant)}}" class="flex">
                <span class="text-xs flex md:hidden">{{
                    \Illuminate\Support\Str::limit($service->freelance->user->name, 10) }}</span>
                <span class="text-xs md:flex hidden">{{$service->freelance->user->name}}</span>

            </a>

        </div>
    </div>
    <div class="flex md:mt-3 mt-auto mb-2  justify-between">
        <div class="hidden">
            <x-button></x-button>
        </div>

        <div class="flex items-center gap-1">
            <div class="text-gray-600">
                a partir de
            </div>

            <x-button wire:click='add_cart({{$service->id}})' amber flat class="!rounded-br-xl !rounded-md">


                <span class="font-semibold" wire:loading.remove wire:target='add_cart({{$service->id}})'>{{$service->basic_price}} $</span>
                <span wire:loading wire:target='add_cart({{$service->id}})'>Ajout..</span>

            </x-button>



        </div>

    </div>

</div>
