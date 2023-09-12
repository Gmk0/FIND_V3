<?php

namespace App\View\Components;

use App\Tools\SidebarElement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarPanel extends Component
{
    /**

       /**
     * Create a new component instance.
     */

    public function __construct()
    {
        //

        $pageName = request()->route()->getName();
        $routePrefix = explode('/', $pageName)[0] ?? '';

        error_log($pageName);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        if (!is_null(request()->route())) {
            $pageName = request()->route()->getName();
            $routePrefix = explode('/', $pageName)[1] ?? '';



            switch ($pageName) {
                case 'freelance.dashboard':
                    return view('components.sidebar-panel', ['sidebarMenu' => SidebarElement::dashboards(), 'pageName' => $pageName]);
                    break;
                case 'components':
                    return view('components.sidebar-panel')->with(['sidebarMenu' => SidebarElement::elements(), 'pageName' => $pageName]);
                    break;
                case 'forms':
                    return view('components.sidebar-panel')->with(['sidebarMenu' => SidebarElement::elements(), 'pageName' => $pageName]);
                    break;
                case 'layouts':
                    return view('components.sidebar-panel')->with(['sidebarMenu' => SidebarElement::elements(), 'pageName' => $pageName]);
                    break;
                case 'apps':
                    return view('components.sidebar-panel')->with(['sidebarMenu' => SidebarElement::elements(), 'pageName' => $pageName]);
                    break;
                case 'dashboards':
                    return view('components.sidebar-panel')->with(['sidebarMenu' => SidebarElement::elements(), 'pageName' => $pageName]);
                    break;
                default:
                    return view('components.sidebar-panel', ['sidebarMenu' => SidebarElement::dashboards(), 'pageName' => $pageName]);
            }
        }
    }
}
