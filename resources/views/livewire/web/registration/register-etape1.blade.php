<div class="min-h-screen bg-white border-t border-gray-200 dark:bg-gray-900">

    <div class="py-3 ">
        <div class="container px-6 m-auto text-gray-600 md:px-12 xl:px-6">
            <div class="space-y-6 lg:flex lg:space-y-0 lg:items-center lg:gap-12">
                <div class="hidden md:4/12 lg:w-6/12 md:flex">
                    <img src="/images/hero/inscription.jpg" alt="image" class="object-cover rounded-md" loading="lazy"
                        width="" height="" />
                </div>
                <div class="md:8/12 lg:w-6/12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white md:text-3xl">
                        Qu'est-ce qui fait un profil FIND réussi ?
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Votre première impression compte ! Créez un profil qui se démarquera de la foule sur FIND.
                    </p>

                    <div class="grid items-center gap-4 mt-4 md:grid-cols-2">
                        <div>
                            <div class="flex w-16 h-16 gap-4 rounded-full dark:bg-teal-900/20">
                                <img src="/images/icon/user.gif" class="w-32 rounded" alt="">
                            </div>
                            <div class="w-5/6 mt-2 ">

                                <p class="font-semibold text-gray-500 dark:text-gray-400">
                                    Prenez votre temps pour créer votre profil afin qu'il soit exactement comme vous
                                    le souhaitez..</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex w-16 h-16 gap-4 rounded-full dark:bg-teal-900/20">
                                <img src="/images/icon/social-media.gif" class="w-32 rounded" alt="">
                            </div>
                            <div class="w-5/6 mt-2 ">

                                <p class="font-semibold text-gray-500 dark:text-gray-400">Ajoutez de la crédibilité en
                                    vous connectant
                                    à vos réseaux professionnels pertinents.</p>
                            </div>
                        </div>
                        <div>
                            <div class="flex w-16 h-16 gap-4 bg-purple-100 rounded-full dark:bg-purple-900/20">
                                <img src="/images/icon/checklist.gif" class="w-32 rounded" alt="">

                            </div>
                            <div class="w-5/6">

                                <p class="text-gray-500 dark:text-gray-400">
                                    Décrivez avec précision vos compétences professionnelles pour vous aider à
                                    obtenir plus de travail.
                                </p>
                            </div>
                        </div>
                        <div>
                            <div class="flex w-16 h-16 gap-4 bg-purple-100 rounded-full dark:bg-purple-900/20">
                                <img src="/images/icon/profile.gif" class="w-32 rounded" alt="">
                            </div>
                            <div class="w-5/6 mt-2">

                                <p class="font-semibold text-gray-500 dark:text-gray-400">Mettez un visage sur votre nom
                                    !
                                    Téléchargez une photo de profil qui montre clairement votre visage..</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex items-end justify-end mt-2 md:mt-5">



                <x-filament::button size="lg" icon-position="after"  icon="heroicon-m-arrow-right-circle" tag="a" href="{{route('freelancer.register')}}">
                   Continuer
                </x-filament::button>



            </div>
        </div>
    </div>
</div>
