<footer class="py-12">
    <div class="container">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
                <a href="{{url('/services')}}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
                    Servives
                </a>
                <a href="{{url('/apropos')}}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> A
                    propos
                </a>
                <a href="{{url('/categories')}}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12">
                    Categories
                </a>

                <a href="{{url('/faq')}}" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> FaQ
                </a>


            </div>
            <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
                <a href="" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-dribbble"></span>
                </a>
                <a href="" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-twitter"></span>
                </a>
                <a href="" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-instagram"></span>
                </a>
                <a href="" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-pinterest"></span>
                </a>
                <a href="" target="_blank" class="mr-6 text-slate-400">
                    <span class="text-lg fab fa-github"></span>
                </a>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                <p class="mb-0 text-slate-400">
                    Copyright ©
                 @php
                $date= date('Y');
                @endphp
                    Find {{$date}}
                </p>

            </div>

        </div>
        <div class="flex flex-wrap mt-8 -mx-3">
            <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
                <label class="relative inline-flex items-center mb-5 cursor-pointer">
                    <input type="checkbox" x-model="dark" @click="toggleTheme" class="sr-only peer">
                    <div
                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                    </div>
                    <div class="px-2">
                        <template x-if="!dark">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>

                        </template>
                        <template x-if="dark">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    clip-rule="evenodd"></path>
                            </svg>

                        </template>
                    </div>

                </label>

            </div>

        </div>

    </div>
</footer>
