<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function AddReview(Request $request){
        $request->validate([
            'comment' => 'required'
        ]);
        Review::create([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::user()->id,
            'comment'=> $request->comment,
            'rating'=>$request->rating
        ]);
        $notification = [
            'message' => 'Review Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);

    }
}
