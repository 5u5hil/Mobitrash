<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Bonfleet;
use App\Http\Controllers\Controller;

class BonfleetController extends Controller {
    
    function index() {
        $bonfleets = Bonfleet::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminBonfleetView') . '.index', compact('bonfleets'));
    }

    public function add() {
        $bonfleets = new Bonfleet();
        $action = "admin.bonfleet.save";
        return view(Config('constants.adminBonfleetView') . '.addEdit', compact('bonfleets', 'action'));
    }

    public function edit() {
        $bonfleet = Bonfleet::find(Input::get('id'));
        $action = "admin.bonfleet.save";
        return view(Config('constants.adminBonfleetView') . '.addEdit', compact('bonfleet', 'action'));
    }

    public function save() {
        $bonfleets = Bonfleet::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.bonfleet.view');
    }

    public function delete() {
        $bonfleets = Bonfleet::find(Input::get('id'));
        $bonfleets->delete();
        return redirect()->back()->with("message", "Bonfleet deleted successfully");
    }

    public function insert() {
        $bonfleet = new Bonfleet();
        $bonfleet->bonfleet_id = Input::get('id');
        $bonfleet->fill(Input::except('id'));
        if (Input::get('id') && $bonfleet->save()) {
            return array('status' => 'success');
        }else{
            return array('status' => 'error');
        }
    }
    

}
