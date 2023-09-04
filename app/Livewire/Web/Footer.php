<?php

namespace App\Livewire\Web;

use App\Models\Category;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        return view('livewire.web.footer',['categories' =>Category::all()]);
    }
}
