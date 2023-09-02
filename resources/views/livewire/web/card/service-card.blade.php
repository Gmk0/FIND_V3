<div>
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
