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
        'mission_numero',
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
        'user_id' => 'string',

    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {

            $model->user_id = auth()->user()->id;
            $model->mission_numero = 'MS' . date('YmdH');
        });

        static::created(function ($model) {

            FeedbackService::create(['mission_id' => $model->id]);
        });

        static::deleted(function ($model) {

            FeedbackService::where('mission_id', $model->id)->delete();
        });
    }


    public function budget()
    {
        // Formater le prix avec le dollar direct
        return '$' . number_format($this->budget, 2, ',', ' ');
    }


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
