<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Role;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Address;
use Hash;
use Auth;
use Session;
use App\Http\Controllers\Controller;

class SystemUsersController extends Controller {

    public function index() {
        $system_users = User::whereHas('roles', function($q) {
                    $q->where('id', '!=', 2);
                })->paginate(Config('constants.paginateNo'));
        $roles = Role::get(['id', 'name'])->toArray();
        return view(Config('constants.adminSystemUsersView') . '.index', compact('system_users', 'roles'));
    }

    public function users() {
        $users = Role::find(2)->users()->paginate(Config('constants.paginateNo'));
        $roles = Role::get(['id', 'name'])->toArray();
        return view(Config('constants.adminUsersView') . '.index', compact('users', 'roles'));
    }

    public function add() {
        $user = new User();
        $action = "admin.systemusers.save";
        $roles = Role::get(['id', 'display_name'])->toArray();
        $roles_name = ["" => "Please Select"];
        foreach ($roles as $role) {
            if($role['id'] == 2){
                continue;
            }
            $roles_name[$role['id']] = $role['display_name'];
        }
        return view(Config('constants.adminSystemUsersView') . '.addEdit', compact('user', 'action', 'roles_name'));
    }

    public function save() {
        $chk = User::where("email", "=", Input::get('email'))->first();

        if (empty($chk)) {
            $user = new User();
            $user->name = Input::get('name');
            $user->phone_number = Input::get('phone_number');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->user_type = 1;
            if (Input::file('profile_picture')) {
                $att = Input::file('profile_picture');
                $destinationPath = public_path() . '/uploads/profile/';
                $fileName = time() . '.' . $att->getClientOriginalExtension();
                if ($att->move($destinationPath, $fileName)) {
                    $user->profile_picture = $fileName;
                }
            }
            $user->save();
            if (!empty(Input::get('roles'))) {
                $user->roles()->sync([Input::get('roles')]);
                return redirect()->route('admin.systemusers.view');
            } else {
                return redirect()->route('admin.systemusers.view');
            }
        } else {
            Session::flash('message', "Email address already exist");
            return redirect()->route('admin.systemusers.add');
        }
    }

    public function update() {

        $user = User::find(Input::get('id'));
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->phone_number = Input::get('phone_number');
        $user->user_type = 1;
        if (Input::file('profile_picture')) {
            $att = Input::file('profile_picture');
            $destinationPath = public_path() . '/uploads/profile/';
            $fileName = time() . '.' . $att->getClientOriginalExtension();
            if ($att->move($destinationPath, $fileName)) {
                $user->profile_picture = $fileName;
            }
        }
        $user->update();

        if (!empty(Input::get('roles'))) {
            $user->roles()->sync([Input::get('roles')]);
            if (Input::get('roles') == 2) {
                return redirect()->route('admin.users.view');
            } else {
                return redirect()->route('admin.systemusers.view');
            }
        } else {
            return redirect()->route('admin.systemusers.view');
        }
    }

    public function edit() {
        $user = User::find(Input::get('id'));
        $action = "admin.systemusers.update";
        $roles = Role::get(['id', 'display_name'])->toArray();
        $roles_name = ["" => "Please Select"];
        foreach ($roles as $role) {
            if($role['id'] == 2){
                continue;
            }
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

    public function addUser() {
        $user = new User();
        $action = "admin.users.save";
        return view(Config('constants.adminUsersView') . '.addEdit', compact('user', 'action'));
    }

    public function saveUser() {
        $chk = User::where("email", "=", Input::get('email'))->first();

        if (empty($chk)) {
            $user = new User();
            $user->name = Input::get('name');
            $user->phone_number = Input::get('phone_number');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->user_type = 1;
            $user->save();
            $user->roles()->sync([2]);
            if (Input::get('address')) {
                $address = new Address();
                $address->user_id = $user->id;
                $address->address = Input::get('address');
                $address->latitude = Input::get('latitude');
                $address->longitude = Input::get('longitude');
                $address->city = 1;
                $address->save();
            }
            Session::flash('message', "Customer Added Successfully");
            return redirect()->route('admin.users.view');
        } else {
            Session::flash('message', "Email address already exist");
            return redirect()->route('admin.users.add');
        }
    }

    public function updateUser() {

        $user = User::find(Input::get('id'));
        $user->name = Input::get('name');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->phone_number = Input::get('phone_number');
        $user->user_type = 1;
        $user->update();
        if (Input::get('address')) {
            $address = new Address();
            $address->user_id = $user->id;
            $address->address = Input::get('address');
            $address->latitude = Input::get('latitude');
            $address->longitude = Input::get('longitude');
            $address->city = 1;
            $address->save();
        }
        return redirect()->route('admin.users.view');
    }

    public function editUser() {
        $user = User::find(Input::get('id'));
        $action = "admin.users.update";
        return view(Config('constants.adminUsersView') . '.addEdit', compact('user', 'action'));
    }

    public function getAddresses() {
        return User::where('id', Input::get('uid'))->with('addresses')->first(['name', 'phone_number', 'id']);
    }

    public function getSubscriptions() {
        return Subscription::where('id', Input::get('id'))->with('frequency', 'user')->first();
    }

    public function getApproxTime() {
        $subscription = Subscription::where('user_id', Input::get('uid'))->where('user_address_id', Input::get('address_id'))->orderBy('created_at', 'DESC')->with('frequency', 'timeslot')->first();
        return [$subscription];
    }

    public function rmAddress() {
        Address::find(Input::get('id'))->delete();
        return redirect()->back()->with("message", "Address Removed sucessfully");
        exit();
    }

}
