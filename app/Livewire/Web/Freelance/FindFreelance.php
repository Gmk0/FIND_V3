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

#[Title('Creer missiion')]

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

    protected $queryString = [

        'query',

    ];









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

    public function nextPage()
    {
        $this->setPage($this->page + 1);

        dd('lolo');
        $this->dispatch('gotoTop');
    }

    public function updatedPage($page)
    {
        $this->dispatch('gotoTop');
    }

    public function previousPage()
    {
        $this->setPage(max($this->page - 1, 1));
        $this->emit('gotoTop');
    }
    public function render()
    {
        return view('livewire.web.freelance.find-freelance', [
            'freelances' => Freelance::when($this->category, function ($query) {
                $query->where('category_id', '=', $this->category);
            })->when($this->sub_category, function ($query) {
                $query->where('sub_categorie', 'LIKE', '%"' . $this->sub_category . '"%');
            })->when($this->experience, function ($q) {
                $q->where('experience', 'LIKE', '%"' . $this->experience . '"%');
            })->WhereHas('category', function ($query) {
                $query->where('name', 'LIKE', "%" . $this->query . "%");
            })
                ->when($this->taux, function ($query) {
                    $query->whereBetween('daily_tax', [10, $this->taux]);
                })
                ->paginate(9),
            'categories' => Category::all(),
            'subcategories' => Subcategory::where('category_id', $this->category)->get(),
        ]);
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
