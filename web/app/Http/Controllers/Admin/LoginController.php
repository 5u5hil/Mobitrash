<?php

namespace App\Http\Controllers\Admin;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Http\Controllers\Controller;

use Session;

class LoginController extends Controller {

    public function index() {

        return view(Config('constants.adminView') . '.login');
    }

    public function dashboard() {

        return view(Config('constants.adminView') . '.dashboard');
    }
      public function unauthorized() {

        return view(Config('constants.adminView') . '.unauthorized');
    }
    

    public function chk_admin_user() {
        $userDetails = User::where("email", "=", Input::get("email"))->first();
        $userData = ['email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        if (Auth::attempt($userData, true)) {
            $user = User::with('roles')->find($userDetails->id);
            Session::put('loggedinUserId', $userDetails->id);
            $roles = $user->roles()->first();
            $r = Role::find($roles->id);
            $per = $r->perms()->get()->toArray();
            
            return redirect()->route('admin.dashboard');
        } else {
         
            Session::flash('invalidUser', 'Invalid Username or Password');
            return redirect()->route('adminLogin');
        }
    }
    
    
    public function admin_logout(){
         Auth::logout();
         Session::flush();
         return redirect()->route('adminLogin');
    }
    
    

}
