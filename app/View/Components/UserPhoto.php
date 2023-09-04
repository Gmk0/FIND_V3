<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserPhoto extends Component
{
    public  $user;
    public $taille;
    public function __construct(User $user, $taille = null)
    {
        //
        $this->taille = $taille;

        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-photo ', ['user' => $this->user, 'taille' => $this->taille]);
    }
}
