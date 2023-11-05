<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function store(Request $request)
    {
        $productId = $request->input('productId');
        $user = auth()->user();

        $product = Product::findOrFail($productId);
        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            $message = 'Product quantity updated successfully';
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
            $message = 'Product added to cart successfully';
        }

        return response()->json([
            'message' => $message,
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $itemId = $request->itemId;
        $quantity = $request->quantity;

        if ($quantity < 1 || $quantity > 100) {
            return response()->json([
                'message' => 'Quantity must be greater than 0 and less than 100',
            ]);
        }

        Cart::findOrFail($itemId)->update([
            'quantity' => $quantity
        ]);

        return response()->json(['message' => 'Quantity updated successfully']);
    }


    public function destroy(Request $request)
    {
        $itemId = $request->itemId;
        Cart::findOrFail($itemId)->delete();
        return back()->with(['success' => 'Product removed from cart']);
    }
}
