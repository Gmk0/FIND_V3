<div>
    <section x-cloak x-data="{ open: @entangle('showConsent') }" x-show="open"
        x-transition:enter=" transition ease-in duration-500"
        x-transition:enter-start="opacity-0 transform -translate-x-40"
        x-transition:enter-end="opacity-100 transform translate-x-0"
        x-transition:leave="transition ease-out duration-500"
        x-transition:leave-start="opacity-0 transform translate-x-0"
        x-transition:leave-end="opacity-0 transform -translate-x-60"
        class="fixed z-[200] max-w-md p-4 mx-auto bg-white border border-gray-200 dark:bg-gray-800 left-12 bottom-16 dark:border-gray-700 rounded-2xl">
        <h2 class="font-semibold text-gray-800 dark:text-white">🍪 cookies!</h2>

        <p class="mt-4 text-sm text-gray-600 dark:text-gray-300">
          En choisissant « Accepter  les cookies » , vous acceptez l'utilisation de cookies pour nous aider à fournir vous
        avec une meilleure expérience utilisateur et pour analyser l'utilisation du site Web .


        </p>



        <div class="grid grid-cols-2 gap-4 mt-4 shrink-0">
            <button wire:click="acceptCookies()" @click="open=!open"
                class=" text-xs bg-gray-900 font-medium rounded-lg hover:bg-gray-700 text-white px-4 py-2.5 duration-300 transition-colors focus:outline-none">
                Accepter cookies
            </button>



            <button @click="open=!open" wire:click="declineCookies()"
                class=" text-xs border text-gray-800 hover:bg-gray-100 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 font-medium rounded-lg px-4 py-2.5 duration-300 transition-colors focus:outline-none">
                fermer
            </button>
        </div>
    </section>
</div>
"
