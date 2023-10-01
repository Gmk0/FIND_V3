<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LivewireUI\Spotlight\Spotlight;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        Spotlight::registerCommandIf(true, \App\Spotlight\User\CommandeUserSpot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\User\TransactionUserSpot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\User\MissionUserSpot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\User\ProfileUserSpot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\User\MessageUserSpot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\Freelance\ServiceCreationFspot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\Freelance\CommandeFreelance::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\Freelance\TransactionFspot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\Freelance\MissionFspot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\Freelance\ProfileFspot::class);
        Spotlight::registerCommandIf(true, \App\Spotlight\Freelance\ServiceCreationFspot::class);
    }

}
