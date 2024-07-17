<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class SubCategoryController extends Controller
{

    public function AllSubCategory(){
        $categories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all',compact('categories'));
    }
    public function AddSubCategory(){
        $categories = category::orderBy('category_name','ASC')->get();
        return view('backend.subcategory.add_subcategory',compact('categories'));
    }
    public function StoreSubCategory(Request $request){

        $slug = strtolower(str_replace($request->subcategory_name,' ','_'));

        SubCategory::insert([
            'category_id'    => $request->category_id,
            'subcategory_name'  => $request->subcategory_name,
            'subcategory_slug'  => $slug
        ]);
        $notification = [
            'message' => 'Sub Category Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }
    public function EditSubCategory($id){
        $category = SubCategory::findorfail($id);
        $categories = category::orderBy('category_name','ASC')->get();
        return view('backend.subcategory.edit_subcategory',compact('category','categories'));
    }

    public function UpdateSubCategory(Request $request){
        $slug = strtolower(str_replace($request->subcategory_name,' ','_'));
        $category = SubCategory::findorfail($request->id);
        $category->subcategory_name = $request->subcategory_name;
        $category->subcategory_slug = $slug;
        $category->category_id      = $request->category_id;
        $category->save();
        $notification = [
            'message' => 'Sub Category Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }

    public function DeleteSubCategory($id){
        SubCategory::findorfail($id)->delete();


        $notification = [
            'message' => 'Sub Category Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.subcategory')->with($notification);

    }

    public function GetSubCategory($id){
        $subcat = SubCategory::where('category_id',$id)->orderBy('subcategory_name','ASC')->get();
        return json_encode($subcat);
    }
}
