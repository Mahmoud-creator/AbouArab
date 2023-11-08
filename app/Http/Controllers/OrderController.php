<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Manage Orders';

        $orders = Order::orderByDesc('created_at')->get();

        return view('admin.orders', ['orders' => $orders, 'title' => $title]);
    }
    public function store(Request $request)
    {
        $validator = $this->validateCheckoutData($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $orderItems = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        $total = 0;

        foreach ($orderItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->street_address . " " . $request->street_address,
                'amount' => $total,
                'note' => $request->note,
                'region' => $request->region,
                'paid' => false,
            ]);

            foreach ($orderItems as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity
                ]);
            }

            Cart::where('user_id', auth()->user()->id)->delete();


            DB::commit();

            return response()->json(['message' => 'Product ordered successfully']);

        }catch (Exception $e){
            DB::rollBack();
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    public function validateCheckoutData($data)
    {
        $rules = [
            'email' => 'required|email',
            'name' => 'required|string',
            'note' => '',
            'phone' => 'required|string',
            'region' => 'required|string',
            'street_address' => 'required|string',
        ];

        $messages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'name.required' => 'Name is required.',
            'note.required' => 'Note is required.',
            'phone.required' => 'Phone is required.',
            'region.required' => 'Region is required.',
            'street_address.required' => 'Street address is required.',
        ];

        return Validator::make($data, $rules, $messages);
    }

    public function changeState(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->update(['paid' => $request->status]);
        return response()->json(['message' => 'Order status changed successfully']);
    }

    public function show(Request $request)
    {
        $order = Order::findOrFail($request->id);

        $orderItems = OrderProduct::where('order_id', $order->id)->with('product')->get();

        $data = [
            'id' => $order->id,
            'name' => $order->name,
            'email' => $order->email,
            'phone' => $order->phone,
            'address' => $order->address,
            'amount' => $order->amount,
            'created_at' => $order->created_at->format('d M Y'),
            'paid' => $order->paid,
            'note' => $order->note,
            'region' => $order->region,
            'items' => $orderItems
        ];

        return response()->json(['data' => $data]);
    }

    public function destroy(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delete();
        return response()->json(['message' => 'Order status changed successfully']);
    }
}
