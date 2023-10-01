<?php

namespace App\Spotlight\Freelance;

use LivewireUI\Spotlight\Spotlight;
use LivewireUI\Spotlight\SpotlightCommand;
use LivewireUI\Spotlight\SpotlightCommandDependencies;
use LivewireUI\Spotlight\SpotlightCommandDependency;
use LivewireUI\Spotlight\SpotlightSearchResult;

class ServiceCreationFspot extends SpotlightCommand
{

    protected string $name = 'Creation';

    protected string $description = 'Creation service Freelance ';

    protected array $synonyms = [
        'Creation',
        'Service',


    ];

    public function execute(Spotlight $spotlight): void
    {
        $spotlight->redirect('/freelance/service/creation');
    }

    /**
     * You can provide any custom logic you want to determine whether the
     * command will be shown in the Spotlight component. If you don't have any
     * logic you can remove this method. You can type-hint any dependencies you
     * need and they will be resolved from the container.
     */
    public function shouldBeShown(): bool
    {


        return auth()->user()->freelance()->exists();
    }

}
