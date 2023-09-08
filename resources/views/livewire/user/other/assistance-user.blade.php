<div class="min-h-screen px-4 mx-auto max-w-7xl lg:px-8">

    {{-- <div>
        @include('include.breadcumbUser',['assistance'=>'assistance'])
    </div>--}}
    <div class="max-w-3xl mb-8">
        <h2 class="mb-8 text-xl font-semibold tracking-wide uppercase text-amber-600">Besoin d'assistance ?</h2>
    </div>

    <div class="">
        <div class="container px-4 mx-auto">
            <h2 class="mb-8 text-3xl font-semibold"></h2>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full h-48 px-4 mb-8 lg:w-1/3">
                    <div class="p-6 bg-white rounded-lg shadow-lg">
                        <h3 class="mb-4 text-xl font-semibold text-gray-800">Contactez-nous</h3>
                        <p class="mb-4 text-gray-700 dark:text-gray-300">Vous avez une question ou un problème ?
                            N'hésitez pas à nous
                            contacter
                            !</p>

                        <a href="https://wa.me/+243844720350" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center w-12 h-12 bg-green-500 rounded-full hover:bg-green-600">
                            <ion-icon name="logo-whatsapp"></ion-icon>
                        </a>
                    </div>
                </div>
                <div class="w-full h-48 px-4 mb-8 lg:w-1/3">
                    <div class="p-6 bg-white rounded-lg shadow-lg">
                        <h3 class="mb-4 text-xl font-semibold text-gray-800">FAQ</h3>
                        <p class="mb-4 text-gray-700 dark:text-gray-300">Consultez notre Foire Aux Questions pour
                            trouver rapidement des
                            réponses à vos questions.</p>



                            <x-filament::button tag="a"
                                href="{{ route('faq') }}" wire:navigate>
                                FAQ
                            </x-filament::button>

                    </div>
                </div>
                <div class="w-full h-48 px-4 mb-8 lg:w-1/3">
                    <div class="p-6 bg-white rounded-lg shadow-lg">
                        <h3 class="mb-4 text-xl font-semibold text-gray-800">Support en ligne</h3>
                        <p class="mb-4 text-gray-700 dark:text-gray-300">Vous avez besoin d'une assistance en temps
                            réel
                            ? Utilisez notre
                            support en ligne pour discuter avec un agent.</p>

                            <x-filament::button>
                             Support
                            en ligne
                            </x-filament::button>

                    </div>
                </div>
                <div class="w-full px-4 mt-4 mb-8 lg:h-48 lg:w-1/2">
                    <div class="p-6 bg-white rounded-lg shadow-lg">
                        <h3 class="mb-4 text-xl font-semibold text-gray-800">Comportement inapproprié </h3>
                        <p class="mb-4 text-gray-700 dark:text-gray-300">Si vous souhaitez signaler un comportement
                            inapproprié, veuillez cliquer sur le bouton ci-dessous pour être redirigé
                            vers notre support via WhatsApp. Notre équipe sera là pour vous assister et recueillir
                            les informations nécessaires
                            concernant le problème que vous avez rencontré. Nous vous remercions de nous aider à
                            maintenir un environnement sûr et
                            respectueux pour tous nos utilisateurs..</p>

                        <a href="https://wa.me/+243844720350" target="_blank" rel="noopener noreferrer"
                            class="flex items-center justify-center hover:bg-green-600">


                            Accéder au support via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
