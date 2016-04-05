<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Role;
use App\Models\User;
use Hash;
use Auth;
use Session;
use App\Http\Controllers\Controller;

class SystemUsersController extends Controller {

    public function index() {
        $system_users = User::paginate(Config('constants.paginateNo'));
        $roles = Role::get(['id', 'name'])->toArray();
        return view(Config('constants.adminSystemUsersView') . '.index', compact('system_users', 'roles'));
    }

    public function add() {
        $user = new User();
        $action = "admin.systemusers.save";
        $roles = Role::get(['id', 'display_name'])->toArray();
        $roles_name = ["" => "Please Select"];
        foreach ($roles as $role) {
            $roles_name[$role['id']] = $role['display_name'];
        }
        return view(Config('constants.adminSystemUsersView') . '.addEdit', compact('user', 'action', 'roles_name'));
    }

    public function save() {
        $chk = User::where("email", "=", Input::get('email'))->first();

        if (empty($chk)) {
            $user = new User();
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->user_type = 1;



            $user->save();

            if (!empty(Input::get('roles'))) {
                $user->roles()->sync([Input::get('roles')]);
            }
            return redirect()->route('admin.systemusers.view');
        } else {
            Session::flash("usenameError", "Username already exist");
            return redirect()->back();
        }
    }

    public function update() {

        $user = User::find(Input::get('id'));
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));

        $user->user_type = 1;
        $user->update();

        if (!empty(Input::get('roles'))) {
            $user->roles()->sync([Input::get('roles')]);
        }

        return redirect()->route('admin.systemusers.view');
    }

    public function edit() {
        $user = User::find(Input::get('id'));
        $action = "admin.systemusers.update";
        $roles = Role::get(['id', 'display_name'])->toArray();
        $roles_name = ["" => "Please Select"];
        foreach ($roles as $role) {
            $roles_name[$role['id']] = $role['display_name'];
        }
        return view(Config('constants.adminSystemUsersView') . '.addEdit', compact('user', 'action', 'roles_name'));
    }

    public function chk_existing_username() {
        $getname = Input::get('username');
        // dd($getname);
        $chk = User::where("user_name", "=", $getname)->first();

        if (!empty($chk)) {
            echo "Invalid";
        } else {

            echo "valid";
        }
    }

    public function delete() {
        $user = User::find(Input::get('id'));
        $user->delete();
        return redirect()->back()->with("message", "User deleted successfully!");
    }

    public function getAddresses() {
        return User::find(Input::get('uid'))->addresses;
    }

}
