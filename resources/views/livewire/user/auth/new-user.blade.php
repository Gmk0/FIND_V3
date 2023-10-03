<div>

    <div class="flex-auto px-6 py-2" x-data="">

        <form role="form text-left" wire:submit.prevent='register'>

            {{$this->form}}


            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox wire:model.defer="terms" id="terms" required />

                        <div class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'"
                                class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Terms
                                of
                                Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'"
                                class="text-sm text-gray-600 underline hover:text-gray-900">'.__('Privacy
                                Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
            @endif

            <div class="flex flex-wrap px-4">
                <x-validation-errors class="mb-4" />
            </div>
            <div class="text-center">
                <button type="submit" wire:loading.attr='disabled'
                    class="inline-block w-full px-6 py-3 mt-6 mb-2 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 gradient hover:border-slate-700 hover:bg-slate-700 hover:text-white">

                    <span >{{__('messages.enregistre')}}</span>



                </button>

            </div>
            <p class="mt-4 mb-0 text-sm leading-normal">{{__('messages.AlreadyMessages')}}<a href="{{url('/login')}}"
                    class="relative z-10 font-semibold text-transparent bg-gradient-to-tl from-orange-600 to-orange-400 bg-clip-text">{{__('messages.SignIn')}}</a>
            </p>
        </form>


    </div>
</div>
