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
                <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
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
        <section class="min-h-screen pt-4 mb-32">
            <div class="relative flex items-start pt-12 pb-56 mx-6 overflow-hidden bg-center bg-cover min-h-50-screen rounded-xl"
                style="background-image: url('./images/logo/ff3.png')">
                <span
                    class="absolute top-0 left-0 w-full h-full bg-center bg-cover opacity-50 gradient2 from-gray-900 to-slate-800"></span>
                <div class="container z-10">
                    <div class="flex flex-wrap justify-center -mx-3">
                        <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                            <h1 class="mt-12 mb-2 text-white">{{__('messages.Welcome')}}</h1>
                            <p class="text-white">{{__('messages.messageTitle')}}
                                <span>{{__('messages.enregistre')}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container ">
                <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
                    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                        <div
                            class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                                <h5>{{__('Ajouter un mot de passe et Numero')}}</h5>
                            </div>
                            <div class="flex flex-wrap px-3 -mx-3 sm:px-6 xl:px-12">

                            </div>


                            <div>
                                <div class="flex flex-wrap px-4">
                                    <x-validation-errors class="mb-2" />
                                </div>

                                <div class="flex-auto px-6 py-2" x-data="">

                                    <form role="form text-left" wire:submit.prevent='register'>

                                        {{$this->form}}



                                        <div class="text-center">
                                            <button type="submit" wire:loading.attr='disabled'
                                                class="inline-block w-full px-6 py-3 mt-6 mb-2 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 gradient hover:border-slate-700 hover:bg-slate-700 hover:text-white">

                                                <span>{{__('Continuer')}}</span>



                                            </button>

                                        </div>

                                    </form>
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


    <x-filament-actions::modals />



</div>
