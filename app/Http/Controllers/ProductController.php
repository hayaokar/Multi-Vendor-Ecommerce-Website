<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.products.products_all',compact('products'));
    }
    public function AddProduct(){
        $brands = Brand::all();
        $categories = category::all();
        $vendors = User::where('status','active')->where('role','vendor')->get();
        return view(('backend.products.products_add'),compact('brands','categories','vendors'));
    }

    public function StoreProduct(Request $request){
        $image = $request->file('product_thambnail');
        $file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::read($image)->resize(800,800)->save('upload/products/thambnail/'.$file_name);
        $save_url = 'upload/products/thambnail/'.$file_name;

        $product_id = Product::insertGetId([
           'brand_id' => $request->brand_id,
           'category_id' => $request->category_id,
           'subcategory_id' => $request->subcategory_id,
           'product_name' => $request->product_name,
           'product_slug' => str_replace(' ','-',$request->product_name),
           'product_code' => $request->product_code,
           'product_qty' => $request->product_qty,
           'product_tags' => $request->product_tags,
           'product_size' => $request->product_size,
           'product_color' => $request->product_color,
           'selling_price' => $request->selling_price,
           'discount_price' => $request->discount_price,
           'short_descp' => $request->short_descp,
           'long_descp' => $request->long_descp,
           'product_thambnail' => $save_url,
           'vendor_id' => $request->vendor_id,
           'hot_deals' => $request->hot_deals,
           'featured' => $request->featured,
           'special_offer' => $request->special_offer,
           'special_deals' => $request->special_deals,
           'status' => '1',
           'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');
        foreach ($images as $image){
            $file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::read($image)->resize(800,800)->save('upload/products/multi_image/'.$file_name);
            $uploadPath = 'upload/products/multi_image/'.$file_name;
            MultiImage::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now()
            ]);
        }

        $notification = [
            'message' => 'Product Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id){
        $products = Product::findorfail($id);
        $brands = Brand::all();
        $categories = category::all();
        $subcategory = SubCategory::all();
        $activeVendor = User::where('status','active')->where('role','vendor')->get();
        $multiImgs = MultiImage::where('product_id',$id)->get();
        return view(('backend.products.products_edit'),compact('brands','categories','activeVendor','products','subcategory','multiImgs'));
    }

    public function UpdateProduct(Request $request){
        $product_id = $request->id;
        Product::findorfail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => str_replace(' ','-',$request->product_name),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'vendor_id' => $request->vendor_id,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'status' => '1',
            'created_at' => Carbon::now(),
        ]);
        $notification = [
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.product')->with($notification);
    }

    public static function UpdateProductThambnail(Request $request){

        $product = Product::findorfail($request->id);
        $image = $request->product_thambnail;
        $file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::read($image)->resize(800,800)->save('upload/products/thambnail/'.$file_name);
        $save_url = 'upload/products/thambnail/'.$file_name;
        $product->product_thambnail = $save_url;
        $product->save();
        if(file_exists($request->old_img))
            unlink($request->old_img);

        $notification = [
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('edit.product')->with($notification);
    }

    public function UpdateProductMultiimage(Request $request){
        $images = $request->multi_img;
        foreach ($images as $id=>$image){
            $imagedel = MultiImage::findorfail($id);
            unlink($imagedel->photo_name);
            $file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::read($image)->resize(800,800)->save('upload/products/thambnail/'.$file_name);
            $save_url = 'upload/products/thambnail/'.$file_name;
            MultiImage::where('id',$id)->update([
                'photo_name' => $save_url,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = [
            'message' => 'Image Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function MultiImageDelete($id){
        $image = MultiImage::findorfail($id);
        unlink($image->photo_name);
        MultiImage::findorfail($id)->delete();

        $notification = [
            'message' => 'Image Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
    public function ProductInactive($id){
        Product::where('id',$id)->update([
            'status' => 0
        ]);

        $notification = [
            'message' => 'Product Inactivated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

    }

    public function ProductActive($id){
        Product::where('id',$id)->update([
            'status' => 1
        ]);

        $notification = [
            'message' => 'Product Activated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);

    }

    public function DeleteProduct($id){
        $product = Product::findorfail($id);
        unlink($product->product_thambnail);
        $product->delete();

        $images = MultiImage::where('product_id',$id)->get();
        foreach ($images as $image){
            if(file_exists($image->photo_name))
                unlink($image->photo_name);
        }
        MultiImage::where('product_id',$id)->delete();
        $notification = [
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
