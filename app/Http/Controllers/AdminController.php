<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function AdminDashboard(){
        return view('admin.index');
    }

    public function AdminLogout(Request $request){

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }

    public function AdminLogin(){
        return view('admin.admin_login');
    }

    public function AdminProfile(){
        $user = Auth::user();
        return view('admin.admin_profile_view',compact('user'));
    }

    public function AdminStoreProfile(Request $request){
        $user = User::findorfail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$user->photo));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $user['photo'] = $filename;

        }
        $user->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }

    public function AdminStorePassword(Request $request){
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        // Update The new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);
        return back()->with("status", " Password Changed Successfully");
    }

    public function InactiveVendor(){
        $vendors = User::where('role','vendor')->where('status','inactive')->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('vendors'));
    }

    public function ActiveVendor(){
        $vendors = User::where('role','vendor')->where('status','active')->latest()->get();
        return view('backend.vendor.active_vendor',compact('vendors'));
    }

    public function ActivateVendor($id){
        $vendor = User::findorfail($id);
        $vendor->status = 'active';
        $vendor->save();

        $notification = array(
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function DeActivateVendor($id){
        $vendor = User::findorfail($id);
        $vendor->status = 'inactive';
        $vendor->save();

        $notification = array(
            'message' => 'Vendor dectivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function AllAdmin(){
        $alladminuser = User::where('role','admin')->latest()->get();
        return view('backend.admin.all_admin',compact('alladminuser'));
    }
    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));
    }
    public function StoreAdmin(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->role) {
            $roles = Role::where('id', $request->role)->value('name');
            $user->assignRole($roles);
        }

        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admins')->with($notification);
    }
    public function EditAdmin($id){
        $roles = Role::all();
        $admin = User::findorfail($id);
        return view('backend.admin.edit_admin',compact('roles','admin'));
    }
    public function UpdateAdmin(Request $request){
        $user = User::findorfail($request->id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->roles()->detach();

        if ($request->roles) {
            $roles = Role::where('id', $request->roles)->value('name');
            $user->assignRole($roles);
        }

        $notification = array(
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admins')->with($notification);
    }
    public function DeleteAdmin($id){
        User::findorfail($id)->delete();
        $notification = [
            'message' => 'Admin Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.admins')->with($notification);
    }

}
