<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    //
    public function VendorOrders(){
        $orders  = OrderItem::with('order')->where('vendor_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return view('vendor.backend.orders.pending_orders',compact('orders'));
    }
}
