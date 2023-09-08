<div class="px-4 py-5 mx-auto max-w-7xl lg:px-8">
    <div class="max-w-3xl mb-8">
        <h2 class="mb-8 text-xl font-semibold tracking-wide uppercase text-amber-600">Modifier</h2>
    </div>

    <div class="max-w-4xl mx-auto">

        <form wire:submit="save">
            {{ $this->editForm }}


          <div class="flex items-center justify-center mt-4">



            <div class="flex gap-6">

                <x-filament::button size="lg" type="submit">
                        Modifier
                    </x-filament::button>

                    <x-filament::button href="{{route('MissionUser')}}" color="success" size="lg" tag="a">
                        Retour
                    </x-filament::button>
            </div>


        </div>

        </form>


        <div class="mt-4">


            <x-filament::section collapsible >

            <x-slot name="heading">

               Modifier Fichier

            </x-slot>

            <div>

                <div class="flex flex-col items-start justify-start py-4">
                    <div class="flex items-start justify-between mt-4 space-x-2">
                        @foreach ($record->files as $key=>$value)

                        <img src="{{Storage::disk('local')->url($value) }}" alt="Product Name"
                            class="w-24 h-full border rounded-md cursor-pointer xl:w-24 2xl:w-24 hover:opacity-80">



                            <x-filament::icon-button

                            icon="heroicon-m-trash"
                            tooltip="Effacer"
                            wire:click="effacerImage({{$key}})"

                            />




                            @endforeach

                    </div>
                </div>


                <div class="w-full lg:w-1/2">
                    {{$this->imageForm}}

                    <div class="flex items-center justify-center mt-4">

                        <x-filament::button size="lg" wire:click='Modifier()'>
                            Modifier
                        </x-filament::button>
                    </div>

                </div>


            </div>

        </x-filament::section>

             {{--   <div class="mt-4">
                    <div wire:loading wire:target='images'>
                        <x-button lg spinner="images" primary label='Chargement du fichier' disabled></x-button>
                    </div>
                    <div wire:loading.remove wire:target='images'>
                        <x-button lg spinner="saveImage" wire:click="saveImage()" label='Ajouter' type="submit">
                        </x-button>



                    </div>
                </div>--}}
            </div>
    </div>

    <x-filament-actions::modals />
</div>
