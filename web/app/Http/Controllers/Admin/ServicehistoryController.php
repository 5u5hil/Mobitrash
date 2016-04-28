<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Service;
use App\Models\Schedule;
use App\Http\Controllers\Controller;

class ServicehistoryController extends Controller {

    function index() {
        $services = Service::orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        
        return view(Config('constants.adminServiceHistoryView') . '.index', compact('services'));
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
