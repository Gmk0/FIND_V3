<?php

namespace App\Livewire\Web\Other;

use Livewire\Component;
use App\Models\Service;


class SearchBox extends Component
{

    public $search = '';

    public $selectedIndex = 0;
    public $results = [];
    public $hasSearched =false;

    public function resetSearch()
    {

        $this->search='';

    }



    public function render()
    {
        return view('livewire.web.other.search-box');
    }

    public function updatedSearch($value)
    {



        if (empty($value)) {
            $this->hasSearched = false;
            $this->results = []; // Vous pouvez également vider les résultats ici si vous le souhaitez
            return; // Retourne tôt pour éviter d'exécuter le reste de la logique de recherche
        }

        $this->selectedIndex = 0;
        $this->results = [];


        $this->hasSearched = true;

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
}
