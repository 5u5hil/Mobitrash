<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Recordtype;
use App\Http\Controllers\Controller;

class RecordtypeController extends Controller {

    function index() {
        $recordtype = Recordtype::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminRecordtypeView') . '.index', compact('recordtype'));
    }

    public function add() {
        $recordtype = new Recordtype();
        $action = "admin.recordtype.save";
        return view(Config('constants.adminRecordtypeView') . '.addEdit', compact('recordtype', 'action'));
    }

    public function edit() {
        $recordtype = Recordtype::find(Input::get('id'));
        $action = "admin.recordtype.save";
        return view(Config('constants.adminRecordtypeView') . '.addEdit', compact('recordtype', 'action'));
    }

    public function save() {
        $recordtype = Recordtype::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.recordtype.view');
    }

    public function delete() {
        $recordtype = Recordtype::find(Input::get('id'));
        $recordtype->delete();
        return redirect()->back()->with("message", "Recordtype deleted sucessfully");
    }

}
