<div class="px-4 py-5 mx-auto max-w-7xl lg:px-8">
    <div class="max-w-3xl mb-8">
        <h2 class="mb-8 text-xl font-semibold tracking-wide uppercase text-amber-600">{{$title}}</h2>
    </div>


    <div>
        <div class="my-4">

            {{-- <x-button href="{{route('createProject')}}" positive label="Soumettre"></x-button>--}}
        </div>
        <div class="grid grid-cols-1 gap-4 mx-auto lg:grid-cols-2 xl:grid-cols-2">

            @forelse($projets as $projet)
            <div class="p-4 mx-2 bg-white rounded-lg shadow-md max-w-96 lg:mx-0 dark:bg-gray-800">
                <h3 class="mb-2 text-lg font-bold text-gray-800">{{$projet->title}}</h3>

                <p class="mb-2 text-gray-700 dark:text-gray-400">Date: {{$projet->begin_mission->formatLocalized('%e
                    %B %G')}}</p>

                <p class="mb-2 text-gray-700 dark:text-gray-400">Budget: <span
                        class="font-bold">{{$projet->budget()}}</span>
                </p>
                <div class="flex justify-between">
                    <span class="text-gray-500 "></span>
                    @if($projet->status == "active")
                    <span class="font-bold text-green-500 ">En cours</span>
                    @elseif($projet->status=="pending")

                    <span class="font-bold text-yellow-500 ">en attente</span>
                    @endif
                </div>
                <div class="flex gap-4 mt-4">
                    @if($projet->status=="active" || $projet->status=="completed" )
                    <div>



                        <x-filament::button  tag="a" href="{{route('projetEvolution',[$projet->getApprovedMissionResponse()->response_numero])}}" color="success">
                            Evolution
                        </x-filament::button>

                        {{--
                        <x-button href="{{route('PropostionProjet',[$projet->id])}}" positive label="Evolution" />
                        --}}
                    </div>



                    @else
                    <x-filament::button tag="a" href="{{route('PropostionProjet',[$projet->mission_numero])}}" color="success">
                        Propositions
                    </x-filament::button>


                    <div>


                        <x-filament::button tag="a"  href="{{route('MissionEdit',[$projet->mission_numero])}}" color="info" wire:navigate>
                            Modifier
                        </x-filament::button>
                    </div>



                    {{-- <div>
                        <x-button href="{{route('PropostionProjet',[$projet->id])}}" primary
                            label="Propositions {{$projet->projectRepsonsesCount()}}" />

                    </div>


                    <div>
                        <x-button.circle wire:click="openModal('{{$projet->id}}')" icon="trash">

                            </x-button>

                    </div>--}}








                    @endif



                </div>
            </div>
            @empty


            @endforelse

            <!-- Ajouter d'autres projets ici -->
        </div>


        @if(count($projets) <1) <div class="flex flex-col items-center justify-center col-span-2 text-xl font-semibold">
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
        {{-- Modal content --}}
    </x-filament::modal>


    <div>

        {{$projets->links()}}
    </div>
</div>



<!-- component -->

</div>
