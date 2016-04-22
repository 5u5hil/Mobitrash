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

class PageController extends Controller {

    public function index() {        
        return view(Config('constants.frontendView') . '.home');
    }
    
}
