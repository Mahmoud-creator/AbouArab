<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function addons()
    {
        return $this->belongsToMany(Addons::class, 'product_addons', 'product_id', 'addon_id');
    }
}
