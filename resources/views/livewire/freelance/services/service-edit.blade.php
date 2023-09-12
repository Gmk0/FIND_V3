<div class="min-h-screen px-2 mx-4 max-w-7xl lg:px-4">
   <div class="flex flex-col items-start max-w-3xl py-3 mb-3 space-x-4 lg:py-4">
    <h2 class="mb-4 text-xl font-semibold tracking-wide uppercase text-amber-600">Modification </h2>

    <div>
        @include('include.bread-cumb-freelance',['serviceName'=>'service','serviceEdit'=>$record->service_numero])
    </div>
</div>





    <div class="my-3 overflow-auto ">

        <div class="p-4 mb-4 rounded-md dark:text-gray-100 dark:bg-gray-800 ">

            <div>
                <form wire:submit.prevent="edit">
                    {{ $this->editForm }}

                    <div class="flex items-center justify-center mt-4">


                        <x-filament::button size="lg" type="submit">
                            <span wire:loading.remove wire:target='edit'>Proceder a la modification</span>
                                <span wire:loading wire:target='edit'>Modification....</span>
                            </x-filament::button>




                    </div>
                    <x-filament-actions::modals />
                </form>

            </div>



            <div class="p-4 mt-4 bg-white rounded-lg dark:bg-gray-900">
                <div>

                    <div x-data="{ image: @entangle('images') }" class="flex flex-col items-start justify-start py-4">
                        <div class="flex items-start justify-between mt-4 space-x-2">
                            @foreach ($record->files as $key=>$value)

                            <img src="{{Storage::disk('local')->url($value) }}" alt="Product Name"
                                class="w-16 h-full border rounded-md cursor-pointer lg:w-24 2xl:w-24 hover:opacity-80">


<x-filament::icon-button icon="heroicon-m-trash" tooltip="Effacer" wire:click="effacerImage({{$key}})" />
                                @endforeach

                        </div>
                    </div>


                    <form>



                        {{$this->imageForm}}

                    </form>


                </div>
                <div class="mt-4">

                </div>
            </div>

            <div class="flex items-center justify-center mt-4">

                <x-filament::button size="lg" wire:click='editImage()'>
                 <span wire:loading.remove wire:target='editImage'>Changer l'image</span>
                <span wire:loading wire:target='editImage'>Modification....</span>
                </x-filament::button>





            </div>




        </div>
    </div>
</div>
