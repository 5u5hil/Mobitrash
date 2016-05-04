<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Schedule;
use App\Models\Pickup;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Asset;
use Session;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller {

    function index() {
        $v = Asset::where("is_active", 1)->where("type_id", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'];
        }
        $filter = array('' => 'All', 'name' => 'Schedule Name', 'for' => 'Schedule Date', 'van_id' => 'Van');
        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'name') {
                $field1 = Input::get('filter_value');
                $schedule = Schedule::where(Input::get('filter_type'), 'LIKE', "%" . Input::get('filter_value') . "%")->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'for') {
                $field2 = Input::get('filter_value');
                $schedule = Schedule::where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'van_id') {
                $field3 = Input::get('filter_value');
                $schedule = Schedule::where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            }
        } else {
            $schedule = Schedule::paginate(Config('constants.paginateNo'));
        }
        return view(Config('constants.adminScheduleView') . '.index', compact('schedule', 'vans', 'filter', 'filter_type', 'filter_value', 'field1', 'field2', 'field3'));
    }

    public function add() {
        $schedule = new Schedule();
        $pickups = $schedule->pickups()->with('user', 'address','subscription')->get();
        $userss = Role::find(3)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['name'];
        }
        $ops = [];
        $opss = $schedule->operators->toArray();
        foreach ($opss as $val) {
            array_push($ops, $val['id']);
        }

        $driverss = Role::find(4)->users->toArray();
        $drivers = [];
        foreach ($driverss as $value) {
            $drivers[$value['id']] = $value['name'];
        }

        $opsd = [];
        $opsds = $schedule->drivers->toArray();
        foreach ($opsds as $val) {
            array_push($opsd, $val['id']);
        }

        $v = Asset::where("is_active", 1)->where("type_id", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }

        $c = Subscription::get()->toArray();
        $subscriptions = [0 => "Select a Subscription"];
        foreach ($c as $value) {
            $subscriptions[$value['id']] = $value['name'];
        }
        $action = "admin.schedule.save";
        return view(Config('constants.adminScheduleView') . '.add', compact('schedule', 'ops', 'subscriptions', 'users', 'vans', 'pickups', 'action', 'drivers', 'opsd'));
    }

    public function edit() {
        $schedule = Schedule::find(Input::get('id'));
        $pickups = $schedule->pickups()->with('user', 'address','subscription')->get();
        
        $userss = Role::find(3)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['name'];
        }
        $ops = [];
        $opss = $schedule->operators->toArray();

        foreach ($opss as $val) {
            array_push($ops, $val['id']);
        }

        $driverss = Role::find(4)->users->toArray();
        $drivers = [];
        foreach ($driverss as $value) {
            $drivers[$value['id']] = $value['name'];
        }

        $opsd = [];
        $opsds = $schedule->drivers->toArray();
        foreach ($opsds as $val) {
            array_push($opsd, $val['id']);
        }

        $v = Asset::where("is_active", 1)->where("type_id", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }
        $c = Subscription::get()->toArray();
        $subscriptions = [0 => "Select a Subscription"];
        foreach ($c as $value) {
            $subscriptions[$value['id']] = $value['name'];
        }
        $action = "admin.schedule.update";

        return view(Config('constants.adminScheduleView') . '.edit', compact('schedule', 'subscriptions', 'pickups', 'users', 'vans', 'ops', 'action', 'drivers', 'opsd'));
    }

    public function show() {
        $schedule = Schedule::find(Input::get('id'));
        $pickups = $schedule->pickups()->with('user', 'address', 'subscription')->get();
        
        $operators = $schedule->operators->toArray();
        $drivers = $schedule->drivers->toArray();

        return view(Config('constants.adminScheduleView') . '.show', compact('schedule', 'drivers', 'pickups', 'users', 'vans', 'operators'));
    }

    public function removePickup() {
        $pickup = Pickup::find(Input::get('id'));
        if ($pickup->delete()) {
            return ['flash' => 'success'];
        } else {
            return ['flash' => 'fail'];
        }
    }

    public function save() {
        $schedule_dates = explode(', ', Input::get('multiple_dates'));
        foreach ($schedule_dates as $sdate) {
            $schedule = new Schedule;
            $schedule->for = $sdate;
            $schedule->fill(Input::except('operators', 'drivers', 'pickup', 'multiple_dates'))->save();
            $schedule->operators()->sync(Input::get('operators'));
            $schedule->drivers()->sync(Input::get('drivers'));
            Pickup::where("schedule_id", $schedule->id)->delete();

            if (Input::get("pickup")) {
                foreach (Input::get("pickup") as $pickup) {
                    $pickup['schedule_id'] = $schedule->id;
                    Pickup::create($pickup);
                }
            }
        }

        Session::flash('Success', 'Schedule Added Successfully!');
        return redirect()->route('admin.schedule.view');
    }

    public function update() {

        $schedule = Schedule::findOrNew(Input::get('id'));
        $schedule->fill(Input::except('operators', 'drivers', 'pickup'))->save();
        $schedule->operators()->sync(Input::get('operators'));
        $schedule->drivers()->sync(Input::get('drivers'));
        Pickup::where("schedule_id", $schedule->id)->delete();
        if (Input::get("pickup")) {
            foreach (Input::get("pickup") as $pickup) {
                $pickup['schedule_id'] = $schedule->id;
                Pickup::create($pickup);
            }
        }
        Session::flash('Success', 'Schedule Edited Successfully!');
        return redirect()->route('admin.schedule.view');
    }

    public function duplicate() {
        $schedule = Schedule::find(Input::get('schedule_id'));
        $schedule_dates = explode(', ', Input::get('multiple_dates'));
        foreach ($schedule_dates as $sdate) {
            $schedule->for = $sdate;
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
        }
        Session::flash('duplicateSuccess', 'Schedule Duplicated Successfully!');
        return redirect()->route('admin.schedule.view');
    }

    public function delete() {
        $schedule = Schedule::find(Input::get('id'));
        $schedule->delete();
        return redirect()->back()->with("message", "Schedule deleted sucessfully!");
    }

}
