<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // ✅ Specify the correct table name

    public $timestamps = false; // ✅ Disable timestamps

    protected $fillable = ['name', 'email', 'phno', 'is_active'];


    protected $hidden = [
        'password',
    ];

    // ✅ Force Laravel to ignore timestamps
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->timestamps = false;
        });
    }

    
    
}
