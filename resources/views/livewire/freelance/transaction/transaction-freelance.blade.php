<div class="min-h-screen">

    <div class="max-w-3xl mb-2">
        <h2 class="mb-2 text-lg font-semibold tracking-wide uppercase text-amber-600 lg:text-xl">Transaction
        </h2>
    </div>
    <div>
        @include('include.bread-cumb-freelance',['transaction'=>'transaction'])
    </div>

    <div>

        {{ $this->table }}

    </div>

</div>
