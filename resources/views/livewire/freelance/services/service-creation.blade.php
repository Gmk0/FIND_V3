<div class="">
    <div class="flex flex-col items-start max-w-3xl py-3 mb-3 space-x-4 lg:py-4">
        <h2 class="mb-4 text-xl font-semibold tracking-wide uppercase text-amber-600">MServices</h2>

        <div>
            @include('include.bread-cumb-freelance',['serviceName'=>'service','serviceCreate'=>'Creation'])
        </div>
    </div>



    <div>
        <form wire:submit="create">
            {{ $this->form }}


        </form>

        <x-filament-actions::modals />
    </div>
</div>
