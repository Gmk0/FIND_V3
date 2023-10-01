@auth
    <livewire:web.other.feedback-component/>
    @livewire('livewire-ui-spotlight')
@endauth


<div x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 200) ? true : false">
    <!-- Bouton Retour en haut -->
    <button x-cloak x-show="showButton" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed p-2 text-white transition duration-300 ease-in-out rounded-full z-[60] shadow-lg bottom-4 right-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:shadow-xl focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</div>

<livewire:web.other.cookie  />



@livewireScriptConfig

