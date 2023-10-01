<?php

namespace App\Livewire\Web\Blog;

use Livewire\Component;
use Livewire\Attributes\{Layout, Title};

#[Layout('layouts.web-layout')]

#[Title('BlOG ')]

class BlogView extends Component
{
    public function render()
    {
        return view('livewire.web.blog.blog-view');
    }
}
