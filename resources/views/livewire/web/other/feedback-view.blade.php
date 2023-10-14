<div class="min-h-screen pt-16">


        <div class="relative h-24 bg-green-600">

            <div class="absolute inset-0 hidden bg-black opacity-50"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="text-4xl font-bold text-white">Votre Avis Compte</h1>
            </div>
            <div class="absolute inset-0 flex items-center justify-start mx-2">
                @include('include.bread-cumb',['feedback'=>'Feedback-view'])
            </div>
        </div>


    <div>

    </div>

    <div class="max-w-6xl px-8 pt-8 mx-auto">

        <div class="grid grid-cols-2 mb-4">
            <div class="flex flex-col gap-4">

                    <x-input wire:model='user.name' label="Nom" />

                    <x-input label="Email" wire:model='user.email' type="email" />

                <div class="col-span-2">
                    <x-textarea wire:model='description' label="Votre Message">

                    </x-textarea>
                </div>
                <div>
                    <x-button wire:click='sendFeedback()' amber class="w-full" label="Envoyer"></x-button>
                </div>


            </div>
            <div class="px-4">


                    <div class="bg-white rounded-lg">

                        <div class="">
                            <div class="max-w-xl p-6 mx-auto mt-10 border rounded-lg">
                                <p class="mb-4 text-lg font-bold text-center">Vous avez utilisé FIND pour faire une différence
                                    dans la vie des personnes et contribuer à répondre à leurs besoins.</p>
                                <p class="mb-4 text-center">Partagez votre expérience et aidez-nous à améliorer nos efforts pour créer une
                                    expérience encore plus positive pour nos utilisateurs.</p>
                                <p class="mb-6 text-center">Votre feedback est précieux pour nous et pour ceux qui cherchent à trouver
                                    des solutions et à faciliter leur quotidien.</p>
                            </div>

                        </div>
                    </div>


            </div>

        </div>
        <hr>

        <div class="pt-8 ">

            <div>
                <h1 class="text-center text-gray-700 dark:text-gray-200">Les Avis</h1>
            </div>

            <div class="grid pt-4 lg:grid-cols-2">



            </div>



        </div>








    </div>

</div>
