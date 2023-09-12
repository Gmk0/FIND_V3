<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = [
        'push_notifications_enabled',
        'email_notifications_enabled',
        'send_invoice_enabled',
        'number_notifications_enabled',
        'theme',
        'user_id',
    ];


    protected $casts=[
        'push_notifications_enabled'=>'boolean',
        'email_notifications_enabled'=>'boolean',
        'send_invoice_enabled' => 'boolean',
        'number_notifications_enabled' => 'boolean',
    ];
}
