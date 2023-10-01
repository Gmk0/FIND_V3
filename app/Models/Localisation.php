<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Localisation extends Model
{
    use HasFactory;

    protected  $fillable=['ville','Pays'];

    public function Communes():HasMany
    {
        return $this->hasMany(Communes::class);
    }
}
