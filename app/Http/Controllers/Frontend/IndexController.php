<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MultiImage;
use App\Models\Product;
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

        return view('frontend.product.product_details',compact('product','product_size','product_color','multiImg','related_products'));
    }
}
