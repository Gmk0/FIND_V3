<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MissionResponse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'freelance_id',
        'mission_id',
        'content',
        'budget',
        'status',
        'is_paid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'freelance_id' => 'integer',
        'mission_id' => 'integer',
        'budget' => 'decimal:2',
        'is_paid' => 'datetime',
    ];



    public function freelance(): BelongsTo
    {
        return $this->belongsTo(Freelance::class);
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}
