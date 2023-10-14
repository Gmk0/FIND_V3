<div x-data="{show:false}" class="min-h-screen">


    <div class="flex flex-col items-start py-3 space-x-4 lg:py-3">
        <h2 class="mb-4 font-medium tex t-xl text-slate-800 dark:text-navy-50 lg:text-2xl">
            Vos Realisations
        </h2>

        <div>
            @include('include.bread-cumb-freelance',['realisation'=>'realisation'])
        </div>
    </div>


    <div class="mt-4">
        <div>


            <div class="grid gap-4 py-4 space-y-4 lg:grid-cols-2">


                @empty(!$record->realisations)
                @foreach ($record->realisations as $cle => $value)
                <div class="flex flex-col space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex flex-wrap items-center justify-start mb-4 space-x-2">
                        @foreach ($value['image'] as $key => $item)
                        <div class="relative group">
                            <img src="{{ Storage::disk('local')->url($item) }}" alt="Product Image"
                                class="w-40 transition-transform transform border rounded-md hover:scale-105">
                            <div class="absolute top-0 right-0 mt-2 mr-2">
                                <x-button.circle icon="trash" negative sm wire:click="effacer({{$cle}},{{ $key }})"></x-button.circle>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="flex-1 p-4 mt-4 bg-gray-100 rounded-md shadow-sm dark:bg-navy-800 md:mt-0">
                        <p class="text-gray-700 dark:text-gray-200">{{ $value['description'] }}</p>
                    </div>


                    <div>
                        <x-filament::icon-button icon="heroicon-m-pencil" tooltip="Effacer" wire:click="editReal({{$cle}})" />
                    </div>
                </div>
                @endforeach

                @else

                @endempty
            </div>



            <div x-show="show" x-collapse>

                <div class="w-full ">


                    <x-textarea label="Descrption" wire:model='description'>

                    </x-textarea>

                </div>

            </div>



        </div>
        <div class="mt-4">
          <div x-show="show" class="flex items-center justify-center mt-4">







        </div>
        <div x-show="!show" class="flex items-center justify-center mt-4">

            <x-filament::button size="lg" x-on:click="$dispatch('open-modal', { id: 'realisation' })">
                <span >Ajouter</span>

            </x-filament::button>





        </div>
        </div>

        <x-filament::modal width="2xl" slide-over id="realisation">

            <x-slot name="heading">
                Realisation
            </x-slot>



            <div>

                {{$this->form}}

            <div class="mt-2">

            </div>
            </div>


            <x-slot name="footerActions">

                @if($editForm)

<x-filament::button outlined wire:click='editRealisation()'>
    <span wire:loading.remove wire:target='editRealisation'>Modifier</span>
    <span wire:loading wire:target='editRealisation'>Modification....</span>
</x-filament::button>
                @else
                <x-filament::button outlined wire:click='save()'>
                    <span wire:loading.remove wire:target='save'>Ajouter</span>
                    <span wire:loading wire:target='save'>Modification....</span>
                </x-filament::button>

                @endif



                <x-filament::button wire:click='resetAll()' outlined x-on:click='close' icon="" size="lg" color="danger">
                    Fermer
                </x-filament::button>



            </x-slot>
        </x-filament::modal>
    </div>
    <x-filament-actions::modals />
</div>
