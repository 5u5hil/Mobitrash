<?php

namespace App\Http\Controllers\Frontend;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\Wastetype;
use App\Models\Additive;
use App\Models\Pickup;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Session;

class OperatorController extends Controller {

    public function login() {
        $user = User::where('id', Input::get("id"))->whereHas('roles', function($q) {
                    $q->where('id', 3);
                })->first();
        if ($user) {
            return ['flash' => 'success', 'User' => $user];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function schedules() {
        $schedules = Schedule::where('for', date('Y-m-d'))->with(['pickups.user', 'pickups.address'])->whereHas('operators', function($q) {
                    $q->where('user_id', Input::get("id"));
                })->orderBy('created_at', 'DESC')->get();
        $services = Service::get(['pickup_id']);
        $pickupids = array();
        foreach ($services as $service){
            array_push($pickupids, $service->pickup_id);
        }
        foreach ($schedules as $key1 => $schedule){
            foreach ($schedule['pickups'] as $key2 => $pickup){
               if(in_array($pickup->id, $pickupids)){
                   unset($schedules[$key1]['pickups'][$key2]);
               }
            }
        }
        if ($schedules) {
            return ['flash' => 'success', 'Schedules' => $schedules];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function pickupDetails() {
        $wastetype = Wastetype::where('is_active', 1)->get();
        $pickup = Pickup::where('id', Input::get("id"))->with(['user', 'address'])->first();
        if ($wastetype && $pickup) {
            return ['flash' => 'success', 'Wastetype' => $wastetype, 'Pickup' => $pickup];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function serviceSave() {
        $pickup_data = Input::get("pickup");
        $service_data = Input::get("service");
        $service = new Service;
        $service->user_id = $pickup_data['user_id'];
        $service->address_id = $pickup_data['user_address_id'];
        $service->schedule_id = $pickup_data['schedule_id'];
        $service->pickup_id = $pickup_data['id'];
        $service->crates_filled = $service_data['crates_filled'];
        $service->compost = $service_data['compost'];
        $service->sawdust = $service_data['sawdust'];
        $service->time_taken = $service_data['time_taken'];
        $service->save();
        $service->wastetypes()->sync($service_data['wastetype']);        
        return ['flash' => 'success'];
    }

}
