

<div>
    <div x-show="loading"
        class="lg:h-[23rem] h-52  overflow-hidden bg-white rounded-xl animate-pulse shadow-md dark:text-gray-200 dark:bg-gray-900">

    </div>

    <div x-cloak x-show="!loading" x-data="{linkHover: false}" @mouseover="linkHover = true" @mouseleave="linkHover = false"
         class="lg:h-[23rem] h-52  overflow-hidden bg-white rounded-xl shadow-md dark:text-gray-200 dark:bg-gray-900 ">

        <div class="flex relative flex-row lg:flex-col">

            <div x-data="{ activeSlide: 0, slides: [] }" x-init="slides = {{ json_encode($service->files) }}"class=" relative group w-[48%] lg:w-full">

                    <!-- Slides -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <div x-show="activeSlide === index" class="p-3 ">

                           <div class="w-full transition border duration-500 ease-out rounded-xl h-48 lg:h-40">

                            <a class="example-image-link" :href="'/storage/' + slide"
                                data-lightbox="{{$service->id}}" data-title="Presentation.">
                                <img :src="'/storage/' + slide" alt="Description de l'image"
                                class="w-full h-full object-cover object-center rounded-xl">
                                </a>


                        </div>
                        </div>
                    </template>

                    <div class="px-4 ">
                        <div x-cloak x-show="slides.length > 1 && activeSlide !== 0"
                            @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                            class="absolute top-1/2 left-0 ml-3 btn-outline btn-circle btn-sm p-4 opacity-0 group-hover:opacity-100  btn2 transition-opacity">
                            ❮
                            <!-- Left arrow -->
                        </div>
                        <button x-cloak x-show="slides.length > 1 && activeSlide !== slides.length - 1"
                            @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                            class="absolute top-1/2 right-0 mr-3 opacity-0 group-hover:opacity-100 P-4 transition-opacity btn2 btn-outline btn-circle btn-sm">
                            ❯
                            <!-- Right arrow -->
                        </button>

                    </div>


                    <!-- Indicators -->
                    <div x-cloak x-show="slides.length > 1"
                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex space-x-2">
                        <template x-for="(slide, index) in slides" :key="index">
                            <span :class="activeSlide === index ? 'bg-red-500' : 'bg-gray-300'"
                                class="block w-2 h-2 rounded-full"></span>
                        </template>
                    </div>

            </div>



            @livewire('web.card.service-add-card',['service'=>$service])

        </div>
    </div>
</div>


