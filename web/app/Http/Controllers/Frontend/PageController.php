<?php

namespace App\Http\Controllers\Frontend;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use App\Models\Service;

use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Http\Controllers\Controller;

use Session;

class PageController extends Controller {

    public function index() {    
         $waste_till_date_sum = 0;

        $allwastes = array();
        $waste_till_date = Service::with('wastetypes')->get()->toArray();
        foreach ($waste_till_date as $totalwaste) {
            foreach ($totalwaste['wastetypes'] as $key => $wastetype) {
                $allwastes[$wastetype['id']]['id'] = $wastetype['id'];
                $allwastes[$wastetype['id']]['name'] = $wastetype['name'];
                if (isset($allwastes[$wastetype['id']]['total_quantity'])) {
                    $allwastes[$wastetype['id']]['total_quantity'] += $wastetype['pivot']['quantity'];
                } else {
                    $allwastes[$wastetype['id']]['total_quantity'] = $wastetype['pivot']['quantity'];
                }
                $waste_till_date_sum = $waste_till_date_sum + $wastetype['pivot']['quantity'];
            }
        }
        return view(Config('constants.frontendView') . '.home',  compact('waste_till_date_sum'));
    }
    
}
