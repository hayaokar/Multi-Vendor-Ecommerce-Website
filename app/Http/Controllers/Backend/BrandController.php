<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brands'));
    }

    public function AddBrand(){

        return view('backend.brand.add_brand');
    }

    public function StoreBrand(Request $request){
        $request ->validate(
            [
                'brand_name' => 'required'
            ]
        );
        $image = $request->file('photo');
        $file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::read($image)->resize(300,300)->save(public_path('upload/brand_images/'.$file_name));

        $url = 'upload/brand_images/'.$file_name;
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ','-',$request->brand_name)),
            'brand_image' => $url
        ]);

        $notification = [
            'message' => 'Brand Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.brand')->with($notification);

    }

    public function EditBrand($id){
        $brand = Brand::findorfail($id);
        return view('backend.brand.edit_brand',compact('brand'));
    }

    public function UpdateBrand(Request $request){
        $brand = Brand::findorfail($request->id);
        if($request->file('photo')){
            $file = $request->file('photo');
            $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::read($file)->resize(300,300)->save(public_path('upload/brand_images/'.$file_name));
            if(file_exists($request->old_image))
                unlink($request->old_image);
            $brand->brand_image = 'upload/brand_images/'.$file_name;
        }
        $brand->brand_name  = $request->brand_name;
        $brand->save();

        $notification = [
            'message' => 'Brand Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.brand')->with($notification);
    }

    public function DeleteBrand($id){
        $brand = Brand::findorfail($id);
        unlink($brand->brand_image);
        $brand->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);

    }
}
