<div>





    <div x-cloak x-show="linkActive" x-transition:enter="transition ease-out duration-300"
        @click.away="linkActive=false" x-transition:enter-start="opacity-0 transform translate-x-40"
        x-transition:enter-end="opacity-100 transform -translate-x-0"
        x-transition:leave="transition ease-out duration-300"
        x-transition:leave-start="opacity-0 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform translate-x-40"
        class="fixed inset-y-0 right-0 z-[85] flex flex-col bg-white shadow-lg bg-opacity-20 w-80"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
        <div class="flex items-center justify-between flex-shrink-0 p-2">
            <h6 class="p-2 text-lg text-gray-800">Panier</h6>
            <button @click="linkActive = false" class="p-2 rounded-md focus:outline-none focus:ring">
                <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="flex-1 max-h-full p-4 overflow-auto ">

            <!-- Settings Panel Content ... -->


            @if(Session::has('cart'))
            <div class="flex-1 overflow-y-auto">


                @foreach (Session::get('cart')->items as $item)

                <div class="flex items-center p-4 space-x-4">

                    <img class="object-cover w-16 h-16 rounded-lg"
                        src="{{Storage::disk('local')->url($item['image']) }}" alt="Service 1">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-100">{{$item['title']}}</h3>
                        <p class="text-gray-500 dark:text-gray-100">{{$item['basic_price']}} $</p>

                        @php
                        $data= $item['quantity'];
                        @endphp

                        <div class="mt-4" x-data="{ productQuantity: {{$data}} }">
                            <label for="Quantity" class="sr-only"> Quantity </label>

                            <div class="flex items-center gap-1">
                                <button type="button" x-on:click="productQuantity--" :disabled="productQuantity === 1"
                                    @click="$wire.updateQty({{$item['id']}},productQuantity)"
                                    class="w-8 h-8 leading-10 text-gray-600 transition hover:opacity-75">
                                    &minus;
                                </button>


                                <input type="number" id="Quantity" value="{{$item['quantity']}}"
                                    x-on:change="$wire.updateQty({{$item['id']}},productQuantity)"
                                    class="h-8 w-10 rounded border-gray-200 dark:bg-gray-700 text-center [-moz-appearance:_textfield] sm:text-sm [&::-webkit-outer-spin-button]:m-0 [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:m-0 [&::-webkit-inner-spin-button]:appearance-none" />

                                <button type="button" x-on:click="productQuantity++"
                                    @click="$wire.updateQty({{$item['id']}},productQuantity)"
                                    class="w-8 h-8 leading-10 text-gray-600 transition hover:opacity-75">
                                    &plus;
                                </button>
                            </div>
                        </div>
                    </div>
                    <button wire:click="remove({{$item['id']}})"
                        class="text-gray-500 hover:text-gray-600 focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>


                </div>
                @endforeach
                <div wire:loading wire:target='add_cart' class="">

                    <h1 class="px-2">Chargement....</h1>

                </div>
            </div>
            <div class="flex flex-col gap-4 p-4 border-t border-gray-200">
                <p class="mb-2 text-xl font-semibold text-gray-600 dark:text-gray-100">Total :
                    {{Session('cart')->totalPrice}} $
                </p>


                <x-filament::button @click="linkActive=false" color="success"
                href="{{route('checkout')}}"
                tag="a"
                >
                                Payer
                </x-filament::button>



            </div>

            @else
            <div class="">
                <div wire:loading wire:target='add_cart' class="">

                    <h1 class="px-2">Chargement....</h1>

                </div>
                <h1>Votre Carte est vide</h1>

            </div>
            @endif
        </div>
    </div>
</div>
