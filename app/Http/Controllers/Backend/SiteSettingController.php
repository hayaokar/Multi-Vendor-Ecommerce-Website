<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
class SiteSettingController extends Controller
{
    public function SiteSetting(){
        $setting = SiteSettings::find(1);
        return view('backend.setting.setting_update',compact('setting'));
    }
    public function SiteSettingUpdate(Request $request){

        if($request->file('logo')){

            $image = $request->file('logo');
            $file_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::read($image)->resize(180,56)->save(public_path('upload/logo/'.$file_name));

            if(file_exists($request->old_image))
                unlink($request->old_image);
            SiteSettings::findOrFail(1)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
                'logo' => 'upload/logo/'.$file_name,
            ]);
            $notification = array(
                'message' => 'Site Setting Updated with image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            SiteSettings::findOrFail(1)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
            ]);
            $notification = array(
                'message' => 'Site Setting Updated without image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } // end else


    }

    public function SeoSetting(){
        $setting = Seo::find(1);
        return view('backend.seo.seo_update',compact('setting'));
    }
    public function SeoSettingUpdate(Request $request){

        Seo::findOrFail(1)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
        ]);
        $notification = array(
            'message' => 'Site SEO Setting Updated with image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }

}
