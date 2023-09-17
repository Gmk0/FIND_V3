<?php

namespace App\Livewire\Freelance\Mission;

use App\Models\Mission;
use Livewire\Component;

use Livewire\Attributes\{Layout, Title};
use Livewire\WithPagination;

#[Layout('layouts.freelance-layout')]
#[Title('Freelance Commande')]
class MissionList extends Component
{
    use WithPagination;

    public $count;
    public $category;
    public $price_range;
    public $trie;
    public $dateDebut;


    protected $queryString = [
        'trie',
        'category',
        'price_range',
        'price_range',
    ];
    public function render()
    {
        $query = Mission::query();

        $query->where('status', 'pending')->where('is_paid', null);

        // Filtre par catégorie
        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        // Filtre par budget
        if ($this->price_range) {

            list($min, $max) = explode('-', $this->price_range);

            // Supposons que price_range soit sous la forme "min-max"
            $query->whereBetween('budget', [$min, $max]);

        }

        // Filtre par date de début
        if ($this->dateDebut) {
            $query->whereDate('begin_mission', '>=', $this->dateDebut);
        }

        // Trier
        if ($this->trie) {
            // Supposons que trie soit sous la forme "column-direction", par exemple "budget-asc"
            list($column, $direction) = explode('-', $this->trie);
            $query->orderBy($column, $direction);
        }

        return view('livewire.freelance.mission.mission-list', [
            'projets' => $query->paginate(10),
        ]);
    }

}
