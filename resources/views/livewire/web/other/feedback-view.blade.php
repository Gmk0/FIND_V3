<div class="min-h-screen pt-16">


        <div class="relative h-24 bg-skin-fill">
            <img class="w-full h-full object-cover opacity-70" src="/test/assets/images/cat-women2.jpg" alt="Women"
                title="Women" />
            <div class="absolute inset-0 flex items-center justify-center">
                <h1 class="text-4xl font-bold text-white"></h1>Votre Avis Compte
            </div>
        </div>


    <div>
        <div class="mx-2">
            @include('include.bread-cumb',['feedback'=>'Feedback-view'])
        </div>
    </div>

    <div class="pt-8 max-w-6xl  mx-auto">

        <div class="grid grid-cols-2 mb-4">
            <div class="flex flex-col gap-4">

                    <x-input label="Nom" />

                    <x-input label="Email" type="email" />

                <div class="col-span-2">
                    <x-textarea label="Votre Message">

                    </x-textarea>
                </div>
                <div>
                    <x-button amber class="w-full" label="Envoyer"></x-button>
                </div>


            </div>
            <div>

                <div class=" bg-white rounded-lg">

                </div>
            </div>

        </div>
        <hr>

        <div class="pt-8 ">

            <div>
                <h1 class="text-gray-700 text-center dark:text-gray-200">Les Avis</h1>
            </div>

            <div class="pt-4 grid lg:grid-cols-2">



            </div>



        </div>








    </div>

</div>
