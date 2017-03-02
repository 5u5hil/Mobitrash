<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Additive;
use App\Http\Controllers\Controller;

class AdditiveController extends Controller {

    function index() {
        $additive = Additive::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminAdditiveView') . '.index', compact('additive'));
    }

    public function add() {
        $additive = new Additive();
        $action = "admin.additive.save";
        return view(Config('constants.adminAdditiveView') . '.addEdit', compact('additive', 'action'));
    }

    public function edit() {
        $additive = Additive::find(Input::get('id'));
        $action = "admin.additive.save";
        return view(Config('constants.adminAdditiveView') . '.addEdit', compact('additive', 'action'));
    }

    public function save() {
        $additive = Additive::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.additive.view');
    }

    public function delete() {
        $additive = Additive::find(Input::get('id'));
        $additive->delete();
        return redirect()->back()->with("message", "Additive deleted successfully");
    }

}
