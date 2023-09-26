{{--<div>
    <div x-data="{linkHover: false}" style="" @mouseover="linkHover = true" @mouseleave="linkHover = false"
        class="overflow-hidden bg-white rounded-lg shadow-md dark:text-gray-200 dark:bg-gray-900">
        <div class="flex flex-row md:flex-col">
            <div x-data="{slide: 0,maxSlides: {{ count($service->files) }},showButton: false                                                                                     }"
                class="relative w-full h-full p-2 overflow-hidden rounded-lg md:w-full md:h-48 lg:p-0"
                @mouseover="showButton = true" @mouseleave="showButton = false">
                <div wire:ignore class="rounded-lg cursor-pointer lg:absolute lg:inset-0">
                    <template x-for="(image, index) in {{ json_encode($service->files) }}" :key="index">
                        <div x-show="slide === index"
                            class="w-full transition duration-500 ease-out bg-center bg-cover rounded-lg h-44 lg:absolute lg:top-0 lg:left-0 lg:h-44"
                            :style="'background-image: url(/storage/' + image + ')'">

                        </div>
                    </template>
                </div>
                <div x-bind:class="{'hidden':!showButton}">
                    <div class="absolute flex justify-between transform -translate-y-1/2 top-1/2 left-5 right-5" x-show="showButton">
                        <a href="#" class="btn btn-outline btn-circle btn-sm"
                            @click.prevent="slide = (slide - 1 + maxSlides) % maxSlides">❮</a>
                        <a href="#" class="btn btn-outline btn-circle btn-sm" @click.prevent="slide = (slide + 1) % maxSlides">❯</a>
                    </div>
                </div>


            </div>


            @livewire('web.card.service-add-card',['service'=>$service])
        </div>
    </div>
</div>
--}}

<div>
<div x-show="loading"
    class="lg:h-[23rem] h-52  overflow-hidden bg-white rounded-xl animate-pulse shadow-md dark:text-gray-200 dark:bg-gray-900">

</div>

<div x-cloak x-show="!loading" x-data="{linkHover: false}" @mouseover="linkHover = true" @mouseleave="linkHover = false"
    class="lg:h-[23rem] h-52  overflow-hidden bg-white rounded-xl shadow-md dark:text-gray-200 dark:bg-gray-900 ">

    <div class="flex flex-row lg:flex-col">

        <div x-data="{ activeSlide: 0, slides: [] }" x-init="slides = {{ json_encode($service->files) }}"
            class="relative group w-[48%] lg:w-full">

            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" class="p-3 ">
                    <div class="w-full h-48 transition duration-500 ease-out bg-center bg-cover border border-red-300 rounded-xl lg:h-40"
                        :style="'background-image: url(/storage/' + slide + ')'">
                    </div>
                </div>
            </template>

            <div class="px-4 ">
                <button x-cloak x-show="slides.length > 1 && activeSlide !== 0"
                    @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
                    class="absolute left-0 p-4 ml-3 transition-opacity opacity-0 top-1/2 btn-outline btn-circle btn-sm group-hover:opacity-100">
                    ❮
                    <!-- Left arrow -->
                </button>
                <button x-cloak x-show="slides.length > 1 && activeSlide !== slides.length - 1"
                    @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
                    class="absolute right-0 mr-3 transition-opacity opacity-0 top-1/2 group-hover:opacity-100 P-4 btn2 btn-outline btn-circle btn-sm">
                    ❯
                    <!-- Right arrow -->
                </button>

            </div>


            <!-- Indicators -->
            <div x-cloak x-show="slides.length > 1"
                class="absolute bottom-0 flex space-x-2 transform -translate-x-1/2 left-1/2">
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
