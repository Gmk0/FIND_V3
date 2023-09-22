

<div
    class="px-4 py-5 mx-auto max-w-7xl lg:px-8">
    <div class="max-w-3xl mb-8">
        <h2 class="mb-8 text-xl font-semibold tracking-wide uppercase text-amber-600">{{$title}}</h2>
    </div>

    <div>
        @include('include.bread-cumb-user',['projet'=>'Mission'])
    </div>


    <div>
        <div class="flex gap-4 my-4">

            <x-filament::button  outlined tag="a" href="{{route('createProject')}}"
                color="success">
                Soumettre
            </x-filament::button>

            <x-filament::button outlined wire:click='demasquer()' color="success">


            @if(!$masquer)
            afficher Mission masquer
            @else
             masquer Mission

            @endif

            </x-filament::button>


        </div>

        <div x-show="loading" class="grid grid-cols-1 gap-4 mx-auto lg:grid-cols-2 xl:grid-cols-2">

            <div class="h-48 bg-gray-200 animate-pulse card">

            </div>
            <div class="h-48 bg-gray-200 animate-pulse card">

            </div>

        </div>
        <div x-show="!loading" x-cloak class="grid grid-cols-1 gap-4 mx-auto lg:grid-cols-2 xl:grid-cols-2">






            @forelse($projets as $projet)

            <div class="card lg:flex-row">
                <img class="object-cover object-center w-full h-48 bg-center bg-cover rounded-t-lg shrink-0 lg:h-auto lg:w-48 lg:rounded-t-none lg:rounded-l-lg"
                    src="{{ asset('images/illustrations/missionF.svg') }}" alt="image" />
                <div class="flex flex-col w-full px-4 py-3 grow sm:px-5">
                    <div class="flex items-center justify-between">
                        <a class="text-xs+ text-info" href="#">{{$projet->category->name}}</a>
                        <div class="-mr-1.5 flex space-x-1">
                            <button
                                class="p-0 rounded-full btn2 h-7 w-7 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </button>

                            <div class="p-2">
                                @if($projet->status=="completed")
                                <x-dropdown>

                                    <x-dropdown.item wire:click='masquerMission({{$projet->id}})'>

                                        @if($projet->masquer)

                                        Demasquer
                                        @else
                                        Masquer
                                        @endif

                                    </x-dropdown.item>




                                </x-dropdown>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{route('PropostionProjet',[$projet->mission_numero])}}"
                            class="text-lg font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                            {{$projet->title}}</a>
                    </div>
                    <p x-data={showMore:false} class="mt-1 line-clamp-3">

                        <template x-if="!showMore">
                            <p class="">{{ \Illuminate\Support\Str::limit($projet->description, 100) }}</p>

                        </template>
                        <template x-if="showMore">
                            <p>{{ $projet->description }}</p>

                        </template>

                        @if(mb_strlen($projet->description) > 100)
                    <div>
                        <button @click="showMore = !showMore">
                            <span x-show="showMore" class="text-blue-600">Lire moins</span>
                            <span x-show="!showMore" class="text-blue-600">Lire la suite</span>
                        </button>

                    </div>
                    @endif





                    </p>
                    <div class="grow">
                        <div class="flex items-center mt-2 text-xs">
                            <a href="#" class="flex items-center space-x-2 hover:text-slate-800 dark:hover:text-navy-100">
                                <div class="w-6 h-6 avatar">
                                    @if (!empty(Auth::user()->profile_photo_path))
                                    <img class="object-cover rounded-full"
                                        src="{{Storage::disk('local')->url($projet->user->profile_photo_path) }}" alt="">
                                    @else
                                    <img class="rounded-full " src="{{$projet->user->profile_photo_url }}" alt="">
                                    @endif
                                </div>
                                <span class="line-clamp-1">{{$projet->user->name}}</span>
                            </a>
                            <div class="self-stretch w-px mx-3 my-1 bg-slate-200 dark:bg-navy-500"></div>
                            <span class="shrink-0 text-slate-400 dark:text-navy-300">{{$projet->created_at->formatLocalized('%e
                                %B %G')}}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-1">
                        @if($projet->status=="completed")
                        <div>
                            <x-filament::button tag="a" outlined
                                href="{{route('projetEvolution',[$projet->getApprovedMissionResponse()->response_numero])}}" color="success">
                                Mission terminer
                            </x-filament::button>
                        </div>
                        @endif
                        @if($projet->status=="active")
                        <div>
                            <x-filament::button tag="a" outlined wire:navigate
                                href="{{route('projetEvolution',[$projet->getApprovedMissionResponse()->response_numero])}}" color="success">
                                Evolution
                            </x-filament::button>
                        </div>
                        @elseif ($projet->status =="pending")
                        <x-filament::button outlined tag="a" href="{{route('PropostionProjet',[$projet->mission_numero])}}" color="success">
                            Propositions
                            <x-slot name="badge">
                                {{count($projet->MissionResponses)}}
                            </x-slot>
                        </x-filament::button>
                        <div>
                            <x-filament::button outlined tag="a" href="{{route('MissionEdit',[$projet->mission_numero])}}" color="info" wire:navigate>
                                Modifier
                            </x-filament::button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


            @empty


            @endforelse
        </div>


        @if(count($projets) <1)
         <div x-show="!loading" class="flex flex-col items-center justify-center col-span-2 text-xl font-semibold">
            <div class="flex flex-col gap-4 p-6 mx-12 text-gray-800 rounded-md dark:bg-gray-800 bg-gray-50">
                <p>Si vous avez besoin d'un service particulier, n'hésitez pas à
                    soumettre
                    votre projet et
                    notre communauté de freelances
                    talentueux sera ravie de vous aider</p>
                <div class="mx-auto md:w-1/4">


                    <x-filament::button tag="a" icon="heroicon-m-arrow-down-tray" icon-position="after" size="xl" href="{{ route('createProject') }}"  wire:navigate>
                        Soumettre
                    </x-filament::button>

                </div>


            </div>

</div>
        @endif





    <x-filament::modal id="edit-mission">

    </x-filament::modal>


    <div>

        {{$projets->links()}}
    </div>
</div>



<!-- component -->

</div>
