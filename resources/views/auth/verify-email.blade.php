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
                                <p class="text-white">{{__('Verififcation')}}

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
                                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Avant de continuer, pourriez-vous vérifier votre adresse e-mail en
                                        cliquant sur le lien que
                                        nous
                                        venons de
                                        vous envoyer par e-mail ? Si vous n\'avez pas reçu l\'e-mail, nous vous en
                                        enverrons volontiers un
                                        autre.') }}
                                    </div>

                                    @if (session('status') == 'verification-link-sent')
                                    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                                        {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous
                                        avez fournie dans
                                        vos
                                        paramètres de
                                        profil.') }}
                                    </div>
                                    @endif

                                    <div class="flex items-center justify-between mt-4">
                                        <form method="POST" action="{{ route('verification.send')}}">
                                            @csrf

                                            <div>
                                                <x-jet-button type="submit">
                                                    {{ __('Envoyer') }}
                                                </x-jet-button>
                                            </div>
                                        </form>

                                        <div>
                                            <a href="{{ route('profile.show') }}"
                                                class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                {{ __('Edit Profile') }}</a>

                                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                                @csrf

                                                <button type="submit"
                                                    class="ml-2 text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                                    {{ __('Log Out') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
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
