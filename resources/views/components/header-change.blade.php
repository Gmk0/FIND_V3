

@props(['name'])


<span x-show="isHome" :class="isWhite?'dark:!text-white':'!text-white dark:!text-white'">
    {{$name}}

</span>
<span x-cloak x-show="!isHome" class="text-dark">
   {{$name}}
</span>
