<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientLink extends Model
{
    use HasFactory;

    protected $fillable =['user_id', 'uniqueID', 'proposal_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposal()
    {
        return $this->belongsTo(proposal::class);

    }
}


