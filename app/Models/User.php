<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;   // ✅ Add this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail   // ✅ Implement MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'user';       // ✅ Use your custom table name
    public $timestamps = false;      // ✅ Disable timestamps

    protected $fillable = ['name', 'email', 'password', 'phno', 'is_active', 'verification_token'];

    protected $hidden = ['password'];

    // ✅ Force Laravel to ignore timestamps
    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->timestamps = false;
        });
    }
}
