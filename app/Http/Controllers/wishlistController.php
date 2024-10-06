<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    //
    public function addToWishlist($id){
        if(Auth::check()){
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
            if(!$exists){
                Wishlist::insert([
                   'product_id' => $id,
                   'user_id'    => Auth::id(),
                   'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Added To Wishlist Successfully!']);
            }else
                return response()->json(['error' => 'Already Existed In Your Wishlist']);
        }else
            return response()->json(['error' => 'Login To Your Account']);
    }
    public function Wishlist(){
        return view('frontend.wishlist.view_wishlist');
    }
    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method

    public function RemoveWishlistProduct($id){
        Wishlist::where('id',$id)->delete();

        return response()->json(['success'=>'Removed From Wishlist Successfully']);
    }
}
