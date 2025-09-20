<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function ShopPage()
    {
        if(!empty($_GET['category'])){
            $slugs = explode(',',$_GET['category']);
            $catids= category::select('id')->whereIn('category_slug',$slugs)->pluck('id')->toArray();
            $products = Product::whereIn('category_id', $catids)->get();
        }else{
            $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        }

        $categories = category::orderBy('category_name', 'ASC')->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.shop_page', compact('products', 'categories', 'newProduct'));
    }
    public function ShopFilter(Request $request){
        $data = $request->all();
        $catUrl= "";
        if(!empty($data['category'])){
            foreach ($data['category'] as $category){
                if(empty($catUrl)){
                    $catUrl .= '&category='.$category;
                }else{
                    $catUrl .=','.$category;
                }
            }
        }
        return redirect()->route('home.shop',$catUrl);
    }



}
