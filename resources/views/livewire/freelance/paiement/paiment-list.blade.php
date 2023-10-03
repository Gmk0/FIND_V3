<div class="min-h-screen p-4">

    <div class="max-w-3xl mb-2">
            <h2 class="mb-2 text-lg font-semibold tracking-wide uppercase text-amber-600 lg:text-xl">Paiement
            </h2>
        </div>
        <div>
            @include('include.bread-cumb-freelance',['paiementEffectuer'=>'Paiement effectuer'])
        </div>


   <div x-show="loading" class="w-full bg-gray-100 rounded-md h-72 animate-pulse dark:bg-gray-800">

</div>
<div x-show="!loading" x-cloak class="my-4">
    {{$this->table}}

</div>
</div>
