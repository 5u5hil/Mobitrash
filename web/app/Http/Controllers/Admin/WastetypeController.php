<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Wastetype;
use App\Http\Controllers\Controller;

class WastetypeController extends Controller {

    function index() {
        $wastetype = Wastetype::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminWastetypeView') . '.index', compact('wastetype'));
    }

    public function add() {
        $wastetype = new Wastetype();
        $action = "admin.wastetype.save";
        return view(Config('constants.adminWastetypeView') . '.addEdit', compact('wastetype', 'action'));
    }

    public function edit() {
        $wastetype = Wastetype::find(Input::get('id'));
        $action = "admin.wastetype.save";
        return view(Config('constants.adminWastetypeView') . '.addEdit', compact('wastetype', 'action'));
    }

    public function save() {
        $wastetype = Wastetype::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.wastetype.view');
    }

    public function delete() {
        $wastetype = Wastetype::find(Input::get('id'));
        $wastetype->delete();
        return redirect()->back()->with("message", "Wastetype deleted successfully");
    }

}
