<div class="m-1 lg:mx-0">
    <div class="relative flex w-full max-w-[20rem] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-lg">
        <div
            class="relative mx-4 mt-2 overflow-hidden text-white shadow-lg h-52 rounded-xl bg-blue-gray-500 bg-clip-border shadow-blue-gray-500/40">


            @if (!empty($freelance->user->profile_photo_path))
            <img src="{{Storage::disk('local')->url($freelance->user->profile_photo_path) }}" alt=""
                class="object-cover w-full h-52">

            @else
            <img class="object-cover w-full h-48" src="{{$freelance->user->profile_photo_url }}" alt="">
            @endif



            @auth
            <div x-data="{ like: @json($freelance->isFavorite()) }" class="flex items-center">
                <button class="absolute top-2 right-2" x-on:click="like=!like"
                    @click="$wire.toogleFavorite({{$freelance->id}})">


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
        <div class="p-3">
            <div class="flex items-center justify-between mb-2">
                <h5 class="block font-sans text-base antialiased leading-snug tracking-normal text-gray-800">
                    {{$freelance->user->name}}

                </h5>
                <p
                    class="flex items-center gap-1.5 font-sans text-sm font-normal leading-relaxed text-gray-800 dark:text-white  antialiased">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        class="-mt-0.5 h-3 w-3 text-yellow-400">
                        <path fill-rule="evenodd"
                            d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                            clip-rule="evenodd"></path>
                    </svg>

                    ({{$freelance->level}})

                </p>
            </div>
            <p class="block font-sans text-sm antialiased leading-relaxed text-gray-700 dark:text-gray-200">
                {{$freelance->category->name}}
            </p>
            <div class="!h-12 inline-flex flex-wrap items-center gap-3 mt-4 group">

                @empty(!$freelance->sub_categorie)
                @forelse ($freelance->sub_categorie as $key => $value)

                @php
                $shortValue = Str::limit($value, 18);
                @endphp
                @if ($loop->index < 3) <span data-tooltip-target="{{$value}}"
                    class="items-center py-1 cursor-default px-2 rounded-md text-[10px] font-medium border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700 dark:bg-secondary-700 dark:text-secondary-400 dark:border-none">
                    {{$shortValue}}</span>

                    <div id="{{$value}}" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                        {{$value}}
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                    @endif
                    @if ($loop->last && $loop->remaining > 0)
                    <span class="ml-2 text-sm text-gray-500">(+{{$loop->remaining}} de plus)</span>
                    @endif
                    @empty

                    @endforelse
                    @endempty


            </div>



        </div>
        <div class="flex flex-row justify-between gap-2 p-3">
            <button type="button" wire:click="conversation({{$freelance->id}})"
                class="block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle font-sans text-sm font-bold uppercase text-white shadow-md shadow-amber-500/20 transition-all hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button" data-ripple-light="true">
                Contacter
            </button>
            <a href="{{route('profileFreelance',$freelance->identifiant)}}"
                class="block w-full select-none rounded-lg  py-2 px-2 text-center align-middle font-sans text-sm font-bold uppercase dark:text-white shadow-md dark:shadow-white-500/20 text-amber-600 transition-all hover:shadow-lg  focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                profile
            </a>
        </div>
    </div>
</div>
