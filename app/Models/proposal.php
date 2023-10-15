<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proposal extends Model
{
    use HasFactory;

    protected $fillable=['proposed_price', 'status'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function isLastMessage()
    {
        return $this->id === $this->messages()->orderBy('created_at', 'desc')->first()->id;
    }


    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }

    // Dans le modèle Proposal
    public function updateStatusAndPrice($status, $proposedPrice = null)
    {
        $this->status = $status;

        if ($status === 'changed' && !is_null($proposedPrice)) {
            $this->proposed_price = $proposedPrice;
        }

        $this->save();
    }


}
