<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'illustration',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function services()
    {
        $allServices = Service::all();

        // Filter services based on the subcategory attribute
        $relatedServices = $allServices->filter(function ($service) {
            // Assuming subcategory is already an array
            $subCategoryIds = $service->sub_category;
            return in_array($this->id, $subCategoryIds);
        });

        return $relatedServices;
        // Récupérez tous les services dont l'attribut subcategory contient l'ID de cette sous-catégorie

    }

    public function getServicesAttribute()
    {

        $allServices = Service::all();

        // Filter services based on the subcategory attribute
        $relatedServices = $allServices->filter(function ($service) {
            // Assuming subcategory is already an array
            $subCategoryIds = $service->sub_category;
            return in_array($this->id, $subCategoryIds);
        });

        return $relatedServices;
    }




}
