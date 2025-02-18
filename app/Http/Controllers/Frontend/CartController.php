<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\country;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function AddToCart(Request $request,$id){
        $product = Product::findorfail($id);
        if($product->discount_price == NULL){
            Cart::add([
               'id'     =>  $id,
               'name'   => $request->product_name,
                'qty'   => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' =>[
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor' => $request->vendor
                ]
            ]);
            if(Session::has('coupon')){
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name',$coupon_name)->first();

                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100,2),
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 ,2)
                ]);
            }
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }else{
            Cart::add([
                'id'     =>  $id,
                'name'   => $request->product_name,
                'qty'   => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' =>[
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size'  => $request->size,
                    'vendor' => $request->vendor
                ]
            ]);
            if(Session::has('coupon')){
                $coupon_name = Session::get('coupon')['coupon_name'];
                $coupon = Coupon::where('coupon_name',$coupon_name)->first();

                Session::put('coupon',[
                    'coupon_name' => $coupon->coupon_name,
                    'coupon_discount' => $coupon->coupon_discount,
                    'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100,2),
                    'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 ,2)
                ]);
            }
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }

    }
    public function miniCart(){
        $cart        = Cart::content();
        $cartQty     = Cart::count();
        $cartTotal   = Cart::total();

        return response()->json(
            array(
                'carts' => $cart,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal
            )
        );
    }

    public function miniCartRemove($id){
        Cart::remove($id);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100,2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 ,2)
            ]);
        }
        return response()->json(['success' => 'Successfully Removed From Your Cart']);
    }
    public function MyCart(){
        return view('frontend.mycart.view_mycart');
    }
    public function qtyDecrement($id){
        $row = Cart::get($id);
        Cart::update($id,$row->qty-1);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100,2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100 ,2)
            ]);
        }
        return response()->json('Decrement');

    }
    public function qtyIncrement($id){
        $row = Cart::get($id);
        Cart::update($id,$row->qty+1);
        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100,2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100,2 )
            ]);
            return response()->json('Increment');

        }
    }
    public function ApplyCoupon(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if($coupon){
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100,2),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100,2 )
            ]);
            return response()->json(['success'=>'Coupon Applied Successfully','validity'=>true]);
        }else{
            return response()->json(['error'=>'Invalid Coupon']);
        }
    }
    public function totalCalculation(){
        if(Session::has('coupon')){

            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }
    public function removeCoupon(){
        if(Session::has('coupon')){
            Session::remove('coupon');
            return response()->json(['success'=>'Coupon Removed Successfully']);
        }
    }
    public function checkoutCreate(){
        if(Auth::check()){
            if(Cart::total() > 0){
                $carts        = Cart::content();
                $cartQty     = Cart::count();
                $cartTotal   = Cart::total();
                $countries = country::orderBy('name','ASC')->get();
                return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','countries'));
            }else{
                $notification = array(
                    'message' => 'You Need To Add At Least One Item!',
                    'alert-type' => 'error'
                );

                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
