<?php

use App\Http\Controllers\Api\CategoryGet;
use App\Http\Controllers\Api\CityApi;
use App\Http\Controllers\AuthSocial;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', \App\Livewire\Web\Home::class)->name('home');

Route::view('/test2','Tests.home')->name('hometest');
Route::view('/test3', 'Tests.home2')->name('hometest2');


Route::get('/faq', \App\Livewire\Web\Other\Faq::class)->name('faq');
Route::get('/apropos', \App\Livewire\Web\Other\About::class)->name('apropos');
Route::get('/contact', \App\Livewire\Web\Other\ContactView::class)->name('contact');

Route::get('/registration', \App\Livewire\Web\Registration\RegisterBegin::class)->name('register.begin');


Route::get('/registration/info', \App\Livewire\Web\Registration\RegisterEtape1::class)->name('register.etape.1');

Route::get('/registration/freelance', \App\Livewire\Web\Registration\RegistrationFreelance::class)->name('freelancer.register')->middleware('freelance_exist');

Route::get('/find-freelance/profile/{identifiant}', \App\Livewire\Web\Freelance\ProfileFreelance::class)->where('identifiant', '(.*)')->name('profileFreelance');

Route::get('/find-freelance', \App\Livewire\Web\Freelance\FindFreelance::class)->name('find_freelance');

Route::get('/categories', \App\Livewire\Web\Category\CategoryName::class)->name('categories');


Route::get('/services/{category}/{sub_name}', \App\Livewire\Web\Category\SubCatategoryName::class)->where('sub_name', '(.*)')->name('SubcategoryName');

Route::get('/services', \App\Livewire\Web\ServicesView::class)->name('services');

Route::get('/categories/{category}/{service_numero}', \App\Livewire\Web\Category\ServiceViewOne::class)->where('service_numero', '(.*)')->name('ServicesViewOne');

Route::get('/categories/{category}', \App\Livewire\Web\Category\ServiceByCategory::class)->where('category', '(.*)')->name('categoryByName');







Route::controller(PayementController::class)->group(function () {

    Route::get('/checkout/status/{transaction_numero}',  'paiement_status')->name('checkoutStatus');

    Route::get('/checkout/status-maxi',  'paiment_maxi')->name('checkoutStatusMaxiService');
});



Route::get('/api/category', CategoryGet::class)->name('api.services');

Route::get('/api/city', CityApi::class)->name('api.city');

Route::get('/api/search', [ToolsController::class,'search'])->name('api.search');

Route::get('/blog/view', \App\Livewire\Web\Blog\BlogView::class)->name('blogView');








Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'socialMedia',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/create-mission', \App\Livewire\Web\Mission\CreateMission::class)->name('createProject');


    Route::get('/checkout', \App\Livewire\Web\Checkout\CheckoutService::class)->name('checkout');

    Route::get('/feedback-view', \App\Livewire\Web\Other\FeedbackView::class)->name('FeedbackView');

    Route::get('/blog/view', \App\Livewire\Web\Blog\BlogView::class)->name('blogView');







    Route::get('facturaction/{facture}', [ReportController::class, 'facture'])->where('facture', '(.*)')->name('facturation');



    Route::group(['prefix' => "user"], function () {


        Route::get('/favoris', App\Livewire\User\Other\FavorisList::class)->name('favorisUser');
        Route::get('/dashboard', \App\Livewire\User\Dashboard\DashboardUser::class)->name('dashboardUser');

        Route::get('/commandes/{order_number}/checkout', \App\Livewire\User\Commande\CheckoutPendig::class)->name('commandeRepaye');

        Route::get('/commandes/{order_number}', App\Livewire\User\Commande\CommandeOneView::class)->name('commandeOneView');
        Route::get('/commandes', \App\Livewire\User\Commande\CommandeList::class)->name('commandeUser');

        Route::get('/transaction/{transaction_number}', \App\Livewire\User\Transaction\TransactionOneView::class)->name('transactionOneUser');

        Route::get('/transaction', \App\Livewire\User\Transaction\TransactionList::class)->name('transactionUser');


        Route::get('/profile', \App\Livewire\User\User\Profile::class)->name('ProfileUser');

        Route::get('/profile', \App\Livewire\User\User\Profile::class)->name('profile.show');

        Route::get('/mission-list/edit/{mission_numero}', \App\Livewire\User\Mission\MissionEdit::class)->name('MissionEdit');

        Route::get('/mission-list/{mission_numero}/gestion', \App\Livewire\User\Mission\MissionGestion::class)->name('projetEvolution');

        Route::get('/mission-list/{mission_numero}/gestion/paiement', \App\Livewire\User\Mission\MissionCheckout::class)->name('missionPaiement');

        Route::get('/mission-paiement/{transaction_numero}', \App\Livewire\User\Other\CheckoutStatusMission::class)->name('missionPaiementStatus');



        Route::get('/mission-list/{mission_numero}', \App\Livewire\User\Mission\MissionResponse::class)->name('PropostionProjet');


        Route::get('/mission-list', \App\Livewire\User\Mission\MissionList::class)->name('MissionUser');


        Route::get('/messages', \App\Livewire\User\Conversation\ComponentChatUser::class)->name('MessageUser');


    Route::get('/assistance', \App\Livewire\User\Other\AssistanceUser::class)->name('assistanceUser');


    });



    Route::group(['prefix' => "freelance"],
        function () {

                Route::middleware([
                    'freelance', 'auth:sanctum', 'socialMedia',
                    config('jetstream.auth_session'),
                    'verified'
                ])->group(
                    function () {

                    Route::get('/export-data/{id}', [ReportController::class,'exportExcel'])->name('freelance.transaction.export');

                    Route::get('/dashboard', \App\Livewire\Freelance\Dashboard\DashboardFreelance::class)->name('freelance.dashboard');

                    Route::group(['prefix' => "service"], function () {

                        Route::get('/', \App\Livewire\Freelance\Services\ServiceList::class)->name('freelance.service.list');
                        Route::get('/creation', \App\Livewire\Freelance\Services\ServiceCreation::class)->name('freelance.service.create');
                        Route::get('/edit/{service_numero}', \App\Livewire\Freelance\Services\ServiceEdit::class)->name('freelance.service.edit');
                        Route::get('/level/{service_numero}', \App\Livewire\Freelance\Services\ServiceAddLevel::class)->name('freelance.service.level');
                        // Route::get('/view/{service_numero}', [ServiceController::class, 'ViewOneService'])->name('freelance.service.feedback');
                    });
                    Route::group(['prefix' => "commande"], function () {
                        Route::get('/', \App\Livewire\Freelance\Commande\CommandeFreelance::class)->name('freelance.commande.list');
                        Route::get('/{order_numero}', \App\Livewire\Freelance\Commande\CommandeGestion::class)->name('freelance.Order.view');
                    });
                    Route::group(['prefix' => "transaction"], function () {
                        Route::get('/', \App\Livewire\Freelance\Transaction\TransactionFreelance::class)->name('freelance.transaction.list');
                        //Route::get('/{transaction_numero}', [CommandeControler::class, 'TransactionOneFreelance'])->name('freelance.transaction.view');
                        //Route::get('/edit/{id}', \App\Http\Livewire\Freelance\Services\EditService::class)->name('freelance.service.edit');
                    });
                    Route::group(['prefix' => "messages"], function () {
                        Route::get('/', \App\Livewire\Freelance\Conversation\ConversationComponent::class)->name('freelance.messages');
                    });
                    Route::group(['prefix' => "profile"], function () {
                        Route::get('/', \App\Livewire\Freelance\Profile\ProfileFreelance::class)->name('freelance.profile');
                        Route::get('/realisations', \App\Livewire\Freelance\Profile\RealisationForm::class)->name('freelance.realisation');
                        //Route::get('/edit/{id}', \App\Http\Livewire\Freelance\Services\EditService::class)->name('freelance.service.edit');
                    });
                    Route::group(['prefix' => "paiement"], function () {
                        Route::get('/retrait', \App\Livewire\Freelance\Paiement\PaiementFreelance::class)->name('freelance.PaiementInfo');

                        Route::get('/effectue', \App\Livewire\Freelance\Paiement\PaimentList::class)->name('freelance.PaiementList');
                        Route::get('/releves', \App\Livewire\Freelance\Paiement\Releves::class)->name('freelance.PaiemntReleves');


                        //Route::get('/edit/{id}', \App\Http\Livewire\Freelance\Services\EditService::class)->name('freelance.service.edit');
                    });

                    Route::get('/assistance', \App\Livewire\Freelance\Other\AssistanceFreelance::class)->name('freelance.assistance');


                    Route::group(['prefix' => "mission"], function () {



                        Route::get('/mission_active/{mission_numero}', \App\Livewire\Freelance\Mission\MissionWork::class)->name('freelance.proposition.accepted');
                        Route::get('/mission_active', \App\Livewire\Freelance\Mission\MissionEnCours::class)->name('freelance.proposition');
                        Route::get('/en_attente/{mission_numero}', \App\Livewire\Freelance\Mission\MissionProposition::class)->name('freelance.projet.view');

                        Route::get('/en_attente', \App\Livewire\Freelance\Mission\MissionList::class)->name('freelance.projet.list');

                    });



                    });


        }
    );


});







//Facebook controller
Route::controller(AuthSocial::class)->group(function () {
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});



Route::get('/storage-link', function () {
    Artisan::call('storage:link');
});

Route::get('/view-cache', function () {
    Artisan::call('view:cache');
});



Route::middleware(['auth:sanctum', 'socialMedia'])->group(function () {
    Route::get('/add-password', \App\Livewire\User\Auth\AddPassword::class)->name('changePassword');
});

