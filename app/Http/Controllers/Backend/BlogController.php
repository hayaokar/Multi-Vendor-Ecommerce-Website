<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function allCategories(){
        $categories = BlogCategory::latest()->get();
        return view('backend.blog.category_all',compact('categories'));
    }
    public function addCategories(){
        return view('backend.blog.category_add');
    }
    public function storeCategory(Request $request){
        BlogCategory::create([
            "name"=>$request->category_name,
            "slug"=>str_replace(' ','-',$request->category_name)
        ]);

        $notification = [
            'message' => 'Blog Category Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.blog.category')->with($notification);
    }
    public function editCategory(BlogCategory $category){
        return view('backend.blog.category_edit',compact('category'));
    }
    public function updateCategory(Request $request){
        $categoey = BlogCategory::findorfail($request->id);
        $categoey->update(["name"=>$request->category_name]);
        $notification = [
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.blog.category')->with($notification);
    }
    public function deleteCategory(BlogCategory $category){
        $category->delete();
        $notification = [
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.blog.category')->with($notification);
    }
}
