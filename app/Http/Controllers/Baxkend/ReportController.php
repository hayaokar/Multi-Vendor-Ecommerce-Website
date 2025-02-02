<?php

namespace App\Http\Controllers\Baxkend;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class ReportController extends Controller
{
    public function ReportView(){
        $users = User::where('role','user')->latest()->get();
        return view('backend.report.report_view',compact('users'));
    }
    public function SearchByDate(Request $request){
        $date = (new DateTime($request->date))->format('d F Y');
        $orders = Order::where('order_date', $date)->get();
        $type = 'Date';
        return view('backend.report.report_by_date',compact('orders','date','type'));
    }
    public function SearchByMonth(Request $request){
        $month = $request->month;
        $year = $request->year;
        $orders = Order::whereOrder_month($month)->whereOrder_year($year)->get();
        $type = 'Month';
        $date = $month . ' ' . $year;
        return view('backend.report.report_by_date',compact('orders','date','type'));
    }
    public function SearchByYear(Request $request){
        $year = $request->year;
        $orders = Order::whereOrder_year($year)->get();
        $type = 'Year';
        $date = $year;
        return view('backend.report.report_by_date',compact('orders','date','type'));
    }
    public function SearchByUser(Request $request){
        $user = $request->user;
        $orders = Order::whereUser_id($user)->get();

        $type = 'User';
        $date = $user;
        return view('backend.report.report_by_date',compact('orders','date','type'));
    }
}