<div class="lg:h-[14rem]  w-full lg:w-full relative flex flex-col justify-between p-4 dark:text-gray-200 md:p-6">
    <div>
        <a href="{{route('ServicesViewOne',['service_numero'=>$service->service_numero,'category'=>$service->category->name])}}" wire:navigate
            class="mb-2 text-sm font-semibold md:text-base "
            :class="linkHover ? 'text-amber-600' : 'text-gray-800 dark:text-gray-300'">{{$service->title}}
        </a>
        <div class="flex items-center mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-yellow-500" viewBox="0 0 20 20"
                fill="currentColor">
                <path
                    d="M10 13.165l-4.53 2.73 1.088-5.997L.976 6.305l6.018-.873L10 0l2.006 5.432 6.018.873-4.582 3.593 1.088 5.997L10 13.165z" />
            </svg>
            <p class="text-sm text-gray-700 dark:text-gray-300">{{$service->averageFeedback()}}
                ({{$service->orderCount()}})
            </p>
        </div>
        <div class="flex items-center justify-between mb-2">

            <a href="{{url('profile.freelance',[$service->freelance->identifiant])}}"
                class="text-sm text-gray-700 dark:text-gray-300">
                {{$service->freelance->user->name}}</a>
            <p class="text-sm text-gray-700 dark:text-gray-300">
                {{$service->freelance->level}}</p>
        </div>
    </div>
    <div class="flex items-center justify-between dark:text-gray-300">
        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-300"> <span class="text-xs text-gray-400">a partir
                de </span>
            <span class="font-bold text-green-300">{{$service->price()}}</span>
        </h4>



        @auth
        <div x-data="{ like: @json($service->isFavorite()) }" class="flex items-center">
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
    <div class="flex items-center justify-between pt-2 dark:text-gray-200">

        <button wire:click="add_cart({{$service->id}})" type="button"
            class="block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            data-ripple-light="true">
            ajouter
        </button>

    </div>
</div>
