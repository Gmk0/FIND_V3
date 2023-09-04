<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Freelance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'identifiant',
        'description',
        'experience',
        'langue',
        'diplome',
        'certificat',
        'site',
        'competences',
        'taux_journalier',
        'comptes',
        'sub_categorie',
        'localisation',
        'user_id',
        'category_id',
        'level',
        'solde',
        'realisations',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'langue' => 'array',
        'diplome' => 'array',
        'certificat' => 'array',
        'competences' => 'array',
        'taux_journalier' => 'decimal:2',
        'comptes' => 'array',
        'sub_categorie' => 'array',
        'localisation' => 'array',
        'category_id' => 'integer',
        'solde' => 'decimal:2',
        'realisations' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'freelance_id')
        ->withTimestamps();
    }


    public function isFavorite()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->exists();
    }
}
