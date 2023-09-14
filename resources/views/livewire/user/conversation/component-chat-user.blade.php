<div class="flex overflow-hidden min-h-100vh grow bg-slate-50 dark:bg-navy-900" x-cloak>


    <div class="overflow-hidden">
        <div class="sidebar print:hidden">
            <!-- Main Sidebar -->
            <x-app-partials.main-user-sidebar></x-app-partials.main-user-sidebar>

            <!-- Sidebar Panel -->


            @livewire('user.conversation.conversation-component-user')


        </div>
    </div>



    @livewire('user.conversation.body-message')

</div>
