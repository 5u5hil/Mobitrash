<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Occupancy;
use App\Http\Controllers\Controller;

class OccupancyController extends Controller {

    function index() {
        $occupancy = Occupancy::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminOccupancyView') . '.index', compact('occupancy'));
    }

    public function add() {
        $occupancy = new Occupancy();
        $action = "admin.occupancy.save";
        return view(Config('constants.adminOccupancyView') . '.addEdit', compact('occupancy', 'action'));
    }

    public function edit() {
        $occupancy = Occupancy::find(Input::get('id'));
        $action = "admin.occupancy.save";
        return view(Config('constants.adminOccupancyView') . '.addEdit', compact('occupancy', 'action'));
    }

    public function save() {
        $occupancy = Occupancy::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.occupancy.view');
    }

    public function delete() {
        $occupancy = Occupancy::find(Input::get('id'));
        $occupancy->delete();
        return redirect()->back()->with("message", "Occupancy deleted successfully");
    }

}
