<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Subscription;
use App\Models\Wastetype;
use App\Models\Additive;
use App\Models\Pickup;
use App\Models\Asset;
use App\Models\User;
use App\Http\Controllers\Controller;

class ServicehistoryController extends Controller {

    function index() {

        $v = Asset::where("is_active", 1)->where("type_id", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . '-' . $value['asset_no'];
        }
        $sub = Subscription::get()->toArray();
        $subscriptions = [];
        foreach ($sub as $value) {
            $subscriptions[$value['id']] = $value['name'];
        }
        $op = User::whereHas('roles', function($q) {
                    $q->where('id', 3);
                })->get()->toArray();
        $operators = [];
        foreach ($op as $value) {
            $operators[$value['id']] = $value['name'];
        }
        $filter = array('' => 'All', 'van_id' => 'Van', 'operator_id' => 'Staff Name', 'created_at' => 'Date', 'subscription_id' => 'User Subscription');
        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
        $field4 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'van_id') {
                $field1 = Input::get('filter_value');
                $services = Service::whereHas('schedule.van', function($q) {
                            $q->where('id', Input::get('filter_value'));
                        })->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'operator_id') {
                $field2 = Input::get('filter_value');
                $services = Service::where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'created_at') {
                $field3 = Input::get('filter_value');
                $services = Service::where(Input::get('filter_type'), 'LIKE', "%" . date("Y-m-d", strtotime(Input::get('filter_value'))) . "%")->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'subscription_id') {
                $field4 = Input::get('filter_value');
                $services = Service::where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            }
        } else {
            $services = Service::orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        }
        return view(Config('constants.adminServiceHistoryView') . '.index', compact('services', 'vans', 'subscriptions', 'operators', 'filter', 'filter_type', 'filter_value', 'field1', 'field2', 'field3', 'field4'));
    }

    public function add() {
        $service = new Service();
        $action = "admin.servicehistory.save";
        return view(Config('constants.adminServiceHistoryView') . '.addEdit', compact('service', 'action'));
    }

    public function edit() {
        $service = Service::find(Input::get('id'));
        $wastetype = Wastetype::where('is_active', 1)->get()->toArray();
        $additives = Additive::where('is_active', 1)->get()->toArray();
        foreach ($wastetype as $key => $waste2) {
            $wastetype[$key]['value'] = NULL;
            foreach ($service->wastetypes as $waste) {
                if ($waste2['id'] == $waste->pivot->wastetype_id) {
                    $wastetype[$key]['value'] = $waste->pivot->quantity;
                }
            }
        }
        foreach ($additives as $key => $additive) {
            $additives[$key]['value'] = NULL;
            foreach ($service->additives as $add) {
                if ($additive['id'] == $add->pivot->additive_id) {
                    $additives[$key]['value'] = $add->pivot->quantity;
                }
            }
        }
        $pickup = Pickup::where('id', $service->pickup_id)->with(['user', 'address'])->first();
        $action = "admin.servicehistory.save";
        return view(Config('constants.adminServiceHistoryView') . '.addEdit', compact('service', 'action', 'wastetype', 'additives'));
    }

    public function save() {
        $service = Service::findOrNew(Input::get('id'));
        $wastes = Input::get('wastetype');
        $additives = Input::get('additive');
        foreach ($wastes as $key => $wate) {
            if(!$wate['quantity']){
                unset($wastes[$key]);
            }
        }
        foreach ($additives as $key => $add) {
            if(!$add['quantity']){
                unset($additives[$key]);
            }
        }
        if (Input::get('crates_filled')) {
            $service->crates_filled = Input::get('crates_filled');
        }
        $service->time_taken = Input::get('time_taken');
        $service->save();
        $service->wastetypes()->sync($wastes);
        $service->additives()->sync($additives);
        return redirect()->route('admin.servicehistory.view');
    }

    public function delete() {
        $services = Service::find(Input::get('id'));
        $services->delete();
        return redirect()->back()->with("message", "Service deleted sucessfully");
    }

}
