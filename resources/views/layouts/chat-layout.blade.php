<!doctype html>
<html class='html2' lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

@include('include.head')


<body x-data
    class="@isset($isSidebarOpen) {{ $isSidebarOpen === 'true' ? 'is-sidebar-open' : '' }} @endisset is-header-blur  overflow-hidden has-min-sidebar">


    <x-notifications />


    <!-- App preloader-->
    <x-app-preloader></x-app-preloader>


    <!-- Page Wrapper -->


    <!-- Page Wrapper -->

    <main class="overflow-hidden">
        {{ $slot }}

    </main>






    <!--
  This is a place for Alpine.js Teleport feature
  @see https://alpinejs.dev/directives/teleport
-->


    <div id="x-teleport-target"></div>




@livewireScriptConfig

</body>

</html>
