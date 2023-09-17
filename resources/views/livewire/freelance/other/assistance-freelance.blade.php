<div x-data="{ openSection: null }" class="min-h-screen">

    <div x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 200) ? true : false">
        <!-- Bouton Retour en haut -->
       <button x-collapse x-show="showButton" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed p-2 text-white transition duration-300 ease-in-out rounded-full shadow-lg bottom-4 right-4 bg-gradient-to-r from-blue-500 to-purple-600 hover:shadow-xl focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>
    </div>


    <style>
        section::before {
        content: "";
        display: block;
        height: 100px; /* Ajustez cette valeur en fonction de la hauteur de votre en-tête ou de l'espace que vous souhaitez
        ajouter */
        margin-top: -100px;
        visibility: hidden;
        pointer-events: none;
        }
    </style>

    <div class="max-w-3xl mb-2">
        <h2 class="mb-2 text-lg font-semibold tracking-wide uppercase text-amber-600 lg:text-xl">Assistance
        </h2>
    </div>
    <div>
        @include('include.bread-cumb-Freelance',['assistance'=>'Assistance'])
    </div>



        <div class="max-w-6xl p-6 mx-auto bg-white rounded-lg shadow-md">
            <h1 class="mb-4 text-2xl font-bold">Assistance pour Freelance</h1>
            <ul>
                <!-- Démarrage -->
                <li class="mb-4">
                    <button @click="openSection === 'demarrage' ? openSection = null : openSection = 'demarrage'"
                        class="flex justify-between w-full text-left">
                        Démarrage
                        <span x-collapse x-show="openSection === 'demarrage'">-</span>
                        <span x-collapse x-show="openSection !== 'demarrage'">+</span>
                    </button>
                    <ul x-collapse x-show="openSection === 'demarrage'" class="pl-4 mt-2">
                        <li><a href="#creer-profil" class="text-blue-500 hover:underline">Créer un profil de freelance</a> - Découvrez
                            comment optimiser votre profil pour attirer plus de clients.</li>
                        <li><a href="#" class="text-blue-500 hover:underline">Définir ses compétences</a> - Assurez-vous de
                            mettre en avant vos compétences principales.</li>
                        <li><a href="#rendre-profil-attractif" class="text-blue-500 hover:underline">Rendre son profil attractif</a> - Astuces pour
                            se démarquer de la concurrence.</li>
                    </ul>
                </li>

                <!-- Recherche de Projets -->
                <li class="mb-4">
                    <button @click="openSection === 'recherche' ? openSection = null : openSection = 'recherche'"
                        class="flex justify-between w-full text-left">
                        Recherche de Projets
                        <span x-collapse x-show="openSection === 'recherche'">-</span>
                        <span x-collapse x-show="openSection !== 'recherche'">+</span>
                    </button>
                    <ul x-collapse x-show="openSection === 'recherche'" class="pl-4 mt-2">
                        <li><a href="#recherche-projets" class="text-blue-500 hover:underline">Rechercher des projets pertinents</a> -
                            Utilisez des filtres pour trouver des projets qui correspondent à vos compétences.</li>
                        <li><a href="#comprendre-besoins" class="text-blue-500 hover:underline">Comprendre les besoins du client</a> - Comment
                            lire entre les lignes d'une description de projet.</li>
                    </ul>
                </li>

                <!-- Soumission de Propositions -->
                <li class="mb-4">
                    <button @click="openSection === 'soumission' ? openSection = null : openSection = 'soumission'"
                        class="flex justify-between w-full text-left">
                        Soumission de Propositions
                        <span x-collapse x-show="openSection === 'soumission'">-</span>
                        <span x-collapse x-show="openSection !== 'soumission'">+</span>
                    </button>
                    <ul x-collapse x-show="openSection === 'soumission'" class="pl-4 mt-2">
                        <li><a href="#rediger-proposition" class="text-blue-500 hover:underline">Rédiger une proposition efficace</a> -
                            Conseils pour convaincre un client de vous choisir.</li>
                        <li><a href="#" class="text-blue-500 hover:underline">Fixer un tarif pour ses services</a> - Comment
                            déterminer le juste prix pour votre travail.</li>
                    </ul>
                </li>

                <!-- Communication avec les Clients -->
                <li class="mb-4">
                    <button @click="openSection === 'communication' ? openSection = null : openSection = 'communication'"
                        class="flex justify-between w-full text-left">
                        Communication avec les Clients
                        <span x-collapse x-show="openSection === 'communication'">-</span>
                        <span x-collapse x-show="openSection !== 'communication'">+</span>
                    </button>
                    <ul x-collapse x-show="openSection === 'communication'" class="pl-4 mt-2">
                        <li><a href="#communication-efficace" class="text-blue-500 hover:underline">Best practices pour une communication
                                efficace</a> - Comment établir une bonne relation avec vos clients.</li>
                        <li><a href="#resolution-conflits" class="text-blue-500 hover:underline">Résolution des conflits</a> - Conseils pour
                            gérer les désaccords et les malentendus.</li>
                    </ul>
                </li>
            </ul>
        </div>



        <div class="max-w-6xl p-6 mx-auto mt-12 bg-white rounded-lg shadow-md">
            <section id="creer-profil" class="space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Créer un profil de freelance</h2>
                <p>Voici comment optimiser votre profil pour attirer plus de clients. Assurez-vous d'avoir une photo de profil
                    professionnelle, une description détaillée de vos compétences et de vos expériences, et des échantillons de
                    votre travail si possible.</p>
                <!-- ... autres contenus de la section ... -->
            </section>

            <section id="rendre-profil-attractif" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Rendre son profil attractif</h2>
                <p>Un profil attractif est essentiel pour se démarquer dans le monde du freelancing. Voici quelques conseils pour
                    améliorer votre profil :</p>
                <ul class="pl-5 space-y-2 list-disc">
                    <li><strong>Photo de profil professionnelle :</strong> Une image claire et professionnelle de vous-même donne
                        une première impression positive.</li>
                    <li><strong>Titre accrocheur :</strong> Votre titre doit être court mais descriptif. Il devrait donner aux
                        clients potentiels une idée claire de ce que vous faites.</li>
                    <li><strong>Description détaillée :</strong> Parlez de vous, de vos compétences, de votre expérience et de ce
                        que vous pouvez offrir à vos clients.</li>
                    <li><strong>Échantillons de travail :</strong> Montrez vos meilleurs travaux ou projets pour donner aux clients
                        une idée de la qualité de votre travail.</li>
                    <li><strong>Témoignages :</strong> Si vous avez des commentaires positifs de clients précédents, assurez-vous de
                        les inclure dans votre profil.</li>
                    <li><strong>Compétences clés :</strong> Mettez en avant les compétences qui sont les plus pertinentes pour les
                        services que vous offrez.</li>
                </ul>
            </section>

            <!-- Rechercher des projets pertinents -->
            <section id="recherche-projets" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Rechercher des projets pertinents</h2>
                <p>La recherche de projets qui correspondent à vos compétences est cruciale. Utilisez des mots-clés pertinents,
                    filtrez les résultats et lisez attentivement les descriptions des projets.</p>
            </section>

            <!-- Comprendre les besoins du client -->
            <section id="comprendre-besoins" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Comprendre les besoins du client</h2>
                <p>Chaque client a des besoins spécifiques. Posez des questions, demandez des clarifications et assurez-vous de
                    comprendre exactement ce que le client attend avant de commencer un projet.</p>
            </section>

            <!-- Rédiger une proposition efficace -->
            <section id="rediger-proposition" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Rédiger une proposition efficace</h2>
                <p>Une proposition bien rédigée peut faire la différence entre obtenir un projet ou non. Assurez-vous d'être clair,
                    concis et de mettre en avant comment vous pouvez apporter de la valeur au client.</p>
            </section>

            <!-- Fixer un tarif pour ses services -->
            <section id="fixer-tarif" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Fixer un tarif pour ses services</h2>
                <p>Déterminer combien facturer peut être délicat. Recherchez ce que d'autres freelances de votre domaine facturent
                    et considérez votre niveau d'expérience, vos compétences et la complexité du projet.</p>
            </section>

            <!-- Best practices pour une communication efficace -->
            <section id="communication-efficace" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Best practices pour une communication efficace</h2>
                <p>Une bonne communication est la clé du succès en freelancing. Soyez toujours professionnel, répondez rapidement et
                    assurez-vous de bien comprendre les attentes du client.</p>
            </section>

            <!-- Résolution des conflits -->
            <section id="resolution-conflits" class="mt-8 space-y-4">
                <h2 class="pb-2 text-xl font-bold border-b">Résolution des conflits</h2>
                <p>Les désaccords peuvent survenir. Lorsqu'ils se produisent, abordez-les calmement, écoutez le point de vue du
                    client et cherchez des solutions mutuellement bénéfiques.</p>
            </section>

            <!-- ... autres sections détaillées ... -->
        </div>






</div>
