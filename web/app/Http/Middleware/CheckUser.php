<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Miscellaneous;
use Auth;
use Session;

class CheckUser {
    public function handle($request, Closure $next) {

        if (Auth::id()) {
            $user = User::with('roles')->find(Auth::id());
            $roles = $user->roles;
            $roles_data = $roles->toArray();
            $r = Role::find($roles_data[0]['id']);
            $per = $r->perms()->get(['name'])->toArray();
            foreach ($roles_data as $role) {
                if ($role['id'] == 2) {
                    Session::flash('invalidUser', "Access Denied!");
                }
                else{
                    return $next($request);
                }
            }            
        }
        return redirect()->route('adminLogin');
    }

}
