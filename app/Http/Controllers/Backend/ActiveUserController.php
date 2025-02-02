<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function allCustomers (){
        $users = User::where('role','user')->latest()->get();
        $type = 'Customers';
        return view('backend.users.customers_all',compact('users','type'));
    }
    public function allVendors (){
        $users = User::where('role','vendor')->latest()->get();
        $type = 'Vendors';
        return view('backend.users.customers_all',compact('users','type'));
    }
}
