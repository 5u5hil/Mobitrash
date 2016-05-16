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

//    public function handle($request, Closure $next) {
//        if ($this->auth->guest()) {
//            if ($request->ajax()) {
//                return response('Unauthorized.', 401);
//            } else {
//
//                $user = User::find(Session::get('loggedinUserId'))->first()->toArray();
//
//                dd($user);
//
//                //return redirect()->guest('auth/login');
//            }
//        }
//
//        return $next($request);
//    }

    public function handle($request, Closure $next) {

        // $chk = Miscellaneous::findBySlug('acl')->value;
//dd($chk);
        //  if ($chk == "Yes") {
        if (Auth::id()) {
            $user = User::with('roles')->find(Auth::id());

            $roles = $user->roles;
            $roles_data = $roles->toArray();
            $r = Role::find($roles_data[0]['id']);
            $per = $r->perms()->get(['name'])->toArray();
            foreach ($roles_data as $role) {
                if ($role['id'] == 1) {
                    return $next($request);
                }
            }
            Session::flash('invalidUser', "Access Denied!");
        }
        return redirect()->route('adminLogin');
        //$curRoute = $request->route()->getName();
//            if (!in_array($curRoute, array_flatten($per))) {
//
//                // return response('<br />Unauthorized.', 401);
//                return view('admin.pages.unauthorized');
//            }
//
//            return $next($request);
        //}else{
        //     return $next($request);
        // }
    }

}
