<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'sub_category',
        'description',
        'files',
        'budget',
        'begin_mission',
        'end_mission',
        'progress',
        'transaction_id',
        'is_paid',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'sub_category' => 'array',
        'files' => 'array',
        'budget' => 'decimal:2',
        'begin_mission' => 'date',
        'end_mission' => 'date',
        'transaction_id' => 'integer',
        'is_paid' => 'datetime',
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function projectResponses(): HasMany
    {
        return $this->hasMany(ProjectResponse::class);
    }

    public function conversationProjects(): HasMany
    {
        return $this->hasMany(ConversationProject::class);
    }
}
