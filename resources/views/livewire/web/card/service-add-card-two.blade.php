<div>

    <div>
        <div x-data="{linkHover: false}" style="" @mouseover="linkHover = true" @mouseleave="linkHover = false"
            class="px-4 py-2 mt-2 md:mt-2 h-[10rem]">
            <a href="{{route('ServicesViewOne',['service_numero'=>$service->service_numero,'category'=>$service->category->name])}}"
                class="mb-2 text-sm font-semibold md:text-base "
                :class="linkHover ? 'text-amber-600' : 'text-gray-800 dark:text-gray-200'">{{$service->title}}
            </a>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-200">
                {{$service->freelance->user->name}} • {{$service->category->name}}
            </p>
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-yellow-500 fill-current" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 14.155L4.284 17.84l.828-5.076L.898 7.865l5.059-.736L10 2l2.043 5.129 5.059.736-3.215 3.9.828 5.076z" />
                    </svg>
                    <span class="font-semibold text-gray-700 dark:text-gray-200">{{$service->averageFeedback()}}
                        ({{$service->orderCount()}})</span>
                </div>
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



        </div>
        <div class="flex justify-between border-t border-gray-300">


            <p class="px-4 py-4">
                <span class="text-sm text-gray-400">a partir
                    de </span>
                <span class="font-bold text-green-300">{{$service->price()}}</span>
            </p>
            <div class="px-4 py-4">
                <x-button wire:click='add_cart({{$service->id}})' spinner="add_cart({{$service->id}})" flat amber
                    label="Ajouter" />
            </div>

        </div>

    </div>
</div>
