<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function getTotalQuantity()
    {
        return Cart::where('user_id', auth()->user()->id)->sum('quantity');
    }

    public static function getTotalPrice()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        $total = 0;
        foreach($cartItems as $item){
            $itemPrice = $item->product->price;
            $total += $item->quantity * $itemPrice;
            if ($item->addons != null && $item->addons != []) {
                $addons = json_decode($item->addons);
                foreach ($addons as $addon) {
                    $addonObject = Addons::firstWhere('slug' , $addon);
                    $total += $addonObject->price * $item->quantity;
                }
            }
        }

        return $total;
    }

}
