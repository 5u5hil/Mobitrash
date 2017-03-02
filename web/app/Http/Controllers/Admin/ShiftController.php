<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Shift;
use App\Http\Controllers\Controller;

class ShiftController extends Controller {

    function index() {
        $shift = Shift::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminShiftView') . '.index', compact('shift'));
    }

    public function add() {
        $shift = new Shift();
        $action = "admin.shift.save";
        return view(Config('constants.adminShiftView') . '.addEdit', compact('shift', 'action'));
    }

    public function edit() {
        $shift = Shift::find(Input::get('id'));
        $action = "admin.shift.save";
        return view(Config('constants.adminShiftView') . '.addEdit', compact('shift', 'action'));
    }

    public function save() {
        $shift = Shift::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.shift.view');
    }

    public function delete() {
        $shift = Shift::find(Input::get('id'));
        $shift->delete();
        return redirect()->back()->with("message", "Shift deleted successfully");
    }

}
