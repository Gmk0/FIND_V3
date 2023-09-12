<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'mission_id',
        'description',

    ];

    protected $casts = [

        'mission_id' => 'integer',
        'order_id' => 'integer',


    ];



    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function Mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
