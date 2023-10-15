
    <x-confirmation-modal wire:model.defer="confirmModal">

        <x-slot name="title">
            Annuler la commande

        </x-slot>

        <x-slot name="content">
            Voulez-vous supprimer cette conversation?

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmModal')" wire:loading.attr="disabled">
                {{ __('Annuler') }}
            </x-secondary-button>

            <x-danger-button class="ml-3" wire:click="EffacerMessage()" wire:loading.attr="disabled">
                {{ __('Effacer') }}
            </x-danger-button>
        </x-slot>

    </x-confirmation-modal>

    <x-filament::modal id="proposer-price">
        <x-slot name="heading">
            Proposition Prix
        </x-slot>

        <form>
            <div class="mb-4">
                <label for="price" class="block mb-1 font-bold">Proposer un prix :</label>



                    <x-inputs.currency placeholder="Prix" icon="currency-dollar" thousands="." decimal="," precision="4"
                        wire:model="price" />


            </div>

            <x-button wire:click='PropososalPrice'> Proposer</x-button>
        </form>
    </x-filament::modal>

    <x-filament::modal id="changer-price">
        <x-slot name="heading">
          Changer Prix
        </x-slot>

        <div>
            <div class="mb-4">
                <label for="price" class="block mb-1 font-bold">Proposer un prix :</label>

              <x-inputs.currency placeholder="Prix " icon="currency-dollar" thousands="." decimal="," precision="4"
                    wire:model="price" />


            </div>

            <x-button positive wire:click='changePrice'>Changer</x-button>
        </div>
    </x-filament::modal>

