<ul class="py-6 scrollbar-sm ">

    <li class="relative px-6 py-3">
        @if(request()->routeIs('dashboardUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav wire:navigate href="{{route('dashboardUser')}}" :active="request()->routeIs('dashboardUser')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
            </svg>
            <span class="ml-4">Tableau de Bord</span>
        </x-asideLinkNav>

    </li>

    <li class="relative px-6 py-3">
        @if(request()->routeIs('MissionUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav wire:navigate href="{{route('MissionUser')}}" :active="request()->routeIs('MissionUser')">
            <ion-icon name="albums-outline" class="w-6 h-6"></ion-icon>
            <span class="ml-4">Mission</span>
        </x-asideLinkNav>

    </li>
    <li class="relative px-6 py-3">

        @if(request()->routeIs('commandeUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif


        <x-asideLinkNav wire:navigate href="{{route('commandeUser')}}" :active="request()->routeIs('commandeUser')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
            </svg>

            <span class="ml-4">Commande</span>
        </x-asideLinkNav>

    </li>
    <li class="relative px-6 py-3">

        @if(request()->routeIs('favorisUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif


        <x-asideLinkNav wire:navigate href="{{route('favorisUser')}}" :active="request()->routeIs('favorisUser')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
            </svg>
            <span class="ml-4">Favoris</span>
        </x-asideLinkNav>

    </li>



    <li class="relative px-6 py-3">

        @if(request()->routeIs('MessageUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav href="{{route('MessageUser')}}" :active="request()->routeIs('MessageUser')">
           <ion-icon name="mail-outline" class="w-6 h-6"></ion-icon>
            <span class="ml-4">Messages</span>
        </x-asideLinkNav>



    </li>

    <li class="relative px-6 py-3">

        @if(request()->routeIs('transactionUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav wire:navigate href="{{route('transactionUser')}}" :active="request()->routeIs('transactionUser')">
            <ion-icon name="card-outline" class="w-6 h-6"></ion-icon>
            <span class="ml-4">Transactions</span>
        </x-asideLinkNav>



    </li>
    <li class="relative px-6 py-3">


        @if(request()->routeIs('paiementUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav href="{{--route('paiementUser')--}}" :active="request()->routeIs('paiementUser')">

            <ion-icon name="cash-outline" class="w-6 h-6"></ion-icon>
            <span class="ml-4">Paiment</span>
        </x-asideLinkNav>
    </li>

    <li class="relative px-6 py-3">


        @if(request()->routeIs('assistanceUser'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav  wire:navigate href="{{route('assistanceUser')}}" :active="request()->routeIs('assistanceUser')">


            <ion-icon name="call-outline" class="w-6 h-6"></ion-icon>

            <span class="ml-4">Assistance</span>
        </x-asideLinkNav>
    </li>

    <li class="relative px-6 py-3">


        @if(request()->routeIs('profile.show'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav href="{{route('profile.show')}}" :active="request()->routeIs('profile.show')">


            <ion-icon name="build-outline" class="w-6 h-6"></ion-icon>
            <span class="ml-4">Configuration</span>
        </x-asideLinkNav>
    </li>
    <li class="relative px-6 py-3">


        @if(request()->routeIs('profile.show'))
        <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-amber-600" aria-hidden="true"></span>
        @endif

        <x-asideLinkNav wire:navigate href="{{route('profile.show')}}" :active="request()->routeIs('profile.show')">


            <ion-icon name="build-outline" class="w-6 h-6"></ion-icon>
            <span class="ml-4">Profile</span>
        </x-asideLinkNav>
    </li>





</ul>
