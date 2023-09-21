<?php

namespace App\Livewire\Web\Category;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Category;

#[Layout('layouts.web-layout')]
#[Title('Creer missiion')]

class CategoryName extends Component
{
    public function render()
    {
        return view('livewire.web.category.category-name',['categories'=>Category::all()]);
    }
}
