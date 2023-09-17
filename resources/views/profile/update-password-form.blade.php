


<x-form-section submit="updatePassword">
    <x-slot name="title">
        <span class="text-gray-800"> {{ __('profiles.UpdatePassword') }}</span>
    </x-slot>

    <x-slot name="description">
        <span class="text-gray-800">{{ __('profiles.updatePasswordDescription') }}</span>

    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">

            <x-inputs.password label="{{ __('profiles.CurrentPassword') }}" type="password"
                wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">

            <x-inputs.password label="{{ __('profiles.NewPassword') }}" type="password" wire:model.defer="state.password"
                autocomplete="current-password" />

            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">

            <x-inputs.password label="{{ __('profiles.ConfirmPassword') }}" type="password"
                wire:model.defer="state.password_confirmation" autocomplete="current-password" />


            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions" class="dark:bg-gray-800">
        <x-action-message class="mr-3 " on="saved">
            {{ __('profiles.Saved') }}
        </x-action-message>

        <x-jet-button>
            {{ __('profiles.Save') }}
        </x-jet-button>
    </x-slot>

</x-form-section>
