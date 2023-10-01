<?php

namespace App\Spotlight\User;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class MessageUserSpot extends SpotlightCommand
{

    protected string $name = 'Message';

    protected string $description = 'Vos conversation utilisateur';

    protected array $synonyms = [
        'conversation',

    ];

    public function execute(Spotlight $spotlight): void
    {
        $spotlight->redirect('/user/messages');
    }

    /**
     * You can provide any custom logic you want to determine whether the
     * command will be shown in the Spotlight component. If you don't have any
     * logic you can remove this method. You can type-hint any dependencies you
     * need and they will be resolved from the container.
     */
    public function shouldBeShown(): bool
    {


        //return auth()->user()->freelance()->exists();
        return true;
    }
}
