<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScrapCategory extends Model
{
    protected $table = 'scrapcategory'; // Ensure table name is correct
    protected $fillable = ['category'];

    public function scrapRates(): HasMany
    {
        return $this->hasMany(ScrapRate::class, 'category', 'id');
    }
}
