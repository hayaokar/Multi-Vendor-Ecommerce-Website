<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\city;
use App\Models\region;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function CityGetAjax($country_id){

        $city = region::where('country_id',$country_id)->orderBy('name','ASC')->get();
        return json_encode($city);

    } // End Method



    public function CheckoutStore(Request $request){

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;

        $data['country_id'] = $request->country_id;
        $data['city_id'] = $request->city_id;
        $data['shipping_address'] = $request->shipping_address;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        if ($request->payment_option == 'stripe') {
            return view('frontend.payment.stripe',compact('data','cartTotal'));
        }elseif ($request->payment_option == 'card'){
            return 'Card Page';
        }else{
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }


    }// End Method
}
