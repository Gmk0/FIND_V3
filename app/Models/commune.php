<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class commune extends Model
{
    use HasFactory;

    protected $fillable=['commune','localisation_id'];


    public function ville(){

        return $this->belongsTo(Localisation::class);
    }
}
