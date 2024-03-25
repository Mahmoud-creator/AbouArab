<?php

namespace App\Http\Controllers;

use App\Models\Addons;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Manage Orders';

        $orders = Order::orderByDesc('created_at')->paginate(15);

        return view('admin.orders', ['orders' => $orders, 'title' => $title]);
    }

    public function store(Request $request)
    {
        $validator = $this->validateCheckoutData($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $orderItems = Cart::where('user_id', auth()->user()->id)->with('product')->get();
        $total = Cart::getTotalPrice();

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->street_address . " " . $request->building_name . " " . $request->floor_number,
                'amount' => $total,
                'note' => $request->note,
                'region' => config('services.branches.' . $request->region . '.name'),
                'paid' => false,
            ]);

            foreach ($orderItems as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'quantity' => $item->quantity,
                    'addons' => $item->addons,
                ]);
            }

            $address = Address::updateOrCreate(['user_id' => auth()->user()->id], [
                'region' => config('services.branches.' . $request->region . '.name'),
                'street' => $request->street_address,
                'building' => $request->building_name,
                'floor' => $request->floor_number,
            ]);

            Cart::where('user_id', auth()->user()->id)->delete();

            DB::commit();

            return response()->json(['message' => 'Product ordered successfully', 'orderReport' => urlencode($this->getOrderReport($order->id, $address, auth()->user())), 'customerMobileNumber' => config('services.branches.' . $request->region . '.phone')]);

        } catch (Exception $e) {
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
            'building_name' => 'required|string',
            'floor_number' => 'required|string',
        ];

        $messages = [
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'name.required' => 'Name is required.',
            'note.required' => 'Note is required.',
            'phone.required' => 'Phone is required.',
            'region.required' => 'Region is required.',
            'street_address.required' => 'Street address is required.',
            'building_name.required' => 'Building name is required.',
            'floor_number.required' => 'Floor number is required.',
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

        foreach($orderItems as $item) {
            $item->price = $item->product->price * $item->quantity;
            if ($item->addons != null) {
                $addons = json_decode($item->addons);
                foreach($addons as $addon) {
                    $addonObject = Addons::firstWhere('slug' , $addon);
                    $item->price += $addonObject->price * $item->quantity;
                }
            }
        }

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
        return response()->json(['message' => 'Order was deleted successfully']);
    }

    public function getOrderReport($orderId, $address, $user)
    {
        $order = Order::findOrFail($orderId);
        $branchName = $address->region;
        $orderNumber = $orderId;
        $orderDate = $order->created_at->format('d M Y');
        $customerName = $order->name;
        $customerEmail = $order->email ?? '--';
        $customerPhone = $order->phone ?? '--';
        $customerAddress = $order->address ?? '--';

        $orderItems = $this->getOrderItems($order);

        return "
        Abou Arab/{$branchName}

        Invoice

        Invoice Number: {$orderNumber}

        Date: {$orderDate}

        Customer Information:

            Name: {$customerName}
            Email: {$customerEmail}
            Phone Number: {$customerPhone}
            Delivery Address: {$customerAddress}

        Order Details:

        {$orderItems}

        Total Amount: $ {$order->amount}
        ";
    }

    public function getOrderItems($order)
    {
        $itemsText = "\t";
        foreach($order->products as $key => $product) {
            $itemsText .= "Item #" . ($key + 1) . ": " . $product->product->name . " - " . $product->quantity . " x " . $product->product->price . " = " . ($product->quantity * $product->product->price) . "\n\t";
            if ($product->addons != null) {
                $addons = json_decode($product->addons);
                foreach($addons as $addon) {
                    $addonObject = Addons::firstWhere('slug' , $addon);
                    $itemsText .= $addonObject->name . " - " . $product->quantity . " x " . $addonObject->price . " = " . ($product->quantity * $addonObject->price) . "\n\t";
                }
                $itemsText .= "\n\t";
            }
        }
        return $itemsText;
    }
}
