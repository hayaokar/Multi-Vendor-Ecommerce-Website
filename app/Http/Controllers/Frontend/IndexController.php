<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\Review;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function ProductDetails($id,$slug){
        $product = Product::findorfail($id);
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        $multiImg = MultiImage::where('product_id',$product->id)->get();
        $related_products = Product::where('category_id',$product->category_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();
        $reviews = Review::where('product_id',$id)->where('status','!=','0')->latest()->limit(5)->get();
        $average = $reviews->avg('rating');
        return view('frontend.product.product_details',compact('product','product_size','product_color','multiImg','related_products','reviews','average'));
    }

    public function Index(){
        $skip_category_0 = category::skip(0)->first();
        $skip_product_0 = Product::where('status','1')->where('category_id',$skip_category_0->id)->orderBy('id','DESC')->limit(5)->get();
        $skip_category_2 = category::skip(2)->first();
        $skip_product_2 = Product::where('status','1')->where('category_id',$skip_category_2->id)->orderBy('id','DESC')->limit(2)->get();
        $skip_category_3 = category::skip(3)->first();
        $skip_product_3 = Product::where('status','1')->where('category_id',$skip_category_3->id)->orderBy('id','DESC')->limit(2)->get();
        $hot_deals = Product::where('hot_deals','1')->where('discount_price','!=',Null)->orderBy('id','DESC')->get();
        $special_offer = Product::where('special_offer','1')->orderBy('id','DESC')->get();
        $new = Product::where('status','1')->orderBy('id','DESC')->limit(3)->get();
        $special_deals = Product::where('special_deals','1')->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.index',compact('skip_category_0','skip_product_0','skip_category_2','skip_product_2','skip_category_3','skip_product_3','hot_deals','special_offer','new','special_deals'));
    }

    public function vendorDetails($id){
        $vendor = User::findorfail($id);
        $vproduct = Product::where('vendor_id',$id)->get();
        return view('frontend.vendor.vendor_details',compact('vendor','vproduct'));
    }

    public function vandorAll(){
        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','DESC')->get();
        return view('frontend.vendor.vendor_all',compact('vendors'));
    }
    public function catWiseProduct($id,$slug){
        $products = Product::where('status',1)->where('category_id',$id)->orderBy('id','DESC')->get();
        $categories = category::orderBy('category_name','ASC')->get();
        $breadcat = Category::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.category_view',compact('products','categories','breadcat','newProduct'));
    }
    public function subCatWiseProduct($id,$slug){
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->get();
        $categories = category::orderBy('category_name','ASC')->get();
        $breadsubcat = SubCategory::where('id',$id)->first();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();
        return view('frontend.product.subcategory_view',compact('products','categories','breadsubcat','newProduct'));
    }
    public function productViewAjax($id){
        $product = Product::with('category','brand')->findorfail($id);
        $product_color = explode(',',$product->product_color);
        $product_size = explode(',',$product->product_size);
        $vendor_id = $product->vendor_id;
        return response()->json(array(
            'product' => $product,
            'color'   => $product_color,
            'size'    => $product_size,
            'vendor' => $vendor_id
        ));
    }
    public function SearchProduct(Request $request){
        $search = $request->search;
        $request->validate(['search'=>'required']);
        $products= Product::where('product_name','LIKE',"%$search%")->get();
        $categories = category::orderBy('category_name','ASC')->get();
        $newProduct = Product::orderBy('id','DESC')->limit(3)->get();

        return view('frontend.product.category_view',compact('products','categories','newProduct','search'));
    }
    public function SearchProductAjax(Request $request){
        $products= Product::where('product_name','LIKE',"%$request->search%")->get();
        return response()->json($products);
    }
}
