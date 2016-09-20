<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Miscellaneous;
use Auth;
use Session;
use Route;

class CheckWebUser {
    public function handle($request, Closure $next) {        
        if (Auth::id()) {
            return $next($request);
        }
        return redirect()->route('user.login',['rurl'=>Route::currentRouteName()]);
    }
}
