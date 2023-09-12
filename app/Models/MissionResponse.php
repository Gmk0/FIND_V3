<?php

namespace App\Models;

use App\Notifications\MissionStatus;
use App\Notifications\MissionStatusResponse;
use Exception;
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
        'response_numero',
        'mission_id',
        'content',
        'budget',
        'status',
        'is_paid',
    ];



    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {

            $model->response_numero = 'MSR' . date('YmdHms');
        });


    }
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


    public function notifyUser()
    {
        try{

            $user = $this->mission->user;

            if ($user) {

                $user->notify(new MissionStatus($this));
            }

        }catch(Exception $e){

           // dd($e->getMessage());

        }

    }


    public function notifyFreelance()
    {

try {


    $user = $this->freelance->user;

    if ($user) {

        $user->notify(new MissionStatusResponse($this));
    }

}catch(Exception $e){

error_log($e->getMessage());

}
    }


    public function freelance(): BelongsTo
    {
        return $this->belongsTo(Freelance::class);
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(Mission::class);
    }
}
