<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        $total = Cart::getTotalQuantity();

        return response()->json([
            'message' => $message,
            'total' => $total
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

    public function storeWithAddons(Request $request)
    {
        $user = auth()->user();

        $productId = $request->input('productId');
        $addons = $request->input('productAddons');
        $quantity = $request->input('quantity');

        $product = Product::findOrFail($productId);
        $cartItems = Cart::where('user_id', $user->id)->where('product_id', $product->id)->get();

        $cartItem = $this->getTheCartItemIfExist($cartItems, $addons);

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            $message = 'Product quantity updated successfully';
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'addons' => json_encode($addons),
                'quantity' => $quantity,
            ]);
            $message = 'Product added to cart successfully';
        }

        $total = Cart::getTotalQuantity();

        return response()->json([
            'message' => $message,
            'total' => $total
        ]);
    }

    public function getTheCartItemIfExist($cartItems, $addons)
    {
        foreach ($cartItems as $cartItem) {
            if (empty(array_diff(json_decode($cartItem->addons ?? "[]") ?? [], $addons ?? []))) {
                return $cartItem;
            }
        }
        return null;
    }

    public function getTotalPrice(Request $request)
    {
        return response()->json(['total' => Cart::getTotalPrice()]);
    }
}
