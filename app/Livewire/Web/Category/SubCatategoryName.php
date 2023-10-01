<?php

namespace App\Livewire\Web\Category;

use Livewire\Component;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Category;

use App\Models\Service;

#[Layout('layouts.web-layout')]
#[Title('Sous categories')]

class SubCatategoryName extends Component
{
    use WithPagination;

    public $categories;
    public $subcategoryName = "";
    public $selectedTag;

    public $search = '';

    public $sous_category = null;
    public $delivery_time = null;
    public $freelance_niveau = [];
    public $price_range = null;
    public $orderBy = null;
    public $subcategoryChoose;
    public $subcat = null;
    public $localisation;
    public $trie;
    public $categoryElement;


    protected $queryString = [

        'delivery_time',
        'freelance_niveau',
        'price_range',
        'trie'
    ];

    public function mount($sub_name)
    {
        $categoryExist = SubCategory::where('name', '=', $sub_name)->exists();



        if (!$categoryExist) {

            return $this->redirect('/', );
        } else {

            $subcategoryName = str_replace('+', ' ', $sub_name);
            $this->subcategoryName = $subcategoryName;

            $this->subcategoryChoose = SubCategory::where('name', '=', $subcategoryName)->first();
            $this->categoryElement = $this->subcategoryChoose->Category;
        }
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
    public function PriceRest()
    {
        $this->price_range = null;
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



    public function render()
    {
        return view('livewire.web.category.sub-catategory-name',[
            'services' => $this->queryServices(),
           'count' => $this->queryServicesCount(),
            'tags' => $this->getTagsForCategory(),
            'subcatgeoryElement' =>  $this->categoryElement->subCategories
        ]);
    }

    public function servicesElement()
    {
        // Obtenez tous les IDs des services liés
        $relatedServiceIds = Service::all()
            ->filter(function ($service) {
                // Assuming subcategory is already an array
                $subCategoryIds = $service->sub_category;
                return in_array($this->subcategoryChoose->id, $subCategoryIds);
            })
            ->pluck('id');



        // Retournez une requête pour ces services
        return Service::whereIn('id', $relatedServiceIds);
    }

    public function queryServices()
    {
        $query = $this->servicesElement();
        return $query
            ->when($this->delivery_time, function ($query) {
                $range = $this->getDeliveryTimeRange();
                $query->whereBetween('basic_delivery_time', $range);
            })
            ->when(!empty($this->freelance_niveau) && is_array($this->freelance_niveau), function ($query) {
                $query->whereHas('freelance', function ($query) {
                    $query->whereIn('level', $this->freelance_niveau);
                });
            })
            ->when($this->price_range, function ($query) {
                $query->whereBetween('basic_price', [10, $this->price_range]);
            })->when($this->selectedTag, function ($query) {
                $query->where('tag', 'like', "%{$this->selectedTag}%");
            })->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('tag', 'like', '%"' . $this->search . '"%');
            })
            ->when($this->trie, function ($query) {
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
            })

            ->where('is_publish', true)
            ->paginate(12);
    }
    public function queryServicesCount()
    {
        $query = $this->servicesElement();
        return $query
            ->when($this->delivery_time, function ($query) {
                $range = $this->getDeliveryTimeRange();
                $query->whereBetween('basic_delivery_time', $range);
            })
            ->when(!empty($this->freelance_niveau) && is_array($this->freelance_niveau), function ($query) {
                $query->whereHas('freelance', function ($query) {
                    $query->whereIn('level', $this->freelance_niveau);
                });
            })
            ->when($this->price_range, function ($query) {
                $query->whereBetween('basic_price', [10, $this->price_range]);
            })->when($this->selectedTag, function ($query) {
                $query->where('tag', 'like', "%{$this->selectedTag}%");
            })->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('tag', 'like', '%"' . $this->search . '"%');
            })
            ->when($this->trie, function ($query) {
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
            })

            ->where('is_publish', true)
            ->count();
    }

    public function getTagsForCategory()
    {
        $tags = Service::where('sub_category', 'like', '%' . $this->subcategoryName . '%')
            ->pluck('tag')
            ->map(function ($tag) {
                // Vérifiez si $tag est une chaîne avant de la décoder
                return is_string($tag) ? json_decode($tag, true) : $tag;
            })
            ->flatten() // Pour obtenir une collection à une seule dimension
            ->unique()
            ->all();

        return $tags;
    }

    public function filterByTag($tag)
    {
        if ($this->selectedTag === $tag) {
            $this->selectedTag = null; // Réinitialisez si le tag cliqué est le même que le tag actuellement sélectionné
        } else {
            $this->selectedTag = $tag;
        }
        $this->resetPage(); // Si vous utilisez la pagination avec Livewire, cela réinitialisera la page à 1.
    }

    public function countFiltersApplied()
    {
        $count = 0;

        if ($this->search) $count++;
        if ($this->sous_category) $count++;
        if ($this->delivery_time) $count++;
        if (!empty($this->freelance_niveau) && is_array($this->freelance_niveau)) $count++;
        if ($this->price_range) $count++;
        if ($this->orderBy) $count++;
        if ($this->localisation) $count++;
        if ($this->selectedTag) $count++;

        // ... Ajoutez d'autres conditions pour d'autres filtres ici si nécessaire

        return $count;
    }

    public function resetAll()
    {
        $this->search = '';
        $this->sous_category = null;
        $this->delivery_time = null;
        $this->freelance_niveau = [];
        $this->price_range = null;
        $this->orderBy = null;
        $this->localisation = null;
        $this->selectedTag = null;

        // Si vous avez d'autres propriétés/filtres, réinitialisez-les ici

        // Rechargez la vue pour afficher les résultats sans filtres
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

}
