<?php

namespace App\Livewire\Freelance\Other;

use Livewire\Component;

use App\Tools\SidebarElement;

class SidebarPanel extends Component
{
    public function render()
    {

        $pageName = request()->route()->getName();
        $routePrefix = explode('/', $pageName)[1] ?? '';

        return view('livewire.freelance.other.sidebar-panel', ['sidebarMenu' => SidebarElement::dashboards(), 'pageName' => $pageName]);
    }
}
