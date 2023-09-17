<div x-cloak x-show="isOpenSearch" x-transition:enter="transition-transform transform ease-out duration-500"
    x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0"
    x-transition:leave="transition-transform transform ease-in duration-500" x-transition:leave-start="translate-y-0"
    x-transition:leave-end="-translate-y-full" class="min-h-screen bg-skin-fill pt-24 dark:bg-gray-800 z-[200] transform">
  <div>



    <div x-data="{filtre:false}" class="max-w-6xl p-4 mx-auto">


        <div class="w-full p-5 bg-white rounded-lg shadow ">
            <div class="relative">

                <x-input wire:model.live.debounce.100ms="search" class="w-3/4 py-3 rounded-full focus:border-amber-600"
                    placeholder="Serach">
                    <x-slot name="append">
                        <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                            <x-button class="h-full rounded-r-md" label="filtre" icon="search" amber squared x-on:click="filtre=!filtre" />
                        </div>
                    </x-slot>
                </x-input>

            </div>

            <div class="flex items-center justify-between mt-4">


                <div x-show="filtre">
                    <x-button wire:click='resetAll()' label='Reset'>

                    </x-button>
                </div>
            </div>
            <div>

                <div x-bind:class="filtre ? 'flex translate-x-0 ':'hidden'" class="p-2">

                    {{--$this->form--}}
                    <div class="relative grid grid-cols-2 gap-4 mt-4 md:grid-cols-3 xl:grid-cols-4">
                        <x-select wire:model.live.debounce.100ms="category" placeholder="Compentences"
                            :async-data="route('api.services')" option-label="name" option-value="id" />
                        <x-select placeholder="Temps de livraison" wire:model.live.debounce.100ms="delivery_time" :options="['1-5'=>'1-5 jours',
                                                                                '5-10'=>'5-10 jours',
                                                                                '10-50'=>'plus de 10 jours',

                                                                                ]" />
                        <x-select placeholder="Prix" wire:model.live.debounce.100ms="price_range" :options="[
                                                                '1'=>'10$-50$',
                                                                '2'=>'50$-100$',
                                                                '3'=>'100$ +',
                                                                ]" />
                    </div>
                </div>
            </div>


        </div>


    </div>


    <div >
        <div class="flex items-center justify-center">

            <div class="flex items-center justify-center p-2">
                <div wire:loading.delay class="spinner"></div>
            </div>

        </div>

    </div>







    <div class="grid grid-cols-1 gap-4 mx-1 lg:max-w-5xl lg:mx-2 lg:p-4 md:grid-cols-3 lg:md:grid-cols-4 md:gap-4">
        @forelse ($results as $service)



        @livewire('web.card.service-card',['service' => $service], key($service->id))

        @empty

        <div wire:loading.remove.delay class="col-span-4">
            <div class="flex items-center justify-center text-lg">
             @if ($hasSearched)
            <h1 class="text-gray-100">pas de resultat</h1>
            @else
            <h1 class="text-gray-100">faites une recherche</h1>
            @endif

            </div>

        </div>


        @endforelse

    </div>



  </div>
</div>
