<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;

class StripeController extends Controller
{
    //
    public function StripeOrder(Request $request){

        $user = User::where('role','admin')->get();

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total(),2);
        }

        \Stripe\Stripe::setApiKey('sk_test_51LRhNHGsd6eTpzoiele0YFhhqyZvcrywSVBusXRPSU2EvW2WPRdWitdF9tkXDMOJQwmw0EdzWO90npFC5JXg0zZJ007R8ZaIvp');


        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'usd',
            'description' => 'Easy Multi Vendor Shop',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,


            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),


        ]);

        $cart_items = Cart::content();

        foreach ($cart_items as $cart_item){
            OrderItem::insert([
                'order_id'=>$order_id,
                'product_id'=>$cart_item->id,
                'vendor_id'=>$cart_item->options->vendor,
                'color'=>$cart_item->options->color,
                'size'=>$cart_item->options->size,
                'qty'=>$cart_item->qty,
                'price'=>$cart_item->price,
                'created_at'=>Carbon::now(),
            ]);
        }

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        Cart::destroy();

        $notification = array(
            'message' => 'We have received your order #no. ' . $order_id ,
            'alert-type' => 'success'
        );

        Notification::send($user, new OrderComplete($request->name));

        return redirect()->route('user.dashboard')->with($notification);



    }// End Method

    public function CashOrder(Request $request){


        $user = \App\Models\User::where('role','admin')->get();
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }


        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'country_id' => $request->country_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'adress' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,



            'payment_type' => 'Cash On Delivery',
            'payment_method' => 'Cash On Delivery',
            'currency' => 'Usd',
            'amount' => $total_amount,

            'invoice_no' => 'EOS'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),


        ]);

        $carts = Cart::content();
        foreach($carts as $cart){

            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' =>Carbon::now(),

            ]);

        } // End Foreach

        $invoice = Order::findorfail($order_id);

        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email
        ];

        Mail::to($request->email)->send(new OrderMail($data));


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();


        $notification = array(
            'message' => 'We have received your order #no. ' . $order_id ,
            'alert-type' => 'success'
        );

        Notification::send($user, new OrderComplete($request->name));

        return redirect()->route('user.dashboard')->with($notification);



    }// End Method

}
