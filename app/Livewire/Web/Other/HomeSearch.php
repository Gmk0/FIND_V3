<?php

namespace App\Livewire\Web\Other;

use Livewire\Component;
use App\Models\Service;
class HomeSearch extends Component
{
    public $search = '';

    public $selectedIndex = 0;
    public $results = [];


    public function updatedSearch($value)
    {
        $this->selectedIndex = 0;
        $this->results = [];

        if (strlen($value) >= 2) {
            $this->results = Service::with('category')
                ->where(function ($query) use ($value) {
                    $keywords = explode(' ', $value);
                    foreach ($keywords as $keyword) {
                        $query->orWhere('title', 'like', '%' . $keyword . '%')
                            ->orWhereHas('category', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            });
                    }
                })
                ->limit(10)
                ->get();
        }
    }

    public function placeholder()
    {
            return <<<'HTML'
        <div>
            <!-- Spinner de chargement... -->
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle cx="50" cy="50" r="45" stroke="grey" stroke-width="10" fill="none"/>
                <circle cx="50" cy="50" r="45" stroke="blue" stroke-width="10" stroke-dasharray="70, 30" stroke-linecap="round" fill="none">
                    <animateTransform attributeName="transform" type="rotate" from="0 50 50" to="360 50 50" dur="1s" repeatCount="indefinite"/>
                </circle>
            </svg>
        </div>
        HTML;
    }

    public function render()
    {
        return view('livewire.web.other.home-search');
    }
}
