<div x-data="app()" class="min-h-screen lg:max-w-6xl rounded-lg lg:mx-auto">
    <div x-data="{stepP:1}">
        <div>
            <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row sm:px-10 lg:px-20 xl:px-32">
                <a hre"#" class="text-2xl font-bold text-gray-800">Paiment</a>
                <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
                    <div class="relative mx-2">
                        <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
                            <li @click="stepP=1; localStorage.setItem('stepP', stepP)"
                                class="flex items-center space-x-3 text-left sm:space-x-4">
                                <a :class="{'ring ring-gray-600 ring-offset-2 bg-gray-600 dark:text-gray-100': stepP==1}"
                                    class="flex h-6 w-6 items-center justify-center rounded-full  bg-gray-400 text-xs font-semibold text-white "
                                    href="#">1</a>
                                <span class="font-semibold text-gray-800">Info</span>
                            </li>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            <li @click="stepP=2 ; localStorage.setItem('stepP', stepP)"
                                class="flex cursor-pointer items-center space-x-3 text-left sm:space-x-4">
                                <a :class="{'ring ring-gray-600 ring-offset-2 dark:text-gray-100 bg-gray-600': stepP==2}"
                                    class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white"
                                    href="#">2</a>
                                <span class="font-semibold text-gray-800">Mission</span>
                            </li>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            <li @click="stepP=3 ; localStorage.setItem('stepP', stepP)"
                                class="flex items-center space-x-3 text-left sm:space-x-4">
                                <a :class="{'ring ring-gray-600  dark:text-gray-100 ring-offset-2 bg-gray-600': stepP==3}"
                                    class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-400 text-xs font-semibold text-white"
                                    href="#">3</a>
                                <span class="font-semibold text-gray-800">Paiement</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <section x-show.transition.duration.100ms="stepP == 1" class=" bg-gray-100 dark:bg-gray-800 py-8">
            <div class="container mx-auto">
                <div class="max-w-6xl mx-auto">
                    <h2 class="text-3xl font-bold text-center mb-4">Paiement pour la mission
                    </h2>

                    <div class="bg-white rounded-lg  p-8 text-gray-700 dark:text-gray-200">
                        <p class="text-gray-700 dark:text-gray-200 text-lg">
                            Cher client,<br>
                            Nous souhaitons vous informer qu'il est maintenant temps de procéder au paiement pour votre
                            mission
                            auprès du freelance. Nous apprécions votre confiance en notre plateforme de mise en relation
                            et
                            nous
                            sommes impatients de vo-us voir progresser avec succès dans votre projet.<br><br>

                            Avant de passer au paiement, nous aimerions vous rappeler quelques points importants :
                        <ul class="list-disc text-gray-700 dark:text-gray-200 list-inside pl-4">
                            <li>Vérifiez les détails de la mission</li>
                            <li>Établissez un accord clair</li>
                            <li>Assurez-vous de disposer des fonds nécessaires</li>
                            <li>Suivez les instructions de paiement</li>
                            <li>Communiquez avec le freelance</li>
                        </ul>

                        Nous vous remercions de votre confiance et de votre collaboration. Nous sommes là pour vous
                        soutenir
                        tout au long de votre projet et nous espérons que vous serez pleinement satisfait des résultats
                        obtenus
                        avec l'aide du freelance.<br><br>

                        Si vous avez des questions supplémentaires ou avez besoin d'assistance, n'hésitez pas à nous
                        contacter.
                        Nous sommes là pour vous aider.<br><br>

                        Nous vous souhaitons le meilleur dans votre mission et nous sommes impatients de voir les
                        résultats
                        exceptionnels que vous obtiendrez avec l'aide du freelance.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div x-show.transition.duration.100ms="stepP == 2" class="bg-gray-100 dark:bg-gray-800 py-8">

            <div class="rounded-lg">
                <section class="bg-gray-100 dark:bg-gray-800 py-8">
                    <div class="max-w-7xl lg:mx-auto px-4 sm:px-2 lg:px-8">
                        <div class="bg-white rounded-lg">
                            <div class="lg:p-6 p-3">
                                <h2 class="text-2xl font-bold mb-4 text-gray-800">Récapitulation de la mission</h2>
                                <!-- Informations de la mission -->
                                <p class="mb-2"><span class="font-semibold">Titre :</span>
                                    {{$mission->title}}
                                </p>
                                <p class="mb-2"><span class="font-semibold">Description :</span>
                                    {{$mission->description}}</p>
                                <p class="mb-2"><span class="font-semibold">Budget :</span>
                                    {{$mission->budget()}}</p>


                                <p class="mb-4 text-base font-medium text-gray-600 md:mb-2 dark:text-gray-300">Délai
                                    d'echance :
                                    Du {{$mission->begin_mission->format('d F, Y')}} au
                                    {{$mission->end_mission->format('d F, Y')}}
                                </p>
                                <!-- Proposition acceptée -->
                                <h2 class="text-2xl font-bold mt-8 mb-4">Proposition acceptée</h2>
                                <div class="bg-blue-100 dark:bg-gray-900 p-4 rounded-lg">
                                    <p class="text-gray-800 font-semibold">{{$response->freelance->user->name}} /
                                        {{$response->freelance->user->email}}</p>
                                    <p class="mt-2">
                                        {{$response->content}}
                                    </p>

                                    <p class="mb-2"><span class="font-bold">Budget proposer :</span>
                                        $ {{$response->bid_amount}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

        </div>

        <div x-show.transition.duration.100ms="stepP == 3"
            class="bg-gray-100 dark:bg-gray-800 p-3 py-8">

            <div class="mb-4">
                <a hre"#" class="text-2xl text-center mb-4 font-bold text-gray-800">Methode de Paiment</a>
            </div>

            <div class=" flex lg:flex-row flex-col  gap-2">
                <div class="w-full p-4 mb-4 font-semibold bg-white dark:bg-gray-900 border border-gray-200 rounded-md">
                    <div>
                        <h1>Address de Facturation / Livraison</h1>

                    </div>
                 {{$this->addressForm}}

                </div>

                <div
                    class="w-full mx-auto mb-6 font-light text-gray-800 bg-white border border-gray-200 rounded-lg top-8 dark:bg-gray-900">
                    <div class="w-full p-3 border-b border-gray-200 ">
                        <div class="mb-5">
                            <label for="type1" class="flex items-center cursor-pointer">
                                <input type="checkbox" class="w-5 h-5 text-indigo-500 form-radio" id="type1"
                                    x-model="isCard" @click="isOther=false">
                                <img src="https://leadershipmemphis.org/wp-content/uploads/2020/08/780370.png"
                                    class="h-6 ml-3">
                            </label>
                        </div>
                    <div x-collapse class="px-2" x-cloak x-show="isCard">

                        {{$this->creditForm}}


                        <div class="mt-4">

                            <button wire:click="pay()" wire:loading.attr='disabled'
                                class=" block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle
                                                                                                                                                                                    font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all
                                                                                                                                                                                   hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none
                                                                                active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50
                                                                                                                                                                                    disabled:shadow-none"
                                data-ripple-light="true">
                                <span wire:loading.remove>PAYER
                                    ({{$priceTotal}}$)</span>
                                <span wire:loading wire:target='pay'>PAIEMENT...</span>
                            </button>

                        </div>

                    </div>

                    </div>

                    <div class="w-full p-6 border-b border-gray-200">
                        <div class="mb-5">
                            <label for="type2" class="flex items-center cursor-pointer">
                                <input type="checkbox" class="w-5 h-5 text-indigo-500 form-radio"="type" id="type2"
                                    x-model="isOther" @click="isCard=false">

                                <img src="/images/icon/maxicash.png" class="h-6 ml-3">


                            </label>
                        </div>

                        <div x-collapse x-cloak x-show="isOther">

                            <div class="flex flex-col gap-4 px-3 mb-3">



                                {{$this->maxiForm}}



                                <button wire:click="checkoutmaxi()" wire:loading.attr='disabled'
                                    class=" block w-full select-none rounded-lg bg-amber-600 py-2 px-2 text-center align-middle
                                                                                                                                                font-sans text-sm font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all
                                                                                                                                                hover:shadow-lg hover:shadow-amber-500/40 focus:opacity-[0.85] focus:shadow-none
                                                                                                                                                active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50
                                                                                                                                                disabled:shadow-none" data-ripple-light="true">
                                    <span wire:loading.remove>PAYER
                                        ({{$priceTotal}}$)</span>
                                    <span wire:loading wire:target='checkoutmaxi'>PAIEMENT...</span>
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <x-load-paid></x-load-paid>

    <script>
        function update(product)
            {
                alert(product);
            }
            function app() {
                return {
                    isOther: false,
                    isCard: false,

                }
            }
    </script>
</div>
