<?php

namespace App\Livewire\Web\Other;

use App\Models\Category;
use App\Models\Service;
use Livewire\Component;

use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;


class ToolsSearchPc extends Component

implements HasForms
{
    use InteractsWithForms;

    public $search = '';
    public $category;
    public $hasSearched =false;

    public $selectedIndex = 0;
    public $results = [];

    public $price_range;
    public $delivery_time;




    public function form(Form $form):Form
    {

        return $form->schema([

            Grid::make(['md'=>4])->schema([

                Select::make('category')
                    ->label('categorie')
                    ->options(Category::query()->pluck('name', 'id'))
                    ->live()
                    ->searchable()
                    ->native(false),
                Select::make('price_range'),
                Select::make('delivery_time'),

                ]),


            ]);
    }

    public function getPriceRange()
    {
        if ($this->price_range == '1') {

            return [10, 50];
        } elseif ($this->price_range == '2') {
            return [50, 100];
        } elseif ($this->price_range == '3') {
            return [100, 999999]; // pour les livraisons de plus de 50 jours
        }
    }


    public function resetAll()
    {
        $this->reset('price_range','category', 'delivery_time');
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

        $this->hasSearched=true;

        if (strlen($value) >= 2) {
            $query = Service::with('category');

            // Si une catégorie est sélectionnée, recherchez uniquement le titre pour cette catégorie
            if ($this->category) {
                $query->where('title', 'like', '%' . $value . '%')
                    ->whereHas('category', function ($query) {
                        $query->where('id', '=', $this->category);
                    });
            } else {
                // Sinon, recherchez le titre et la catégorie
                $query->where(function ($query) use ($value) {
                    $keywords = explode(' ', $value);
                    foreach ($keywords as $keyword) {
                        $query->orWhere('title', 'like', '%' . $keyword . '%')
                            ->orWhereHas('category', function ($query) use ($keyword) {
                                $query->where('name', 'like', '%' . $keyword . '%');
                            });
                    }
                });
            }

            if ($this->price_range) {
                // Supposons que price_range soit une chaîne comme "100-200"


                $range = $this->getPriceRange();

                $query->whereBetween('basic_price', $range);
            }

            // Filtrez par delivery_time si défini
            if ($this->delivery_time) {

                $range = $this->getDeliveryTimeRange();

                $query->whereBetween('basic_delivery_time', $range);

            }

            $this->results = $query->limit(10)->get();
        }
    }

    public function getDeliveryTimeRange()
    {
        if ($this->delivery_time == '1-5 jours') {
            return [1, 5];
        } elseif ($this->delivery_time == '5-10 jours') {
            return [5, 10];
        } else {
            return [10, 99999]; // pour les livraisons de plus de 50 jours
        }
    }


    public function render()
    {
        return view('livewire.web.other.tools-search-pc');
    }
}
