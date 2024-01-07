<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_addons', 'addon_id', 'product_id');
    }

}
