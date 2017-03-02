<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Fueltype;
use App\Http\Controllers\Controller;

class FueltypeController extends Controller {

    function index() {
        $fueltype = Fueltype::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminFueltypeView') . '.index', compact('fueltype'));
    }

    public function add() {
        $fueltype = new Fueltype();
        $action = "admin.fueltype.save";
        return view(Config('constants.adminFueltypeView') . '.addEdit', compact('fueltype', 'action'));
    }

    public function edit() {
        $fueltype = Fueltype::find(Input::get('id'));
        $action = "admin.fueltype.save";
        return view(Config('constants.adminFueltypeView') . '.addEdit', compact('fueltype', 'action'));
    }

    public function save() {
        $fueltype = Fueltype::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.fueltype.view');
    }

    public function delete() {
        $fueltype = Fueltype::find(Input::get('id'));
        $fueltype->delete();
        return redirect()->back()->with("message", "Fueltype deleted successfully");
    }

}
