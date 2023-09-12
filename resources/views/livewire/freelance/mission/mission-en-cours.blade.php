<div x-data="{ isOpen:false,isLoading: true,showFilters: false,showSearch: false }"
    x-init="setTimeout(() => { isLoading = false }, 3000) " class="flex flex-col min-h-screen ">

    <div class="max-w-3xl mb-2">
        <h2 class="mb-2 text-lg font-semibold tracking-wide uppercase text-amber-600 lg:text-xl">Mission en Cours
        </h2>
    </div>
    <div>
        @include('include.bread-cumb-freelance',['mission'=>'mission','missionAccepter'=>'mission'])
    </div>

    <div>

        {{ $this->table }}

    </div>

</div>
