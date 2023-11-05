<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->user()) {
            return redirect()->route('user.login')->with('error', 'Please login to continue');
        }
        $product = Product::findOrFail($request->productId);
        Cart::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        return response()->json([
            'message' => 'Product added to cart'
        ]);
    }
}
