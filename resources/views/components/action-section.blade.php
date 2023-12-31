<div {{ $attributes->merge(['class' => 'flex flex-col md:gap-6']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="px-4 py-5 bg-white shadow sm:p-6 dark:bg-navy-800 sm:rounded-lg">
            {{ $content }}
        </div>
    </div>
</div>
