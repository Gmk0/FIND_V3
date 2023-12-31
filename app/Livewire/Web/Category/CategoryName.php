<?php

namespace App\Livewire\Web\Category;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\{Category, FeedbackService, Service, SubCategory};
use Livewire\WithPagination;

#[Layout('layouts.web-layout')]
#[Title('Categories')]

class CategoryName extends Component
{
    use WithPagination;
    public $category;
    public $price_range;
    public $trie;
    public $filter;
    public $search ='';



    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->dispatch('gotoTop');
    }

    public function nextPage()
    {
        $this->setPage($this->page + 1);


        $this->dispatch('gotoTop');
    }

    public function updatedPage($page)
    {
       // $this->dispatch('gotoTop');
    }
    public function updating()
    {
        $this->resetPage();
    }

    public function setCategory($categoryId)
    {
        if ($this->category == $categoryId) {
            $this->category = null; // Deactivate the category if it's already active
        } else {
            $this->category = $categoryId; // Activate the selected category
        }
        // You can also add any other logic here, like refreshing the component or fetching new data based on the category_id
    }


    public function render()
    {


        // Apply search filter
        $query = Service::query();

        // If there's a search term, filter services based on it
        if ($this->search) {
            // Get IDs of Subcategories that match the search term
            $subCategoryIds = SubCategory::where('name', 'LIKE', '%' . $this->search . '%')->pluck('id')->toArray();

            $query->where(function ($query) use ($subCategoryIds) {
                $query->where('title', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('tag', 'LIKE', '%' . $this->search . '%')
                    ->orWhereHas('category', function ($q) {
                        $q->where('name', 'LIKE', '%' . $this->search . '%');
                    });
            });
        }

        // Apply category filter
        if ($this->category) {
            $query->where('category_id', $this->category); // Assuming 'category_id' is the column name
        }




        // Apply price filter
        if ($this->price_range) {

            $query->where('basic_price', '<=', $this->price_range); //
        }

        // Apply order by filter
        if ($this->trie) {


            // Supposons que trie soit sous la forme "column-direction", par exemple "budget-asc"
            list($column, $direction) = explode('-', $this->trie);


            // Si les valeurs sont "populaire" ou "nouveau", ajustez le champ et la direction en conséquence
            if ($column === 'populaire') {
                $query->withCount('orders') // Assurez-vous que votre relation s'appelle "orders"
                    ->orderBy('orders_count', $direction); // Triez par le nombre de commandes
            } elseif ($column === 'nouveau') {
                $query->orderBy('created_at', 'desc');
            } elseif ($column === 'Ancien') {
                $query->orderBy('created_at', 'asc');
            } elseif ($column === 'cote') {
                $query->leftJoinSub(
                    FeedbackService::selectRaw('order_id, AVG(satisfaction) as avg_feedback')
                        ->groupBy('order_id'),
                    'feedbacks',
                    'services.id',
                    '=',
                    'feedbacks.order_id'
                )->orderBy('feedbacks.avg_feedback', 'desc');
            }
            else {
                $query->orderBy($column, $direction);
            }
        }



        return view('livewire.web.category.category-name', [
            'categories' => Category::all(),
            'services' => $query->paginate(10),
        ]);
    }

}
