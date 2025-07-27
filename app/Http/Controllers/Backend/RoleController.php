<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
    }
    public function StorePermission(Request $request){
        Permission::create([
            'name'=> $request->name,
            'group_name'=> $request->group_name
        ]);
        $notification = [
            'message' => 'Permission Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);
    }
    public function EditPermission($id){
        $permission = Permission::findorfail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }
    public function UpdatePermission(Request $request){
        $permission = Permission::findorfail($request->id);
        $permission->update([
            'name'=> $request->name,
            'group_name'=> $request->group_name
        ]);

        $notification = [
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);
    }
    public function DeletePermission($id){
        Permission::findorfail($id)->delete();
        $notification = [
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);
    }

    public function AllRoles(){
        $roles = Role::all();
        return view('backend.pages.role.all_role',compact('roles'));
    }

    public function AddRole(){
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return view('backend.pages.role.add_role',compact('permission_groups'));
    }
    public function StoreRole(Request $request){
        DB::transaction(function () use ($request) {
            $role = Role::create([
                'name'=> $request->name,
            ]);
            if(!is_null($request->permission) && count($request->permission) > 0) {
                $permissions = Permission::whereIn('id', $request->permission)->get();
                $role->syncPermissions($permissions);
            }
        });
        $notification = [
            'message' => 'Role Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles')->with($notification);
    }
    public function EditRole($id){
        $role = Role::findorfail($id);
        $role_permissions = DB::table('role_has_permissions')->select('permission_id')->where('role_id',$id)->pluck('permission_id')->toArray();
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return view('backend.pages.role.edit_role',compact('role','permission_groups','role_permissions'));
    }
    public function UpdateRole(Request $request){
        $role = Role::findorfail($request->id);
        $role->update([
            'name'=> $request->name,

        ]);

        if (!empty($request->permission)) {

            $permissions = Permission::whereIn('id', $request->permission)->get();
            $role->syncPermissions($permissions);
        }

        $notification = [
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles')->with($notification);
    }
    public function DeleteRole($id){
        Role::findorfail($id)->delete();
        DB::table('role_has_permissions')->where('role_id',$id)->delete();
        $notification = [
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.roles')->with($notification);
    }



}
