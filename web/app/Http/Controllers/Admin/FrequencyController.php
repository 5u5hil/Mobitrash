<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Frequency;
use App\Http\Controllers\Controller;

class FrequencyController extends Controller {

    function index() {
        $frequency = Frequency::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminFrequencyView') . '.index', compact('frequency'));
    }

    public function add() {
        $frequency = new Frequency();
        $action = "admin.frequency.save";
        return view(Config('constants.adminFrequencyView') . '.addEdit', compact('frequency', 'action'));
    }

    public function edit() {
        $frequency = Frequency::find(Input::get('id'));
        $action = "admin.frequency.save";
        return view(Config('constants.adminFrequencyView') . '.addEdit', compact('frequency', 'action'));
    }

    public function save() {
        $frequency = Frequency::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.frequency.view');
    }

    public function delete() {
        $frequency = Frequency::find(Input::get('id'));
        $frequency->delete();
        return redirect()->back()->with("message", "Frequency deleted successfully");
    }

}
