<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Timeslot;
use App\Http\Controllers\Controller;

class TimeslotController extends Controller {

    function index() {
        $timeslot = Timeslot::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminTimeslotView') . '.index', compact('timeslot'));
    }

    public function add() {
        $timeslot = new Timeslot();
        $action = "admin.timeslot.save";
        return view(Config('constants.adminTimeslotView') . '.addEdit', compact('timeslot', 'action'));
    }

    public function edit() {
        $timeslot = Timeslot::find(Input::get('id'));
        $action = "admin.timeslot.save";
        return view(Config('constants.adminTimeslotView') . '.addEdit', compact('timeslot', 'action'));
    }

    public function save() {
        $timeslot = Timeslot::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.timeslot.view');
    }

    public function delete() {
        $timeslot = Timeslot::find(Input::get('id'));
        $timeslot->delete();
        return redirect()->back()->with("message", "Timeslot deleted successfully");
    }

}
