<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class BannerController extends Controller
{
    public function AllBanners(){
        $banners = Banner::latest()->get();
        return view('backend.banner.banner_all',compact('banners'));
    }
    public function AddBanner(){
        return view('backend.banner.add_banner');
    }
    public function StoreBanner(Request $request){
        $file      = $request->file('photo');
        $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        Image::read($file)->resize(768,450)->save(public_path('upload/banner_images/'.$file_name));
        $url = 'upload/banner_images/'.$file_name;
        Banner::insert([
            'banner_title'  => $request->banner_title,
            'banner_url'  => $request->banner_url,
            'banner_image' => $url,
        ]);
        $notification = [
            'message' => 'Banner Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.banners')->with($notification);
    }
    public function EditBanner($id){
        $banner = Banner::findorfail($id);
        return view('backend.banner.edit_banner',compact('banner'));
    }
    public function UpdateBanner(Request $request){
        $banner = Banner::findorfail($request->id);
        if($request->file()){
            $file = $request->file('photo');
            $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::read($file)->resize(768,450)->save(public_path('upload/banner_images/'.$file_name));
            unlink($request->old_image);
            $url = 'upload/banner_images/'.$file_name;
            $banner->banner_image = $url;
        }
        $banner -> banner_title = $request->banner_title;
        $banner -> banner_url = $request->banner_url;
        $banner->save();

        $notification = [
            'message' => 'Banner Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.banners')->with($notification);
    }

    public function DeleteBanner($id){
        $banner = Banner::findorfail($id);
        $image = $banner->banner_image;
        unlink($image);
        $banner->delete();
        $notification = [
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

}
