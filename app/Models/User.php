<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'user';               // ✅ Specify custom table name
    public $timestamps = false;              // ✅ Disable timestamps

    // ✅ Add 'role' to the fillable array
    protected $fillable = ['name', 'email', 'password', 'phno', 'is_active', 'verification_token', 'role'];

    protected $hidden = ['password', 'verification_token'];  // ✅ Hide token from API response

    // ✅ Improved timestamp handling (no need for extra saving event)
}
