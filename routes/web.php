<?php

use App\Http\Controllers\PayementController;
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

Route::get('/services', \App\Livewire\Web\ServicesView::class)->name('services');
Route::get('/faq', \App\Livewire\Web\Other\Faq::class)->name('faq');
Route::get('/apropos', \App\Livewire\Web\Other\About::class)->name('apropos');
Route::get('/contact', \App\Livewire\Web\Other\ContactView::class)->name('contact');

Route::get('/registration', \App\Livewire\Web\Registration\RegisterBegin::class)->name('register.begin');


Route::get('/registration/info', \App\Livewire\Web\Registration\RegisterEtape1::class)->name('register.etape.1');

Route::get('/registration/freelance', \App\Livewire\Web\Registration\RegistrationFreelance::class)->name('freelancer.register');
Route::get('/create-mission', \App\Livewire\Web\Mission\CreateMission::class)->name('createProject');

Route::get('/find-freelance/profile/{identifiant}', \App\Livewire\Web\Freelance\ProfileFreelance::class)->where('identifiant', '(.*)')->name('profileFreelance');

Route::get('/find-freelance', \App\Livewire\Web\Freelance\FindFreelance::class)->name('find_freelance');

Route::get('/categories', \App\Livewire\Web\Category\CategoryName::class)->name('categories');

Route::get('/categories/{category}/{service_numero}', \App\Livewire\Web\Category\ServiceViewOne::class)->where('service_numero', '(.*)')->name('ServicesViewOne');

Route::get('/categories/{category}', \App\Livewire\Web\Category\ServiceByCategory::class)->where('category', '(.*)')->name('categoryByName');



Route::get('/checkout', \App\Livewire\Web\Checkout\CheckoutService::class)->name('checkout');




Route::controller(PayementController::class)->group(function () {

    Route::get('/checkout/status/{transaction_numero}',  'paiement_status')->name('checkoutStatus');

    Route::get('/checkout/status-maxi',  'paiment_maxi')->name('checkoutStatusMaxiService');
});










Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    Route::get('/checkout', \App\Livewire\Web\Checkout\CheckoutService::class)->name('checkout');








    Route::group(['prefix' => "user"], function () {


        Route::get('/favoris', App\Livewire\User\Other\FavorisList::class)->name('favorisUser');
        Route::get('/dashboard', \App\Livewire\User\Dashboard\DashboardUser::class)->name('dashboardUser');

        Route::get('/commandes/{order_number}/checkout', \App\Livewire\User\Commande\CheckoutPendig::class)->name('commandeRepaye');

        Route::get('/commandes/{order_number}', App\Livewire\User\Commande\CommandeOneView::class)->name('commandeOneView');
        Route::get('/commandes', \App\Livewire\User\Commande\CommandeList::class)->name('commandeUser');

        Route::get('/transaction/{transaction_number}', \App\Livewire\User\Transaction\TransactionOneView::class)->name('transactionOneUser');

        Route::get('/transaction', \App\Livewire\User\Transaction\TransactionList::class)->name('transactionUser');


        Route::get('/profile', \App\Livewire\User\User\Profile::class)->name('ProfileUser');

        Route::get('/mission-list/edit/{mission_numero}', \App\Livewire\User\Mission\MissionEdit::class)->name('MissionEdit');


        Route::get('/mission-list/{mission_numero}', \App\Livewire\User\Mission\MissionResponse::class)->name('PropostionProjet');



        Route::get('/mission-list', \App\Livewire\User\Mission\MissionList::class)->name('MissionUser');

    Route::get('/assistance', \App\Livewire\User\Other\AssistanceUser::class)->name('assistanceUser');
    });



});
