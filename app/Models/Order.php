<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

}
