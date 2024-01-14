<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected static $unguarded = true;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getTotalQuantity()
    {
        return Cart::where('user_id', auth()->user()->id)->sum('quantity');
    }

    public function getItemPrice()
    {
        $itemPrice = $this->quantity * $this->product->price;
        foreach ($this->getAddons() as $addon) {
            $itemPrice += $addon->price * $this->quantity;
        }
        return $itemPrice;
    }

    public function getAddons()
    {
        $addonsSlugs = json_decode($this->addons ?? '[]') ?? [];
        $addons = [];
        foreach ($addonsSlugs as $slug) {
            $addons[] = Addons::firstWhere('slug', $slug);
        }
        return $addons;
    }

    public function getAddonsSlugs()
    {
        return json_decode($this->addons ?? '[]');
    }

    public static function getTotalPrice()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        $total = 0;
        foreach ($cartItems as $item) {
            $itemPrice = $item->product->price;
            $total += $item->quantity * $itemPrice;
            $addons = $item->getAddons();
            foreach ($addons as $addon) {
                $total += $addon->price * $item->quantity;
            }
        }

        return $total;
    }

    public static function hasAddons()
    {
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        foreach ($cartItems as $item) {
            if ($item->addons != null && $item->addons != []) {
                return true;
            }
        }
        return false;
    }

}
