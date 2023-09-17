<x-action-section>
   <x-slot name="title">
    <span class="text-gray-800"> {{ __('Browser Sessions') }}</span>
</x-slot>

<x-slot name="description">
    <span class="text-gray-800"> {{ __("Gérez et déconnectez vos sessions actives sur d'autres navigateurs et
        appareils.") }}</span>
</x-slot>

    <x-slot name="content">
   <div class="max-w-xl text-sm text-gray-600 dark:text-gray-200">
        {{ __('Si nécessaire, vous pouvez vous déconnecter de toutes vos autres sessions de navigation sur tous vos
        appareils.
        Certaines de vos sessions récentes sont répertoriées ci-dessous ; cependant, cette liste peut ne pas être
        exhaustive. Si
        vous pensez que votre compte a été compromis, vous devez également mettre à jour votre mot de passe..') }}
    </div>

       <div class="flex items-center mt-5">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                {{ __('Se déconnecter des autres sessions du navigateur ') }}
            </x-jet-button>

            <x-action-message class="ml-3" on="loggedOut">
                {{ __('Done.') }}
            </x-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <x-dialog-modal wire:model.live="confirmingLogout">
            <x-slot name="title">
                {{ __('Se déconnecter des autres sessions du navigateur') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Veuillez entrer votre mot de passe pour confirmer que vous souhaitez vous déconnecter de vos
                autres sessions de
                navigation
                sur tous vos appareils.') }}

                <div class="mt-4" x-data="{}"
                    x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="block w-3/4 mt-1" placeholder="{{ __('Password') }}" x-ref="password"
                        wire:model="password" wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <x-jet-button class="ml-3" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    {{ __('Se déconnecter des autres sessions du navigateur') }}
                </x-jet-button>
            </x-slot>
        </x-dialog-modal>
    </x-slot>
</x-action-section>
