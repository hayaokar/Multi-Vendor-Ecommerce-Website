<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function PendingOrders()
    {
        $orders  = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        $status = 'Pending Orders';
        return view('backend.orders.orders', compact('orders', 'status'));
    }
    public function ConfirmedOrders()
    {
        $orders  = Order::where('status', 'confirmed')->orderBy('id', 'DESC')->get();
        $status = 'Confirmed Orders';
        return view('backend.orders.orders', compact('orders', 'status'));
    }
    public function ProcessingOrders()
    {
        $orders  = Order::where('status', 'processing')->orderBy('id', 'DESC')->get();
        $status = 'Processing Orders';
        return view('backend.orders.orders', compact('orders', 'status'));
    }
    public function DeliveredOrders()
    {
        $orders  = Order::where('status', 'delivered')->orderBy('id', 'DESC')->get();
        $status = 'Delivered Orders';
        return view('backend.orders.orders', compact('orders', 'status'));
    }
    public function OrderDetails(Order $order)
    {
        $orderItem = $order->orderItems()->with('product')->get();
        return view('backend.orders.order_details', compact('order', 'orderItem'));
    }
    public function OrderConfirm(Order $order)
    {
        $order->update(['status' => 'confirmed']);
        $notification = array(
            'message' => 'Order Confirmed Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('confirmed.orders')->with($notification);
    }
    public function OrderProcess(Order $order)
    {
        $order->update(['status' => 'processing']);
        $notification = array(
            'message' => 'Order Marked as Processing Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('processing.orders')->with($notification);
    }
    public function OrderDeliver(Order $order)
    {
        $orderItems = $order->orderItems->pluck('qty','product_id');
        Product::whereIn('id',$orderItems->keys())
            ->each(function ($product) use ($orderItems){
                $product->decrement('product_qty',$orderItems[$product->id]);
            });
        $order->update(['status' => 'delivered']);
        $notification = array(
            'message' => 'Order Marked as Delivered Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('delivered.orders')->with($notification);
    }
}
