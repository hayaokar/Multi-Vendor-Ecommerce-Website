<?php

namespace App\Http\Controllers;

use App\Models\Compare;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    //
    public function addToCompare($id){
        if(Auth::check()){
            $exists = Compare::where('user_id',Auth::id())->where('product_id',$id)->first();
            if(!$exists){
                Compare::insert([
                    'product_id' => $id,
                    'user_id'    => Auth::id(),
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Added To Your Compare Successfully!']);
            }else
                return response()->json(['error' => 'Already Existed In Your Compare Wishlist']);
        }else
            return response()->json(['error' => 'Login To Your Account']);
    }
    public function GetCompareProduct(){
        if(Auth::check()){
            $compare = Compare::with('product')->where('user_id',Auth::id())->latest()->get();
            $qty = count($compare);
            return response()->json(['compare'=> $compare,'compQty'=> $qty]);
        }
    }

    public function Compare(){
        return view('frontend.compare.view_compare');
    }
    public function RemoveCompareProduct($id){
        Compare::where('id',$id)->delete();

        return response()->json(['success'=>'Removed From Compare Successfully']);
    }
}
