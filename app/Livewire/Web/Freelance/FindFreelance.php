<?php

namespace App\Livewire\Web\Freelance;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;




use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Freelance;

use Filament\Forms\Components\FileUpload;
use Livewire\WithFileUploads;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\{TextInput, Textarea, Select};
use Illuminate\Support\Collection;
use Filament\Forms\Get;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;

use Livewire\WithPagination;

#[Layout('layouts.web-layout')]

#[Title('Freelance')]

class FindFreelance extends Component

implements HasForms

{

    use InteractsWithForms;
    use WithFileUploads;
    use WithPagination;

    public $category;
    public $sub_category;

    public $specialite = null;
    public $query = "";
    public $trie;
    public $experience;
    public $disponibilite;
    public $taux;
    public $message = false;
    public $freelance_id;
    public $body;
    public $conversations = null;
    public $localisation;
    public $isonLine=null;
    public $freelance_niveau=[];

    protected $queryString = [



    ];




    public function resetAll(){

     $this->category=null;

        $this->
        sub_category = null;
              $this-> specialite = null;
        $this->
        query = "";
              $this->
        disponibilite = null;
        $this->taux
        = null;
              $this->
        isonLine = null;
        $this->
        freelance_niveau = [];




    }
    public function countFiltersApplied()
    {
        $count = 0;

        if ($this->query) $count++;
        if ($this->category) $count++;
        if ($this->specialite) $count++;
        if ($this->disponibilite) $count++;
        if (!empty($this->freelance_niveau) && is_array($this->freelance_niveau)) $count++;
        if ($this->taux) $count++;

        if ($this->localisation) $count++;
        if ($this->isonLine) $count++;

        // ... Ajoutez d'autres conditions pour d'autres filtres ici si nécessaire

        return $count;
    }






    public function onLine($query)
    {
        if ($query === 'online') {
            $this->isonLine = $this->isonLine === true ? null : true;
        } elseif ($query === 'offline') {
            $this->isonLine = $this->isonLine === false ? null : false;
        } else {
            $this->isonLine = null;
        }
    }

    public function PriceRest()
    {
        $this->taux=null;

    }

    public function level($level)
    {
        // Vérifiez si le niveau est déjà dans le tableau
        $this->freelance_niveau = is_array($this->freelance_niveau) ? $this->freelance_niveau : [];

        // Vérifiez si le niveau est déjà dans le tableau
        if (in_array($level, $this->freelance_niveau)) {
            // Si c'est le cas, supprimez-le
            $this->freelance_niveau = array_diff($this->freelance_niveau, [$level]);
        } else {
            // Sinon, ajoutez-le
            $this->freelance_niveau[] = $level;
        }
    }





    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <svg>...</svg>
        </div>
        HTML;
    }
    #[Layout('layouts.web-app-layout')]


    public function updating()
    {
        $this->resetPage();
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->dispatch('gotoTop');
    }

    public function nextPage($page)
    {
        $this->setPage($page);


        $this->dispatch('gotoTop');
    }

    public function updatedPage($page)
    {
        $this->dispatch('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->dispatch('gotoTop');
    }


    public function render()
    {
        return view('livewire.web.freelance.find-freelance', [
            'freelances' => $this->filteredFreelances(),
            'categories' => Category::all(),
            'nowOnline'=>Freelance::whereHas('user',function($q){
                $q->where('is_online',true);

            })->count(),
            'subcategories' => Subcategory::whereHas('category', function ($q) {
                $q->where('name', $this->category);
            })->get(),
        ]);
    }



    protected function filteredFreelances()
    {
        return Freelance::when($this->category, function ($query) {
            $query->whereHas('category', function ($q) {
                $q->where('name', $this->category);
            });
        })->when(!empty($this->freelance_niveau) && is_array($this->freelance_niveau), function ($query) {

                $query->whereIn('level', $this->freelance_niveau);

        })
        ->when($this->sub_category, function ($query) {
            $query->where('sub_categorie', 'LIKE', '%"' . $this->sub_category . '"%');
        })
        ->when($this->experience, function ($q) {
            $q->where('experience', 'LIKE', '%"' . $this->experience . '"%');
        })
        ->whereHas('category', function ($query) {
            $query->where('name', 'LIKE', "%" . $this->query . "%");
        })->when($this->localisation, function ($query) {
                $query->where('localisation_id', $this->localisation);
            })
        ->when($this->taux, function ($query) {
            $query->whereBetween('taux_journalier', [10, $this->taux]);

        })->when($this->trie, function ($query) {
                [$field, $direction] = explode('-', $this->trie);

                // Si les valeurs sont "populaire" ou "nouveau", ajustez le champ et la direction en conséquence
                if ($field === 'populaire') {
                    $query->withCount('orders') // Assurez-vous que votre relation s'appelle "orders"
                        ->orderBy('orders_count', $direction); // Triez par le nombre de commandes
                } elseif ($field === 'nouveau') {
                    $query->orderBy('created_at', $direction);
                } else {
                    $query->orderBy($field, $direction);
                }
            })->when($this->isonLine, function ($query) {
            $query->whereHas('user', function ($q) {
                $q->where('is_online', true);
            });
        })
        ->paginate(9);
    }





    public function unselect($value)
    {
        switch ($value) {
            case 'experience':
                $this->experience = null;
                break;
            case 'taux':
                $this->taux = null;
                break;
            case 'disponibilite':
                $this->disponibilite = null;
                break;
            case 'query':
                $this->query = "";
                break;
            case 'specialite':
                $this->specialite = null;
                break;
            case 'category':
                $this->category = null;
                break;
            case 'sub_category':
                $this->sub_category = null;
                break;
        }
    }
}
