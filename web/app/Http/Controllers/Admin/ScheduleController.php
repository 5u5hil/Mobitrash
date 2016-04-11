<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Schedule;
use App\Models\Pickup;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Asset;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller {

    function index() {
        $schedule = Schedule::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminScheduleView') . '.index', compact('schedule'));
    }

    public function add() {
        $schedule = new Schedule();


        $pickups = $schedule->pickups()->with('user', 'address')->get();
        $userss = Role::find(3)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        $ops = [];
        $opss = $schedule->operators->toArray();
        foreach ($opss as $val) {
            array_push($ops, $val['id']);
        }

        $driverss = Role::find(4)->users->toArray();
        $drivers = [];
        foreach ($driverss as $value) {
            $drivers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        $opsd = [];
        $opsds = $schedule->drivers->toArray();
        foreach ($opsds as $val) {
            array_push($opsd, $val['id']);
        }

        $v = Asset::where("is_active", 1)->where("type", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }

        $c = Role::find(2)->users->toArray();
        $customers = [0 => "Select a Customer"];
        foreach ($c as $value) {
            $customers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }
        $action = "admin.schedule.save";
        return view(Config('constants.adminScheduleView') . '.addEdit', compact('schedule', 'ops', 'customers', 'users', 'vans', 'pickups', 'action', 'drivers', 'opsd'));
    }

    public function edit() {
        $schedule = Schedule::find(Input::get('id'));
        $pickups = $schedule->pickups()->with('user', 'address')->get();
        foreach($pickups as $key => $pickup){
            $pickups[$key]['sub_deatils'] = Subscription::where('user_id', $pickup->user_id)->where('user_address_id', $pickup->user_address_id)->orderBy('created_at', 'DESC')->with('frequency', 'packages')->first();
        }
        $userss = Role::find(3)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }
        $ops = [];
        $opss = $schedule->operators->toArray();

        foreach ($opss as $val) {
            array_push($ops, $val['id']);
        }

        $driverss = Role::find(4)->users->toArray();
        $drivers = [];
        foreach ($driverss as $value) {
            $drivers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        $opsd = [];
        $opsds = $schedule->drivers->toArray();
        foreach ($opsds as $val) {
            array_push($opsd, $val['id']);
        }

        $v = Asset::where("is_active", 1)->where("type", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }
        $c = Role::find(2)->users->toArray();
        $customers = [0 => "Select a Customer"];
        foreach ($c as $value) {
            $customers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }
        $action = "admin.schedule.save";
        
        return view(Config('constants.adminScheduleView') . '.addEdit', compact('schedule', 'customers', 'pickups', 'users', 'vans', 'ops', 'action', 'drivers', 'opsd'));
    }

    public function show() {
        $schedule = Schedule::find(Input::get('id'));
        $pickups = $schedule->pickups()->with('user', 'address')->get();
        foreach($pickups as $key => $pickup){
            $pickups[$key]['sub_deatils'] = Subscription::where('user_id', $pickup->user_id)->where('user_address_id', $pickup->user_address_id)->orderBy('created_at', 'DESC')->with('frequency', 'packages')->first();
        }
        
        $vans = Asset::where("is_active", 1)->where("type", 1)->get()->toArray();
        
        $operators = $schedule->operators->toArray();
        $drivers = $schedule->drivers->toArray();

        return view(Config('constants.adminScheduleView') . '.show', compact('schedule', 'drivers', 'pickups', 'users', 'vans', 'operators'));
    }
    
     public function removePickup() {
        $pickup = Pickup::find(Input::get('id'));
        if($pickup->delete()){
            return ['flash'=>'success'];
        }else{
            return ['flash'=>'fail'];
        }
    }

    public function save() {

        $schedule = Schedule::findOrNew(Input::get('id'));       
        $schedule->fill(Input::except('operators', 'drivers', 'pickup'))->save();
        $schedule->operators()->sync(Input::get('operators'));
        $schedule->drivers()->sync(Input::get('drivers'));        
        Pickup::where("schedule_id", $schedule->id)->delete(); 
        if (Input::get("pickup")) {
            foreach (Input::get("pickup") as $pickup) {
                $pickup['schedule_id'] = $schedule->id;
                Pickup::create($pickup);
                //print('<pre>'); print_r($pickup);print('</pre>'); 
            }
        }
        return redirect()->route('admin.schedule.view');
    }

    public function duplicate() {
        $schedule = Schedule::find(Input::get('id'));
        $op = [];
        $oprators = $schedule->operators()->get()->toArray();
        foreach ($oprators as $value) {
            array_push($op, $value['id']);
        }
        $dr = [];
        $drivers = $schedule->drivers()->get()->toArray();
        foreach ($drivers as $value) {
            array_push($dr, $value['id']);
        }
        $pickups = $schedule->pickups()->get();
        $new_schedule = $schedule->replicate();
        $new_schedule->push();
        $new_schedule->operators()->sync($op);
        $new_schedule->drivers()->sync($dr);
        foreach ($pickups as $key => $pickup) {
            $pickup->schedule_id = $new_schedule->id;
            $new_pickup = $pickup->replicate();
            $new_pickup->push();
        }
        return redirect()->back()->with("message", "Schedule duplicated sucessfully");
    }

    public function delete() {
        $schedule = Schedule::find(Input::get('id'));
        $schedule->delete();
        return redirect()->back()->with("message", "Schedule deleted sucessfully");
    }

}
