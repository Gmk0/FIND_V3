<?php

namespace App\Models;

use App\Events\OrderCreated;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_numero',
        'user_id',
        'service_id',
        'type',
        'total_amount',
        'quantity',
        'transaction_id',
        'progress',
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
        'service_id' => 'integer',
        'total_amount' => 'decimal:2',
        'is_paid' => 'datetime',
        'transaction_id'=>'integer',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {

            // $order->user_id = auth()->user()->id;
            $order->order_numero = 'CMD' . date('YmdH') . rand(10, 99);
        });

        static::created(function ($order) {

            FeedbackService::create(['order_id' => $order->id]);
        });
    }

    protected $dispatchesEvents = [
        'created' => OrderCreated::class,
    ];




    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }





    public function notifyUser()
    {
        $service = $this->service;

        if ($service) {
            $freelance = $service->freelance;

            if ($freelance) {
                $user = $freelance->user;


                $user->notify(new OrderCreatedNotification($this));
            }
        }
    }


    public function getMontant()
    {
        // Formater le prix avec le dollar direct
        return $this->total_amount . " $";
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    public function rapports(): HasMany
    {
        return $this->HasMany(Rapport::class);
    }

    public function feedback(): HasOne
    {
        return $this->hasOne(FeedbackService::class, 'order_id');
    }
}
