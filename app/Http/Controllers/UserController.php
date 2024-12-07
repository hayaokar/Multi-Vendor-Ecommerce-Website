<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function UserDashboard(){
        $user = Auth::user();
        return view('index',compact('user'));
    }

    public function UserProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod

    public function UserLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logged Out Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
    public function UserChangePasswordView(){
        return view('frontend.userdashboard.user_change_password');
    }
    public function UserAccountDetails(){
        $user = Auth::user();
        return view('frontend.userdashboard.user_account_details',compact('user'));
    }

    public function UserChangePassword(Request $request){

        $request->validate([
           'old_password' => 'required',
           'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)){
            return redirect()->back()->with("error", "Old Password Doesn't Match!!");
        }

        User::whereId(Auth::user()->id)->update(
            [
                'password' => Hash::make($request->new_password)
            ]
        );

        return back()->with("status", " Password Changed Successfully");

    }
    public function UserOrders(){
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('frontend.userdashboard.user_order_page',compact('orders'));
    }
    public function ViewOrder(Order $order){
        $order_items = $order->orderItems()->with('product')->get();
        return view('frontend.order.order_details', compact('order','order_items'));
    }

    public function InvoiceOrder(Order $order){
        $order_items = $order->orderItems()->with('product')->get();
        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order','order_items'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
            'isRemoteEnabled' => true
        ]);
        return $pdf->download('invoice.pdf');

    }

}
