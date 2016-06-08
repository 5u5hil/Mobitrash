<?php

namespace App\Http\Controllers\Admin;

use Route;
//use Input;
use App\Models\Role;
use Illuminate\Support\Facades\Input;

use App\Models\Permission;
use App\Http\Controllers\Controller;

class RolesController extends Controller {

    public function index() {
        $roles = Role::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminRoleView').'.index', compact('roles'));
    }

    public function add() {
      //  dd(Route::getRoutes()->toArray());
        foreach (Route::getRoutes() as $value) {
            if (strpos($value->getName(), "admin.") !== false) {
                try {
                    $displayName = ucwords(strtolower(str_replace(".", " ", str_replace("admin.", "", $value->getName()))));
                    $permissions = new Permission();
                    $permissions->name = $value->getName();
                    $permissions->display_name = $displayName;
                    $permissions->save();
                } catch (\Illuminate\Database\QueryException $e) {
                    
                }
            }
        }
        $permissions = Permission::all();
        $role = new Role();
        $action = "admin.roles.save";
        return view(Config('constants.adminRoleView').'.addEdit', compact('permissions', 'role', 'action'));
    }

    public function edit(){
        foreach (Route::getRoutes() as $value) {
            if (strpos($value->getName(), "admin.") !== false) {
                try {
                    $displayName = ucwords(strtolower(str_replace(".", " ", str_replace("admin.", "", $value->getName()))));
                    $permissions = new Permission();
                    $permissions->name = $value->getName();
                    $permissions->display_name = $displayName;
                    $permissions->save();
                } catch (\Illuminate\Database\QueryException $e) {
                    
                }
            }
        }
        $permissions = Permission::all();
        $role = Role::find(Input::get('id'));
        $action = "admin.roles.save";
        return view(Config('constants.adminRoleView').'.addEdit', compact('permissions', 'role', 'action'));
    }
    
    public function save() {
       // dd(Input::all());
        $role = Role::findOrNew(Input::get('id'));
        $role->name = Input::get('name');
        $role->display_name = Input::get('display_name');
        $role->description = Input::get('description');
        $role->save();

        if (!empty(Input::get('chk'))) {
            $role->perms()->sync(Input::get('chk'));
        }

        return redirect()->route('admin.roles.view');
      // echo "<script>window.close();</script>";
    }
    
    
    public function delete(){
        $roles = Role::find(Input::get('id'));
        $getUsers = $roles->users()->get()->toArray();
    if(empty($getUsers)){
       $roles->delete();
       return redirect()->back()->with("message","Role deleted sucessfully");
       
    }else{
           return redirect()->back()->with("message","Sorry,You can not delete role!");
        
    }
    }


    
    

}
