<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchedulePickup extends Model
{
    use HasFactory;

    protected $table = 'schedule_pickup';  // Table name

    protected $fillable = [
        'category',
        'date',
        'time',
        'address',
        'weight',
        'remark',
        'image',
        'email', // Add email field
    ];
    

    public $timestamps = false;
}


