<!doctype html>
<html class="html2" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('include.head')


<body x-data
    class="is-sidebar-open' @isset($isHeaderBlur) {{ $isHeaderBlur === 'true' ? 'is-header-blur' : '' }} @endisset @isset($hasMinSidebar) {{ $hasMinSidebar === 'true' ? 'has-min-sidebar' : '' }} @endisset  @isset($headerSticky) {{ $headerSticky === 'false' ? 'is-header-not-sticky' : '' }} @endisset">
   {{-- <x-dialog />
    <x-notifications position='bottom-right' />--}}
    <!-- App preloader-->

    <x-app-preloader></x-app-preloader>
    <!-- Page Wrapper -->
    <div x-data="{loading : true}"
     x-init="setTimeout(() => { loading = false }, 2000)"  id="root" class="flex min-h-100vh grow bg-slate-50 dark:bg-navy-900" x-cloak>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Main Sidebar -->
            <x-app-partials.main-sidebar></x-app-partials.main-sidebar>

            <!-- Sidebar Panel -->

            @livewire('freelance.other.sidebar-panel')
        </div>

        <!-- App Header -->
        <x-app-partials.header></x-app-partials.header>

        <!-- Mobile Searchbar -->
        {{-- <x-app-partials.mobile-searchbar></x-app-partials.mobile-searchbar>--}}

    

        @livewire('freelance.other.panel-slide')

        <div x-init="setTimeout(() => { loading = false }, 2000)" class="main-content pt-4 w-full px-[var(--margin-x)] pb-8">
            {{ $slot }}


            <div>
            <x-footer-user></x-footer-user>
            </div>
        </div>







    </div>

    <!--
  This is a place for Alpine.js Teleport feature
  @see https://alpinejs.dev/directives/teleport
-->



@include('include.footer')








</body>

</html>
