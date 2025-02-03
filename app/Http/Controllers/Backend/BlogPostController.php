<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
class BlogPostController extends Controller
{
    public function allPosts(){
        $posts = BlogPost::latest()->get();
        return view('backend.blog.posts_all',compact('posts'));
    }
    public function addPost(){
        $blogcategory = BlogCategory::latest()->get();
        return view('backend.blog.post_add',compact('blogcategory'));
    }
    public function storePost(Request $request){
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::read($image)->resize(1103,906)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;
        BlogPost::insert([
            'category_id' => $request->category_id,
            'title' => $request->post_title,
            'slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'short_description' => $request->post_short_description,
            'long_description' => $request->post_long_description,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.post')->with($notification);
    }
    public function editPost(BlogPost $post){
        $blogcategory = BlogCategory::latest()->get();
        return view('backend.blog.post_edit',compact('post','blogcategory'));
    }
    public function updatePost(Request $request){
        $image = $request->old_image;
        if($request->file('post_image')){
            $file = $request->file('post_image');
            $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::read($file)->resize(1103,906)->save('upload/blog/'.$file_name);
            if(file_exists($request->old_image)){
                unlink($request->old_image);
            }
            $image = 'upload/blog/'.$file_name;

        }
        $post = BlogPost::findorfail($request->id);
        $post->update([
            'title' => $request->post_title,
            'slug' => strtolower(str_replace(' ','-',$post->title)),
            'category_id' => $request->category_id,
            'short_description' => $request->post_short_description,
            'long_description' => $request->post_long_description,
            'image' => $image
        ]);
        $notification = array(
            'message' => 'Blog Post Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.post')->with($notification);
    }
    public function deletePost($id){
        $post = BlogPost::findorfail($id);
        unlink($post->image);
        $post->delete();
        $notification = [
            'message' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);

    }
}
