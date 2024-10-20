<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistricts;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    //
    public function AllDivisions(){
        $divisions = ShipDivision::latest()->get();
        return view('backend.ship.divisions.divisions_all',compact('divisions'));
    }
    public function AllDistricts(){
        $district = ShipDistricts::latest()->get();
        $divisions = ShipDivision::latest()->get();
        return view('backend.ship.districts.districts_all',compact('district','divisions'));
    }
    public function AllState(){
        $district = ShipDistricts::latest()->get();
        $divisions = ShipDivision::latest()->get();
        $state = ShipState::latest()->get();
        return view('backend.ship.states.states_all',compact('district','divisions','state'));
    }
    public function AllStates(){
        $states = ShipState::latest()->get();
        return view('backend.ship.states.states_all',compact('states'));
    }
    public function AddDivisions(Request $request){
        ShipDivision::insert([
            'division_name' => $request->division_name
        ]);
        return response()->json(['success'=>'Division Added Successfully']);
    }
    public function AddDistrict(Request $request){
        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name
        ]);
        return response()->json(['success'=>'District Added Successfully']);
    }
    public function GetAllDivisions(){
        $divisions = ShipDivision::latest()->get();
        return response()->json(['divisions' => $divisions]);
    }
    public function GetAllDistricts(){
        $districts = ShipDistricts::with('division')->latest()->get();
        return response()->json(['districts' => $districts]);
    }
    public function ViewDivision($id){
        $divsion = ShipDivision::findorfail($id);
        return response()->json(['division'=>$divsion]);
    }
    public function ViewDistrict($id){
        $district = ShipDistricts::with('division')->findorfail($id);
        return response()->json(['district'=>$district]);
    }
    public function UpdateDivisions($id,Request $request){
        ShipDivision::findorfail($id)->update(['division_name'=>$request->division_name]);
        return response()->json(['success'=>'Division Updated Successfully']);
    }
    public function UpdateDistrict($id,Request $request){
        ShipDistricts::findorfail($id)->update(['district_name'=>$request->district_name,'division_id'=>$request->division_id]);
        return response()->json(['success'=>'District Updated Successfully']);
    }
    public function DeleteDivision($id){
        ShipDivision::findorfail($id)->delete();
        $notification = [
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function DeleteDistrict($id){
        ShipDistricts::findorfail($id)->delete();
        $notification = [
            'message' => 'District Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
    public function AddState(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        return view('backend.ship.states.add_state',compact('division'));
    }
    public function GetDistrict($id){
        $dist = ShipDistricts::where('division_id',$id)->orderBy('district_name','ASC')->get();
        return json_encode($dist);

    }
    public function StoreState(Request $request){
        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => 'ShipState Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.states')->with($notification);
    }
    public function EditState($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistricts::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.states.state_edit',compact('division','district','state'));
    }
    public function UpdateState(Request $request){

        $state_id = $request->id;

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => 'ShipState Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.states')->with($notification);


    }

    public function DeleteState($id){

        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'ShipState Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }
}
