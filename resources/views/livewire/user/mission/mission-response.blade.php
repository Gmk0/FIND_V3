<div class="min-h-screen p-6">


    <div>
        @include('include.bread-cumb-user',['projet'=>'Mission','projectId'=>$proposition_id])
    </div>


    <div class="container mx-auto">

        <div class="my-8">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Propositions de freelances pour
                votre projet</h3>
            <div class="grid gap-4 mt-4 lg:grid-cols-2 xl:grid-cols-3">

                @forelse($proposition as $proposition)
                <div>
                    <div class="p-6 bg-white rounded-lg shadow-md min-w-72">
                        <div class="flex items-center justify-center">
                            @if (!empty($proposition->freelance->user->profile_photo_path))
                            <img class="object-cover w-24 h-24 rounded-full"
                                src="{{Storage::disk('local')->url($proposition->freelance->user->profile_photo_path) }}"
                                alt="">
                            @else
                            <img class="object-cover w-16 h-16 rounded-full"
                                src="{{$proposition->freelance->user->profile_photo_url }}" alt="">
                            @endif
                        </div>
                        <div class="mt-2 mb-2 text-lg font-semibold">Proposition du Freelance</div>
                        <div class="mb-2 text-gray-600">
                            <a href="{{route('profileFreelance',$proposition->freelance->identifiant)}}">
                                 <span class="text-base text-gray-700 dark:text-gray-200">{{$proposition->freelance->user->name}}</span>
                            </a></div>

                        <div class="mb-2 text-gray-600 dark:text-gray-300">Tarif : <span
                                class="text-gray-700 dark:text-gray-200">{{$proposition->budget}} $</span></div>
                        <div class="mt-4 text-gray-600 dark:text-gray-300">Description</div>
                        <div class="text-gray-700 dark:text-gray-200">
                        {!!$proposition->content!!}
                        </div>

                        @if($proposition->status=="approved")
                        <div class="flex flex-grow gap-4 py-4 ">
                            <div class="p-2">
                                <h1 class="font-bold dark:text-gray-300 text-gray-600">Vous avez accepter cette proposition </h1>
                            </div>
                            <div>


                                <x-filament::button href="{{route('projetEvolution',[$proposition->response_numero])}}" color="success" size="lg" tag="a">
                                        Evolution
                                </x-filament::button>




                            </div>

                        </div>
                        @else


                        <div class="flex gap-4 py-4 bg-gray-200 dark:bg-gray-800">


                            <div>
                                {{ ($this->refuserAction)(['id' => $proposition->id]) }}
                            </div>


                                <div>
                                    {{ ($this->accepterAction)(['id' => $proposition->id]) }}
                                </div>




                        </div>
                        @endif

                    </div>
                </div>


                @empty
                <div class="text-lg text-gray-800">
                    Vous Avez Zero Proposition pour ce projet
                </div>
                @endforelse


            </div>
        </div>


        <x-filament-actions::modals />
    </div>

</div>
