<div x-cloak x-show.transition="isSearchBoxOpen" class="fixed inset-0 z-[500] bg-black bg-opacity-20"
    style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
    <div @click.away="isSearchBoxOpen = false"
        class="inset-x-0 flex items-center justify-between p-2 bg-white shadow-md ">
        <div class="flex items-center flex-1 px-2 space-x-2">
            <!-- search icon -->
            <span><svg class="w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" placeholder="Search" wire:model.live.debounce.100ms="search"
                class="w-full px-4 py-3 text-gray-600 rounded-md focus:bg-gray-100 focus:outline-none" />


        </div>
        <!-- close button -->
        <button @click="isSearchBoxOpen = false" wire:click='resetSearch()' class="flex-shrink-0 p-4 rounded-md">
            <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

    </div>
    <div class="mx-2">

        @if($search != null)
        <div
            class="relative w-full mt-1 overflow-y-auto bg-white border divide-y rounded-lg shadow z-60 custom-scrollbar max-h-72">
            @forelse($results as $index => $result)

            <a href="{{route('ServicesViewOne',['service_numero'=>$result->service_numero,'category'=>$result->category->name])}}"
                wire:key="{{
                            $index }}"
                class="block p-2 text-sm text-gray-800 cursor-pointer md:text-base hover:bg-amber-700 hover:text-white">{{
                $result->title
                }}
                - {{
                $result->category->name }}</a>
            @empty

            @endforelse


            <div wire:loading class="flex items-center justify-center p-2">
                <div class="spinners"></div>
            </div>


        </div>
        @endif

        <div wire:loading.remove.delay class="col-span-4">
            <div class="flex items-center mt-8 justify-center text-lg">
                @if ($hasSearched)
                @empty($results)
                <h1 class="text-gray-700 dark:text-gray-100">pas de resultat</h1>

                @endempty
                @else
                <h1 class="text-gray-700 dark:text-gray-100">faites une recherche</h1>
                @endif

            </div>

        </div>


    </div>

</div>
