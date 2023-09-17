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
                    <ul class="flex flex-col hidden pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
                        <li>
                            <a class="flex items-center px-4 py-2 mr-2 text-sm font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out lg:px-2 lg:hover:text-white/75"
                                aria-current="page" href="{{url('/')}}">
                                <i class="mr-1 text-white lg-max:text-slate-700 fa fa-chart-pie opacity-60"></i>
                                {{__('messages.Accueil')}}
                            </a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 mr-2 text-sm font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out lg:px-2 lg:hover:text-white/75"
                                href="{{url('/user/profile')}}">
                                <i class="mr-1 text-white lg-max:text-slate-700 fa fa-user opacity-60"></i>
                                {{__('messages.profile')}}
                            </a>
                        </li>

                        <li>
                            <a class="block px-4 py-2 mr-2 text-sm font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out lg:px-2 lg:hover:text-white/75"
                                href="{{url('/login')}}">
                                <i class="mr-1 text-white lg-max:text-slate-700 fas fa-key opacity-60"></i>
                                {{__('messages.SignIn')}}
                            </a>
                        </li>
                    </ul>


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
                                    <span>{{__('messages.enregistre')}}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container ">
                    <div class="flex mx-2 -mt-20 md:-mt-50 lg:-mt-42">
                        <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-7/12 xl:w-4/12">
                            <div
                                class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">



                                <div>
                                    <div class="flex flex-wrap px-4">
                                        <x-validation-errors class="mb-2" />
                                    </div>

                                    <div class="flex-auto px-6 py-2" x-data="">

                                      <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                                       {{ __('Mot de passe oublié ? Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous
                                        enverrons un
                                        lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
                                    </div>

                                    @if (session('status'))
                                    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                                        {{ session('status') }}
                                    </div>
                                    @endif

                                    <x-validation-errors class="mb-4" />

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="block">
                                            <x-jet-label for="email" value="{{ __('Email') }}" />
                                            <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus
                                                autocomplete="username" />
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                          <x-jet-button>
                                                {{ __('Lien de réinitialisation') }}
                                            </x-jet-button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <x-footer-auth></x-footer-auth>

        </main>





    </div>

</x-guest-layout>









