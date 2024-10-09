<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

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
                    'size'  => $request->size
                ]
            ]);
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
                    'size'  => $request->size
                ]
            ]);
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
        return response()->json(['success' => 'Successfully Removed From Your Cart']);
    }
    public function MyCart(){
        return view('frontend.mycart.view_mycart');
    }
    public function qtyDecrement($id){
        $row = Cart::get($id);
        Cart::update($id,$row->qty-1);
        return response()->json('Decrement');

    }
    public function qtyIncrement($id){
        $row = Cart::get($id);
        Cart::update($id,$row->qty+1);
        return response()->json('Increment');

    }
}
