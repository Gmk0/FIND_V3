<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\welcomeMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public $pushNotificationType = 'users';

    public $incrementing = false;
    protected $keyType = 'string';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'string',
        'last_activity' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public static function boot()
    {
        parent::boot();


        static::creating(function ($user) {
            $user->id =
                Str::uuid()->toString();
        });
        static::created(function ($user) {

            UserSetting::create(['user_id' => $user->id]);

            //Mail::to($user->email)->send(new welcomeMail($user));
        });
    }

    public function canAccessFilament(): bool
    {
        return str_ends_with($this->email, '@find-freelance.com') && $this->hasVerifiedEmail();
    }


    public function freelance()
    {
        return $this->hasOne(Freelance::class);
    }

    public function userSetting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function favoritesService()
    {
        return $this->belongsToMany(Service::class, 'favorites')
            ->withTimestamps();
    }

    public function favoritesFreelance()
    {
        return $this->belongsToMany(Freelance::class, 'favorites')->withTimestamps()->orderByDesc('favorites.created_at');
    }

    public function getIdFreelance()
    {
        return $this->freelance->id;
    }




}
