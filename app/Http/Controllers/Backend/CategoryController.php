<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class CategoryController extends Controller
{
    //
    public function AllCategory(){
        $categories = category::latest()->get();
        return view('backend.category.category_all',compact('categories'));
    }
    public function AddCategory(){
        return view('backend.category.add_category');
    }
    public function StoreCategory(Request $request){
        $file      = $request->file('photo');
        $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        Image::read($file)->resize(300,300)->save(public_path('upload/category_images/'.$file_name));
        $url = 'upload/category_images/'.$file_name;
        $slug = strtolower(str_replace($request->category_name,' ','_'));
        category::insert([
           'category_name'  => $request->category_name,
           'category_image' => $url,
           'category_slug'  => $slug
        ]);
        $notification = [
            'message' => 'Category Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }
    public function EditCategory($id){
        $category = category::findorfail($id);
        return view('backend.category.edit_category',compact('category'));
    }
    public function UpdateCategory(Request $request){
        $category = category::findorfail($request->id);
        if($request->file()){
            $file = $request->file('photo');
            $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::read($file)->resize(300,300)->save(public_path('upload/category_images/'.$file_name));
            unlink($request->old_image);
            $url = 'upload/category_images/'.$file_name;
            $category->category_image = $url;
        }
        $category -> category_name = $request->category_name;
        $slug = strtolower(str_replace($request->category_name,' ','_'));
        $category -> category_slug = $slug;
        $category->save();

        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory($id){
        $category = category::findorfail($id);
        $image = $category->category_image;
        unlink($image);
        $category->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

}
