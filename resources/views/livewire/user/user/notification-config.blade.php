<div>
    <div class="p-4 mb-6 bg-white rounded-md dark:bg-navy-800">
        <h2 class="p-4 mb-2 text-lg font-medium dark:text-gray-200">Paramètres de notification</h2>
        <div class="p-4 space-y-4">


            <div class="flex items-center">

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" wire:model.live="enablePush" x-on:change='$wire.toogle()'>
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-400 dark:text-gray-500">Recevoir des notifications par push</span>
                    </label>
                </div>


            </div>

            <div class="flex items-center">

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" wire:model.live="enableEmail" x-on:change='$wire.toogle()'>
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-400 dark:text-gray-500">Recevoir des notifications par email
                            </span>
                    </label>
                </div>


            </div>

            <div class="flex items-center">

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" wire:model.live="enablePhone" x-on:change='$wire.toogle()'>
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-400 dark:text-gray-500">Recevoir des notifications par telephone
                        </span>
                    </label>
                </div>


            </div>
            <div class="flex items-center">

                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" wire:model.live="enableInvoie" x-on:change='$wire.toogle()'>
                        <div
                            class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-400 dark:text-gray-500">Recevoir les facture par
                            telephone
                        </span>
                    </label>
                </div>


            </div>



        </div>

    </div>
</div>
