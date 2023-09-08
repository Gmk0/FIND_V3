<div class="min-h-screen p-6">


    <div>
        @include('include.bread-cumb-user',['projet'=>'Mission','projectId'=>$proposition_id])
    </div>


    <div class="container mx-auto">

        <div class="my-8">
            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Propositions de freelances pour
                votre projet</h3>
            <ul class="grid gap-4 mt-4 lg:grid-cols-2 xl:grid-cols-3">

                @forelse($proposition as $proposition)
                <li>



                    <div class="p-6 bg-white rounded-lg shadow-md min-w-72">
                        <div class="flex items-center justify-center">
                            @if (!empty($proposition->freelance->user->profile_photo_path))
                            <img class="object-cover w-16 h-16 rounded-full"
                                src="{{Storage::disk('local')->url($proposition->freelance->user->profile_photo_path) }}"
                                alt="">
                            @else
                            <img class="object-cover w-16 h-16 rounded-full"
                                src="{{$proposition->freelance->user->profile_photo_url }}" alt="">
                            @endif
                        </div>
                        <div class="mt-2 mb-2 text-lg font-semibold">Proposition du Freelance</div>
                        <div class="mb-2 text-gray-600"><a href=""> <span
                                    class="text-gray-700 dark:text-gray-200">{{$proposition->freelance->user->name}}</span>
                            </a></div>

                        <div class="mb-2 text-gray-600">Tarif : <span
                                class="text-gray-700 dark:text-gray-200">{{$proposition->bid_amount}} $</span></div>
                        <div class="mt-4 text-gray-600">Description</div>
                        <p class="text-gray-700 dark:text-gray-200">
                        <p>{{$proposition->content}} </p>
                        </p>



                        @if($proposition->status=="accepter")
                        <div class="flex gap-4 py-4 ">
                            <div class="p-2">
                                <h1 class="font-bold text-gray-800">Accepter </h1>
                            </div>
                            <div>
                                <x-button href="{{route('projetEvolution',['idP'=>$proposition->id,'id'=>
                                                            $proposition->project->id])}}" sm positive
                                    label="l'evolution" />

                            </div>

                        </div>
                        @else


                        <div class="flex gap-4 py-4 bg-gray-200 dark:bg-gray-800">
                            <x-button spinner="refuser" negative wire:click="refuser('{{$proposition->id}}')" sm danger
                                label="Rejeter" />
                            <x-button spinner="accepter" wire:click="accepter('{{$proposition->id}}')" sm primary
                                label="Accepter" />
                        </div>
                        @endif

                    </div>
                </li>

                @empty
                <li class="text-lg text-gray-800">
                    Vous Avez Zero Proposition pour ce projet
                </li>
                @endforelse

                <!-- Répéter le code pour chaque proposition de freelance -->
            </ul>
        </div>
    </div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
