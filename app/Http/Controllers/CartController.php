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
        $cartItem = Cart::where('user_id', $user->id)->where('product_id', $product->id)->where('addons', null)->first();

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

        if ($request->ajax()) {
            return response()->json(['message' => 'Product removed from cart']);
        }

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

//        Log::info(json_encode([['productId' => $productId, 'type' => gettype($productId)],['addons' => $addons, 'type' => gettype($addons)],['quantity' => $quantity, 'type' => gettype($quantity)],['product' => $product, 'type' => gettype($product)],['cartItems' => $cartItems, 'type' => gettype($cartItems)],['cartItem' => $cartItem, 'type' => gettype($cartItem)]]));

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
            $cartItemAddons = json_decode($cartItem->addons);

            // If the cart item has no addons and the provided addons are also empty,
            // or if the cart item's addons and the provided addons are the same,
            // return the cart item
            if ((empty($cartItemAddons) && empty($addons)) ||
                (!empty($cartItemAddons) && !empty($addons))) {
                sort($cartItemAddons);
                sort($addons);
                if ($cartItemAddons == $addons) {
                    return $cartItem;
                }
            }
        }

        // If no matching cart item is found, return null
        return null;
    }


    public function getTotalPrice(Request $request)
    {
        return response()->json(['total' => Cart::getTotalPrice()]);
    }

    public function clear(Request $request)
    {
        Cart::where('user_id', auth()->user()->id)->delete();
        return response()->json(['message' => 'Cart cleared successfully']);
    }

    public function updateQuantityMini(Request $request)
    {
        $itemId = $request->itemId;
        $action = $request->action;

        $item = Cart::findOrFail($itemId);

        $quantity = $item->quantity;

        if ($quantity < 1 || $quantity > 100) {
            return response()->json([
                'message' => 'Quantity must be greater than 0 and less than 100',
            ]);
        }

        if ($action == 'increment') {
            $quantity++;
        } elseif ($action == 'decrement') {
            $quantity--;
        }

        $item->update([
            'quantity' => $quantity
        ]);

        return response()->json(['message' => 'Quantity updated successfully']);
    }
}
