<?php

namespace App\Http\Controllers\Frontend;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Http\Controllers\Controller;

use Session;

class LoginController extends Controller {

    public function login() { 
        return view(Config('constants.frontendView') . '.login');
    }
    
    public function register() {
        return view(Config('constants.frontendView') . '.register');
    }

        

    public function chk_user() {
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
    
    
    public function logout(){
         Auth::logout();
         Session::flush();
         return redirect()->route('adminLogin');
    }
    
    

}
