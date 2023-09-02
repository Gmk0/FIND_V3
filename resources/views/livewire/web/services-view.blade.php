<div>
    <div class="flex flex-col min-h-screen pt-8 mb-6">

        <div class="flex flex-col p-2 mx-6 my-8 bg-white rounded-lg md:min-h-64 dark:bg-gray-800">
            <div class="mb-4">
                <h3 class="mb-4 font-serif text-xl leading-snug text-center dark:text-gray-400 text-slate-800">
                    Découvrez une communauté de freelances talentueux prêts à donner vie à vos projets.
                    Trouvez le service parfait pour vous, choisissez parmi une large sélection de compétences et laissez
                    notre
                    communauté de professionnels vous aider à réaliser vos rêves.
                </h3>
            </div>
            <div class="">
                <div class="flex flex-wrap gap-2" x-data="{ splide: null }" x-init="() => {
                     splide = new Splide('.splide', {
                         type: 'loop',
                         perPage: 4,
                         perMove: 1,
                         autoplay: true,
                         interval: 5000,
                         gap: '1rem',
                         breakpoints: {
                        640: {
                        perPage: 2,
                        },
                        768: {
                        perPage: 3,
                        },
                        1024: {
                        perPage: 5,
                        },
                        },
                     }).mount();
                 }">
                    <div class="w-full splide">
                        <div class="splide__track">
                            <div class="splide__list">
                                @foreach ($categories as $category)
                                <div class="splide__slide">
                                    <a href="{{ route('categoryByName', [$category->name]) }}"
                                        class="flex flex-col items-center px-4 py-2.5 duration-200 border shadow-lg cursor-pointer bg-gray-50 group rounded-xl border-amber-500/10 shadow-amber-300/10 hover:bg-amber-600">
                                        <h4
                                            class="mt-3 mb-1 md:text-[12px] text-[10px] font-semibold text-slate-600 duration-200 group-hover:text-white">
                                            {{ $category->name }}
                                        </h4>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-8 mx-6 swiper"
            x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: '4',autoplay:true, breakpoints:{0:{slidesPerView:1,},520:{slidesPerView:2,},950:{slidesPerView:3,},1100:{slidesPerView:4,}}, spaceBetween: 15, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
            <div class="flex items-center justify-between">
                <p class="text-xl font-medium text-slate-700 dark:text-navy-100">
                    Les Service populaire
                </p>
                <div class="flex gap-4">



                    <button
                        class="w-10 h-10 p-0 rounded-full btn prev-btn hover:bg-slate-300/20 focus:bg-slate-300/20 dark:active:bg-slate-300/25 active:bg-slate-100/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 p-0 rounded-full btn next-btn hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-5 swiper-wrapper" x-data="{ selected: 'slide-1' }">






                @forelse ($servicesBest as $servicesBest)
                <div class="md:mx-0 swiper-slide ">
                    <div class="flex flex-col mb-2 overflow-hidden bg-white rounded-lg shadow-md w-72 dark:bg-gray-800 md:mb-0">


                        <div x-data="{
                                                                                slide: 0,
                                                                                maxSlides: {{ count($servicesBest->files) }},
                                                                                showButton: false
                                                                                }" class="relative w-full h-48 overflow-hidden"
                            @mouseover="showButton = true" @mouseleave="showButton = false">
                            <div class="absolute inset-0 cursor-pointer">
                                <template x-for="(image, index) in {{ json_encode($servicesBest->files) }}" :key="index">
                                    <div x-show="slide === index"
                                        class="absolute top-0 left-0 w-full h-48 transition duration-500 ease-out bg-center bg-cover"
                                        :style="'background-image: url(/storage/' + image + ')'">

                                    </div>
                                </template>
                            </div>

                           <div class="absolute flex justify-between transform -translate-y-1/2 top-1/2 left-5 right-5" x-show="showButton">
                            <a href="#" class="btn btn-outline btn-circle btn-sm"
                                @click.prevent="slide = (slide - 1 + maxSlides) % maxSlides">❮</a>
                            <a href="#" class="btn btn-outline btn-circle btn-sm" @click.prevent="slide = (slide + 1) % maxSlides">❯</a>
                        </div>
                        </div>




                        @livewire("web.card.service-add-card-two",['service'=>$servicesBest],key($servicesBest->id))


                    </div>

                </div>
                @empty

                @endforelse






            </div>
        </div>




        <div class="py-8 mx-6 swiper"
            x-init="$nextTick(() => $el._x_swiper = new Swiper($el, { slidesPerView: '4',autoplay:true, breakpoints:{0:{slidesPerView:1,},520:{slidesPerView:2,},950:{slidesPerView:3,},1100:{slidesPerView:4,}}, spaceBetween: 15, navigation: { nextEl: '.next-btn', prevEl: '.prev-btn' } }))">
            <div class="flex items-center justify-between">
                <p class="font-medium md:text-xl text-slate-700 dark:text-navy-100">
                    Les Freelance populaire
                </p>
                <div class="flex gap-4">
                    <button
                        class="w-10 h-10 p-0 rounded-full btn prev-btn hover:bg-slate-300/20 focus:bg-slate-300/20 dark:active:bg-slate-300/25 active:bg-slate-100/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        class="w-10 h-10 p-0 rounded-full btn next-btn hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 disabled:pointer-events-none disabled:select-none disabled:opacity-60 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-5 swiper-wrapper" x-data="{ selected: 'slide-1' }">
                @foreach ($freelances as $freelance)
                <div class="swiper-slide">
                    @livewire('Web.card.freelance-card',['freelance' => $freelance], key($freelance->id))
                </div>
                @endforeach
            </div>
        </div>


        <div class="flex flex-col p-2 mx-4 mt-4 bg-white rounded-lg md:mx-6 justify-beetwen">

            <div class="mb-4">
                <h1 class="text-xl font-bold text-gray-800 dark:text-gray-300">Services que vous pourriez aimer</h1>
            </div>



            <div
                class="grid grid-cols-1 gap-4 mx-1 lg:max-w-5xl lg:mx-2 lg:p-4 md:grid-cols-3 lg:md:grid-cols-4 md:gap-4">
                @forelse ($services as $service)



                @livewire('web.card.service-card',['service' => $service], key($service->id))

                @empty

                @endforelse




            </div>

        </div>


        <div
            class="flex flex-col items-center justify-center p-6 mx-6 mt-4 bg-white rounded-lg shadow-lg min-h-64 lg:flex-row lg:justify-start">
            <img src="/images/hero/team.svg" alt="Illustration de projet"
                class="hidden w-1/2 h-64 mb-4 rounded-md lg:mr-6 md:block lg:mb-0">
            <div class="text-center lg:text-left">
                <h2 class="mb-2 text-xl font-semibold text-gray-800">Vous ne trouvez pas ce que vous cherchez ?</h2>
                <p class="mb-4 dark:text-gray-300">Si vous avez besoin d'un service particulier, n'hésitez pas à
                    soumettre
                    votre projet et
                    notre communauté de freelances
                    talentueux sera ravie de vous aider..</p>
                <a href="{{route('createProject')}}"
                    class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">Soumettre un
                    projet</a>
            </div>
        </div>
    </div>

</div>
