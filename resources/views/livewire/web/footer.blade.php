<div class="w-full lg:bg-base-200 bg-gray-900">

    <div class="text-white border-t border-gray-800 bg-gray-900 md:hidden">

        <!-- Footer Middle -->
        <div class="container flex flex-col p-4 mx-auto overflow-hidden lg:flex-row">
            <div class="w-full p-2 mx-auto">
                <!-- Accordions -->

                <div x-data="{open:false}" class="relative mb-3">
                    <h6 class="mb-0">
                        <button @click="open=!open"
                            class="relative flex items-center w-full p-4 text-base font-semibold text-left transition-all ease-in border-solid cursor-pointer text-gray-50 border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                            data-collapse-target="animated-collapse-1">
                            <span>Categories</span>
                            <i :class="open? 'rotate-180 transition-transform':''"
                                class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                        </button>
                    </h6>
                    <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                        <div class="px-6 overflow-hidden leading-normal">
                            <ul class="flex flex-col w-full p-0 space-y-2 text-left list-none list-inside text-gray-50">

                                @foreach($categories as $category)
                                <li><a href="{{route('categoryByName',[$category->name])}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-200">{{$category->name}}</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div x-data="{open:false}" class="relative mb-3">
                    <h6 class="mb-0">
                        <button @click="open=!open"
                            class="relative flex items-center w-full p-4 text-base font-semibold text-left transition-all ease-in border-solid cursor-pointer text-gray-50 border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                            data-collapse-target="animated-collapse-1">
                            <span>A propos</span>
                            <i :class="open? 'rotate-180 transition-transform':''"
                                class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                        </button>
                    </h6>
                    <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                        <div class="px-6 overflow-hidden leading-normal ">
                            <ul class="flex flex-col w-full p-0 text-left list-none text-gray-50">
                                <li><a href="{{route('policy.show')}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100">Privacy
                                        Policy</a></li>
                                <li><a href="{{url('/contact')}}" wire:navigate
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100 ">Contact</a>
                                </li>

                                <li><a href="{{route('terms.show')}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100">Terms
                                        of
                                        Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div x-data="{open:false}" class="relative hidden mb-3">
                    <h6 class="mb-0">
                        <button @click="open=!open"
                            class="relative flex items-center w-full p-4 text-base font-semibold text-left transition-all ease-in border-solid cursor-pointer text-gray-50 border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                            data-collapse-target="animated-collapse-1">
                            <span>Guides</span>
                            <i :class="open? 'rotate-180 transition-transform':''"
                                class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                        </button>
                    </h6>
                    <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                        <div class="px-6 overflow-hidden leading-normal">
                            <ul class="flex flex-col w-full p-0 font-thin text-left list-none text-gray-50">
                                <li><a href="{{url('/find-freelance')}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100">Freelance</a>
                                </li>
                                <li><a href="{{url('/user/create_project')}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100">
                                        Mission</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div x-data="{open:false}" class="relative mb-3">
                    <h6 class="mb-0">
                        <button @click="open=!open"
                            class="relative flex items-center w-full p-4 text-base font-semibold text-left transition-all ease-in border-solid cursor-pointer text-gray-50 border-slate-100 dark:text-gray-500 rounded-t-1 group text-dark-500"
                            data-collapse-target="animated-collapse-1">
                            <span>Freelance</span>
                            <i :class="open? 'rotate-180 transition-transform':''"
                                class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down "></i>
                        </button>
                    </h6>
                    <div x-show="open" x-collapse class="overflow-hidden transition-all duration-300 ease-in-out ">
                        <div class="px-6 overflow-hidden leading-normal ">
                            <ul class="flex flex-col w-full p-0  text-left list-none text-gray-50">
                                <li><a href="{{url('/find-freelance')}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100">Freelance</a>
                                </li>
                                <li><a href="{{url('createMision')}}"
                                        class="inline-block py-2 pl-3 pr-5 text-white hover:text-gray-800 dark:hover:text-gray-100">
                                        Mission</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="flex flex-col items-center justify-center p-6 mt-4 text-gray-600 md:flex-row">

            <div
                class="flex flex-col flex-wrap gap-6 mt-6 border-t border-gray-600 sm:mt-0 sm:flex-row sm:items-center">


                <div class="flex gap-6 p-2">
                    <a href="#" target="blank" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-dribbble"></span>
                    </a>
                    <a href="https://twitter.com/find_freelance_?s=11&t=qv6NIovEcQsLxmQv9mo_Zw" target="blank"
                        aria-label="twitter" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="https://instagram.com/find_freelance?igshid=YmMyMTA2M2Y=" target="blank"
                        aria-label="medium" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>


                    <a href="#" target="blank" aria-label="twitter" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-pinterest"></span>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=100087893680900&mibextid=LQQJ4d" target="blank"
                        aria-label="medium" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-facebook"></span>
                    </a>


                </div>
                <div class="flex gap-6 mx-auto ">

                    <a href="" class="px-3 py-2 hover:text-primary">

                        <span class="text-sm fab fa-dollar">USD</span>
                    </a>
                </div>
            </div>
            <div class="flex items-center justify-between mt-2 border-t border-gray-800">
                <img src="/images/logo/find_02.png" alt="logo find" class="h-8" />
                <div class="flex flex-col items-center justify-center p-3 mt-2 text-gray-600 md:flex-row">Copyright ©
                    @php
                    $date= date('Y');
                    @endphp
                    Find {{$date}}
                </div>
            </div>



        </div>
    </div>

    <!-- FOOTER 2 DESKTOP -->

    <div class="hidden md:flex flex-col">
        <footer class="p-10 footer bg-base-200 text-base-content">
            <div>

                <img src="/images/logo/find_02.png" alt="logo find" class="h-8" />
                <p>FIND Ltd.<br />Providing reliable tech since 2020</p>
            </div>
            <div>
                <span class="footer-title">Categories</span>
                <div class="grid grid-cols-2 gap-4">

                    @foreach($categories as $category)
                    <a href="{{route('categoryByName',[$category->name])}}"
                        class="link link-hover">{{$category->name}}</a>
                    @endforeach



                </div>

            </div>
            <div>
                <span class="footer-title">Company</span>
                <a href="{{('apropos')}}" wire:navigate class="link link-hover">Apropos de nous </a>
                <a href="{{url('/contact')}}" wire:navigate class="link link-hover">Contact</a>
                <a href="{{url('/faq')}}" wire:navigate class="link link-hover">FaQ</a>

            </div>
            <div>
                <span class="footer-title">Legal</span>
                <a href="{{route('terms.show')}}" class="link link-hover">Terms of use</a>
                <a href="{{route('policy.show')}}" class="link link-hover">Privacy policy</a>


            </div>
        </footer>
        <div class="h-12  border-t border-gray-100">
            <div class="flex  items-center justify-center gap-6 border-t border-gray-600 sm:mt-0 sm:flex-row sm:items-center">

                <div class="flex items-center gap-6 p-2">

                    <a href="https://twitter.com/find_freelance_?s=11&t=qv6NIovEcQsLxmQv9mo_Zw" target="blank" aria-label="twitter"
                        class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-twitter"></span>
                    </a>
                    <a href="https://instagram.com/find_freelance?igshid=YmMyMTA2M2Y=" target="blank" aria-label="medium"
                        class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-instagram"></span>
                    </a>


                    <a href="#" target="blank" aria-label="twitter" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-linkedin"></span>
                    </a>
                    <a href="https://www.facebook.com/profile.php?id=100087893680900&mibextid=LQQJ4d" target="blank"
                        aria-label="medium" class="px-2 hover:text-primary">
                        <span class="text-lg fab fa-facebook"></span>
                    </a>
                    <a href="" class="px-3 py-2 hover:text-primary">

                        <span class="text-sm fab fa-dollar">USD</span>
                    </a>


                </div>

            </div>


        </div>

    </div>



    <!-- Footer Middle -->


    <!-- Footer Bottom -->

</div>
