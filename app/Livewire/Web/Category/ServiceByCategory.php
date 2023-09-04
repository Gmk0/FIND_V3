<?php

namespace App\Livewire\Web\Category;

use Livewire\Component;

use App\Models\Category;

use App\Models\Service;
use App\Models\SubCategory;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.web-layout')]
#[Title('Creer missiion')]


class ServiceByCategory extends Component
{

    use WithPagination;

    public $categories;
    public $categoryName = "";


    public $sous_category = null;
    public $delivery_time = null;
    public $freelance_niveau = null;
    public $price_range = null;
    public $orderBy = null;
    public $categoryChoose;


    protected $queryString = [
        'sous_category',
        'delivery_time',
        'freelance_niveau',
        'price_range',
    ];

    public function mount($category)
    {


        $categoryExist = Category::where('name', '=', $category)->exists();



        if (!$categoryExist) {

            return $this->redirect('/', navigate: true);
        } else {

            $categoryName = str_replace('+', ' ', $category);
            $this->categoryName = $categoryName;

            $this->categoryChoose = Category::where('name', '=', $categoryName)->first();

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

    public function servicesCount()
    {
        $count = Service::whereHas('category', function ($query) {
            $query->where('name', $this->categoryName);
        })
            ->when($this->sous_category, function ($query) {
                $query->where('sub_category', 'like', '%"' . $this->sous_category . '"%');
            })
            ->when($this->delivery_time, function ($query) {
                $range = $this->getDeliveryTimeRange();

                $query->whereBetween('basic_delivery_time', $range);
            })->when($this->freelance_niveau, function ($query) {
                $query->whereHas('freelance', function ($query) {
                    $query->where('level', $this->freelance_niveau);
                });
            })->when($this->price_range, function ($query) {
                $range = $this->getPriceRange();

                $query->whereBetween('basic_price', $range);
            })->when($this->orderBy, function ($query) {
                $query->orderBy($this->orderBy, 'DESC');
            })->count();



        return $count;
    }
    public function render()
    {
        return view('livewire.web.category.service-by-category',[
            'services' => Service::whereHas('category', function ($query) {
                $query->where('name', $this->categoryName);
            })
                ->when($this->sous_category, function ($query) {
                    $query->where('Sub_categorie', 'like', '%"' . $this->sous_category . '"%');
                })
                ->when($this->delivery_time, function ($query) {
                    $range = $this->getDeliveryTimeRange();

                    $query->whereBetween('basic_delivery_time', $range);
                })->when($this->freelance_niveau, function ($query) {
                    $query->whereHas('freelance', function ($query) {
                        $query->where('level', $this->freelance_niveau);
                    });
                })->when($this->price_range, function ($query) {
                    $range = $this->getPriceRange();

                    $query->whereBetween('basic_price', $range);
                })->when($this->price_range, function ($query) {
                    $query->orderBy($this->orderBy, 'DESC');
                })->where('is_publish', true)


                ->paginate(12),
            'count' => $this->servicesCount(),


            'subCategorie' => SubCategory::where('category_id', '=', $this->categoryChoose->id)->get(),
        ]);
    }
}
