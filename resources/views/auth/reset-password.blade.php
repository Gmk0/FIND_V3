<x-guest-layout>


    <div class="min-h-screen bg-white dark:bg-gray-900 ">

        <nav
            class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
            <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
                <a href="{{url('/')}}"
                    class="leading-pro hover:scale-102 hover:shadow-soft-xs active:opacity-85 ease-soft-in text-xs tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 rounded-3.5xl mb-0 mr-1 inline-block cursor-pointer border-0 bg-transparent px-8 py-2 text-center align-middle font-bold uppercase text-white transition-all"><span
                        class=" to-orange-400">FIND</span>
                </a>

                <div navbar-menu
                    class="items-center flex-grow transition-all ease-soft duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-xl lg:flex lg:basis-auto">


                </div>
            </div>
        </nav>

        <main class="mt-0 transition-all duration-200 ease-soft-in-out">
            <section class="pt-4 mb-32 ">
                <div class="relative flex items-start pt-12 pb-56 mx-6 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl"
                    style="background-image: url('./images/logo/ff3.png')">
                    <span
                        class="absolute top-0 left-0 w-full h-full bg-center bg-cover opacity-50 gradient2 from-gray-900 to-slate-800"></span>
                    <div class="container z-10">
                        <div class="flex flex-wrap justify-center -mx-3">
                            <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                                <h1 class="mt-12 mb-2 text-white">{{__('')}}</h1>
                                <p class="text-white">{{__('Reinitialiser votre mot de passe')}}

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container ">
                    <div class="flex mx-2 -mt-20 md:-mt-50 lg:-mt-42">
                        <div
                            class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-7/12 xl:w-4/12">
                            <div
                                class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">



                                <div class="p-4">
                                    <div class="flex flex-wrap px-4">
                                        <x-validation-errors class="mb-2" />
                                    </div>




                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <div class="block">
                                            <x-jet-label for="email" value="{{ __('Email') }}" />
                                            <x-jet-input id="email" class="block w-full mt-1" type="email" name="email"
                                                :value="old('email', $request->email)" required autofocus
                                                autocomplete="username" />
                                        </div>

                                        <div class="mt-4">
                                            <x-jet-label for="password" value="{{ __('Password') }}" />
                                            <x-jet-input id="password" class="block w-full mt-1" type="password"
                                                name="password" required autocomplete="new-password" />
                                        </div>

                                        <div class="mt-4">
                                            <x-jet-label for="password_confirmation"
                                                value="{{ __('Confirm Password') }}" />
                                            <x-jet-input id="password_confirmation" class="block w-full mt-1"
                                                type="password" name="password_confirmation" required
                                                autocomplete="new-password" />
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <x-jet-button>
                                                {{ __('Reinitialiser') }}
                                                </x-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

            <x-footer-auth></x-footer-auth>
            <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        </main>





    </div>
</x-guest-layout>
