<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function pendingReviews()
    {
        $reviews =  Review::where('status', 0)->latest()->get();
        return view('backend.reviews.pending_reviews', compact('reviews'));
    }
    public function acceptedReviews()
    {
        $reviews =  Review::where('status', 1)->latest()->get();
        return view('backend.reviews.accepted_reviews', compact('reviews'));

    }
    public function acceptReview(Review $review){
        $review->update([
            'status' => 1
        ]);
        $notification = [
            'message' => 'Review Accepted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.reviews.accepted')->with($notification);
    }
    public function rejectReview(Review $review){
        $review->delete();
        $notification = [
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function VendorReviews(){
        $vendor = Auth::user()->id;
        $reviews = Review::with('product')->whereHas('product', function ($query) use ( $vendor) {
            $query->where('vendor_id', $vendor);
        })->where('status',1)->get();
        return view('vendor.backend.reviews.reviews_all',compact('reviews'));
    }
}
