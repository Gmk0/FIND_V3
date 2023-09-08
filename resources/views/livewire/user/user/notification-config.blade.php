<div>
    <div class="p-4 mb-6 bg-white rounded-md">
        <h2 class="p-4 mb-2 text-lg font-medium dark:text-gray-200">Paramètres de notification</h2>
        <div class="p-4 space-y-4">


            <div class="flex items-center">

                <label>

                    <x-filament::input.checkbox wire:model.live="enableEmail" wire:change="toogle()" />
                    <span class="dark:text-gray-200">
                                Recevoir des notifications par e-mail
                                </span>

                </label>

            </div>
            <div class="flex items-center">

                <label>

                    <x-filament::input.checkbox wire:model.live="enablePush" wire:change="toogle()" />
                    <span class="dark:text-gray-200">
                        Recevoir des notifications push
                    </span>

                </label>


            </div>
            <div class="flex items-center">


                <label>

                    <x-filament::input.checkbox wire:model="enablePhone" wire:change="toogle()" />
                     <span class="dark:text-gray-200">
                        Recevoir des notifications par telephone
                    </span>

                </label>


            </div>

            <div class="flex items-center">

                <label>

                    <x-filament::input.checkbox  wire:change="toogle()" />
                     <span class="dark:text-gray-200">
                        Recevoir des notifications par telephone
                    </span>

                </label>


            </div>
            <div class="flex items-center">

                <label>

                    <x-filament::input.checkbox wire:model.live='enableInvoie' wire:change="toogle()" />
                     <span class="dark:text-gray-200">
                        Recevoir des facture par mail
                    </span>

                </label>

            </div>
        </div>

    </div>
</div>
