<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Schedule;
use App\Models\Pickup;
use App\Models\Role;
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

        $v = Asset::where("is_active", 1)->where("type", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }
        $ops = [];
        $opss = $schedule->operators->toArray();

        $c = Role::find(2)->users->toArray();
        $customers = [0 => "Select a Customer"];
        foreach ($c as $value) {
            $customers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        foreach ($opss as $val)
            array_push($ops, $val['id']);

        $action = "admin.schedule.save";
        
        return view(Config('constants.adminScheduleView') . '.addEdit', compact('schedule', 'ops', 'customers', 'users', 'vans','pickups', 'action'));
    }

    public function edit() {
        $schedule = Schedule::find(Input::get('id'));

        $pickups = $schedule->pickups()->with('user', 'address')->get();
        $userss = Role::find(3)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }
        
        $v = Asset::where("is_active", 1)->where("type", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }
        $ops = [];
        $opss = $schedule->operators->toArray();

        $c = Role::find(2)->users->toArray();
        $customers = [0 => "Select a Customer"];
        foreach ($c as $value) {
            $customers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        foreach ($opss as $val)
            array_push($ops, $val['id']);
        $action = "admin.schedule.save";        
        
        return view(Config('constants.adminScheduleView') . '.addEdit', compact('schedule', 'customers', 'pickups', 'users', 'vans', 'ops', 'action'));
    }
    public function show() {
         $schedule = Schedule::find(Input::get('id'));

        $pickups = $schedule->pickups()->with('user', 'address')->get();
        $userss = Role::find(3)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }
        
        $v = Asset::where("is_active", 1)->where("type", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }
        $ops = [];
        $opss = $schedule->operators->toArray();

        $c = Role::find(2)->users->toArray();
        $customers = [0 => "Select a Customer"];
        foreach ($c as $value) {
            $customers[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        foreach ($opss as $val)
            array_push($ops, $val['id']);
        $action = "admin.schedule.save";        
        
        return view(Config('constants.adminScheduleView') . '.addEdit', compact('schedule', 'customers', 'pickups', 'users', 'vans', 'ops', 'action'));
    
    }

    public function save() {

        $schedule = Schedule::findOrNew(Input::get('id'));
        $schedule->fill(Input::except('operators', 'pickup'))->save();
        $schedule->operators()->sync(Input::get('operators'));


        Pickup::where("schedule_id", $schedule->id)->delete();
        foreach (Input::get("pickup") as $pickup) {
            $pickup['schedule_id'] = $schedule->id;
            Pickup::create($pickup);
        }
        return redirect()->route('admin.schedule.view');
    }
    
    public function duplicate() {
        $schedule = Schedule::find(Input::get('id'));
        $pickups = $schedule->pickups()->get();
        $new_schedule = $schedule->replicate();
        $new_schedule->push();              
        foreach ($pickups as $key=>$pickup){
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
