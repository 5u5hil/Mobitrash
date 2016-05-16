<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Service;
use App\Models\Schedule;
use App\Models\Asset;
use App\Models\User;
use App\Http\Controllers\Controller;

class ServicehistoryController extends Controller {

    function index() {
        
        $v = Asset::where("is_active", 1)->where("type_id", 1)->get()->toArray();
        $vans = [];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'].'-'.$value['asset_no'];
        }
        $op = User::whereHas('roles', function($q) {
                    $q->where('id', 3);
                })->get()->toArray();
        $operators = [];
        foreach ($op as $value) {
            $operators[$value['id']] = $value['name'];
        }
        $filter = array('' => 'All', 'van_id' => 'Van', 'operator_id' => 'Staff Name', 'created_at' => 'Date');
        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
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
                $services = Service::where(Input::get('filter_type'),'LIKE', "%".date("Y-m-d", strtotime(Input::get('filter_value')))."%")->paginate(Config('constants.paginateNo'));
            }
        } else {
            $services = Service::orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        }
        return view(Config('constants.adminServiceHistoryView') . '.index', compact('services', 'vans', 'operators', 'filter', 'filter_type', 'filter_value', 'field1', 'field2', 'field3'));
    }

    public function add() {
        $services = new Service();
        $action = "admin.services.save";
        return view(Config('constants.adminServiceView') . '.addEdit', compact('services', 'action'));
    }

    public function edit() {
        $services = Service::find(Input::get('id'));
        $action = "admin.services.save";
        return view(Config('constants.adminServiceView') . '.addEdit', compact('services', 'action'));
    }

    public function save() {
        $services = Service::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.services.view');
    }

    public function delete() {
        $services = Service::find(Input::get('id'));
        $services->delete();
        return redirect()->back()->with("message", "Service deleted sucessfully");
    }

}
