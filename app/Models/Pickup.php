<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;

    protected $table = 'schedule_pickup'; // ✅ Correct table name
    protected $primaryKey = 'id'; // ✅ Primary key
    public $incrementing = true; // ✅ Auto-incrementing ID
    protected $keyType = 'int'; // ✅ ID is an integer

    public $timestamps = true; // ✅ Allow `updated_at` to be managed by Laravel

    // ✅ Define fillable fields
    protected $fillable = [
        'category', 'date', 'time', 'address', 'weight', 'remark',
        'image', 'email', 'status', 'total_weight', 'amount_paid'
    ];
}

