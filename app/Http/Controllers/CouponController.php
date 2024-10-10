<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function AllCoupons(){
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.coupon_all',compact('coupons'));
    }
    public function AddCoupon(){
        return view('backend.coupon.coupon_add');
    }
    public function StoreCoupon(Request $request){
        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('message'=>'Coupon Added Successfully','alert-type'=>'success');
        return redirect()->route('all.coupons')->with($notification);
    }
    public function EditCoupon($id){
        $coupon = Coupon::findorfail($id);
        return view('backend.coupon.coupon_edit',compact('coupon'));

    }
    public function UpdateCoupon(Request $request){
        $coupon = Coupon::findorfail($request->id);
        $coupon->update([
            'coupon_name' => strtoupper($request->coupon_name) ,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
        ]);
        $notification = array('message'=>'Coupon Updated Successfully','alert-type'=>'success');
        return redirect()->route('all.coupons')->with($notification);
    }
    public function DeleteCoupon($id){
        Coupon::findorfail($id)->delete();
        $notification = [
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
