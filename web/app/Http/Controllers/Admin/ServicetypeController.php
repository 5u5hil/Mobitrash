<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Servicetype;
use App\Http\Controllers\Controller;

class ServicetypeController extends Controller {

    function index() {
        $servicetype = Servicetype::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminServicetypeView') . '.index', compact('servicetype'));
    }

    public function add() {
        $servicetype = new Servicetype();
        $action = "admin.servicetype.save";
        return view(Config('constants.adminServicetypeView') . '.addEdit', compact('servicetype', 'action'));
    }

    public function edit() {
        $servicetype = Servicetype::find(Input::get('id'));
        $action = "admin.servicetype.save";
        return view(Config('constants.adminServicetypeView') . '.addEdit', compact('servicetype', 'action'));
    }

    public function save() {
        $servicetype = Servicetype::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.servicetype.view');
    }

    public function delete() {
        $servicetype = Servicetype::find(Input::get('id'));
        $servicetype->delete();
        return redirect()->back()->with("message", "Servicetype deleted successfully");
    }

}
