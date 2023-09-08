<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeedbackService extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'mission_id',
        'etat',
        'delai_livraison_estimee',
        'commentaires',
        'satisfaction',
        'problemes',
        'actions_correctives',
        'is_publish',
    ];





    protected $casts = [

        'id' => 'integer',
        'order_id' => 'integer',
        'mission_id' => 'integer',
        'delai_livraison_estimee' => 'datetime',

    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
