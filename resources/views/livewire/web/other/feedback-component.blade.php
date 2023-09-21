
<div>



<div x-data="{ showModal: false, delay: 300000 }" x-init="
    const startTime = localStorage.getItem('startTime') || Date.now();
    localStorage.setItem('startTime', startTime);
    const elapsedTime = Date.now() - startTime;
    const remainingTime = delay - elapsedTime;
    if (@entangle('showFeedback') && remainingTime > 0) {
        setTimeout(() => showModal = true, remainingTime);
    }
">

            <div x-cloak class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModal" role="dialog" @keydown.window.escape="showModal = false">
                <div class="absolute inset-0 transition-opacity duration-300 bg-slate-900/60" @click="showModal = false"
                    x-show="showModal" x-transition:enter="ease-out" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="ease-in" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
                <div class="relative max-w-md pt-10 pb-4 text-center transition-all duration-300 bg-white rounded-lg dark:bg-navy-700"
                    x-show="showModal" x-transition:enter="easy-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(0,1rem,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]" x-transition:leave="easy-in"
                    x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                    x-transition:leave-end="opacity-0 [transform:translate3d(0,1rem,0)]">

                    <div class="px-4 mt-4 ">
                        <div>
                            <h2 class="mb-4 text-xl font-bold">Donnez-nous votre avis</h2>
                            <p class="mb-4">Votre feedback est précieux pour nous aider à améliorer notre plateforme.</p>
                        </div>


                            <div class="flex items-center">
                                <p class="">Notez votre satisfaction :</p>
                                <div  class="flex justify-center">
                                 @for ($i = 1; $i <= 5; $i++) <span wire:click="$set('rating', {{ $i }})" class="cursor-pointer">
                                    <i class="{{ $i <= $rating ? 'text-yellow-500' : 'text-gray-300' }} fas fa-star"></i>
                                    </span>
                                    @endfor
                                </div>
                            </div>

                        <div class="mt-8">

                            <x-textarea wire:model.live='description'></x-textarea>
                        </div>
                    </div>
                    <div class="h-px my-4 mt-16 bg-slate-200 dark:bg-navy-500"></div>

                    <div class="space-x-3">
                        <x-button @click="showModal = false" rounded   label="Annuler"/>



                        <x-filament::button icon="heroicon-m-paper-airplane" wire:click='sendFeedback()'>
                                  Envoyer
                        </x-filament::button>

                    </div>
                </div>
            </div>

    </div>



</div>
