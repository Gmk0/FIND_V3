<div>

    <div class="flex flex-col items-start max-w-3xl py-3 mb-3 space-x-4 lg:py-4">
        <h2 class="mb-4 text-xl font-semibold tracking-wide uppercase text-amber-600">Modification </h2>

        <div>
            @include('include.bread-cumb-freelance',['serviceName'=>'service','serviceEdit'=>$record->service_numero])
        </div>
    </div>
    <form wire:submit="edit">
        {{ $this->form }}

       <div class="flex items-center justify-center mt-4">


            <x-filament::button size="lg" type="submit">
                <span wire:loading.remove wire:target='edit'>Proceder a l'ajout</span>
                <span wire:loading wire:target='edit'>Ajout....</span>
            </x-filament::button>




        </div>

    </form>

    <x-filament-actions::modals />
</div>
