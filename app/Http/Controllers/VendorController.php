<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function VendorDashboard(){
        return view('vendor.index');
    }

    public function VendorLogin(){
        return view('vendor.vendor_login');
    }

    public function VendorLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('vendor/login');
    }

    public function VendorProfile(){
        $user = Auth::user();
        return view('vendor.vendor_profile_view',compact('user'));
    }

    public function VendorStoreProfile(Request $request){
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->vendor_join = $request->join_date;
        $user->vendor_short_info = $request->short_info;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$user->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images/'),$filename);
            $user['photo'] = $filename;
        }

        $user->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.profile')->with($notification);
    }

    public function VendorChangePassword(){
        $user = Auth::user();
        return view('vendor.vendor_change_password',compact('user'));
    }

    public function VendorStorePassword(Request $request){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password,Auth::user()->password)){
            return back()->with('error',"Old Password Doesn't Match!!'");
        }
        User::whereId(Auth::user()->id)->update(
            [
                'password' => Hash::make($request->new_password)
            ]
        );
        return back()->with('status',"Password Changed Successfully'");
    }

    public function BecomeVendor(){
        return view('auth.become_vendor');
    }

    public function RegisterVendor(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->date,
            'role'        => 'vendor',
            'status'      => 'inactive',
            'password' => Hash::make($request->password),
        ]);

        $notification = [
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('login.vendor')->with($notification);
    }
}
