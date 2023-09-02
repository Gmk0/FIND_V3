<?php

namespace App\Livewire\Web;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.web-layout')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.web.home',['categories' =>Category::all()]);
    }
}
