<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ScrapRate extends Model
{
    protected $table = 'scraprate';
    protected $fillable = ['scrap', 'category_id', 'priceperkg'];

    public function category()
    {
        return $this->belongsTo(ScrapCategory::class, 'category_id');
    }
}


