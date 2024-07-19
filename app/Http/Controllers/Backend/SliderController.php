<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class SliderController extends Controller
{
    //
    public function AllSliders(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all',compact('sliders'));
    }

    public function AddSlider(){
        return view('backend.slider.add_slider');
    }
    public function StoreSlider(Request $request){
        $file      = $request->file('photo');
        $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        Image::read($file)->resize(300,300)->save(public_path('upload/slider_images/'.$file_name));
        $url = 'upload/slider_images/'.$file_name;
        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_img'  => $url
        ]);
        $notification = [
            'message' => 'Slider Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.sliders')->with($notification);
    }
    public function EditSlider($id){
        $slider = Slider::findorfail($id);
        return view('backend.slider.edit_slider',compact('slider'));
    }
    public function UpdateSlider(Request $request){
        $slider = Slider::findorfail($request->id);
        if($request->file()){
            $file = $request->file('photo');
            $file_name = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            Image::read($file)->resize(300,300)->save(public_path('upload/slider_images/'.$file_name));
            unlink($request->old_image);
            $url = 'upload/slider_images/'.$file_name;
            $slider->slider_img = $url;
        }
        $slider -> slider_title = $request->slider_title;
        $slider -> short_title = $request->short_title;
        $slider->save();

        $notification = [
            'message' => 'Slider Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.sliders')->with($notification);
    }
    public function DeleteSlider($id){
        $slider = Slider::findorfail($id);
        $image = $slider->slider_img;
        unlink($image);
        $slider->delete();
        $notification = [
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
