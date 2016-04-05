<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\City;
use App\Http\Controllers\Controller;

class CitiesController extends Controller {

    function index() {
        $cities = City::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminCityView') . '.index', compact('cities'));
    }

    public function add() {
        $city = new City();
        $action = "admin.cities.save";
        return view(Config('constants.adminCityView') . '.addEdit', compact('city', 'action'));
    }

    public function edit() {
        $city = City::find(Input::get('id'));
        $action = "admin.cities.save";
        return view(Config('constants.adminCityView') . '.addEdit', compact('city', 'action'));
    }

    public function save() {
        $role = City::findOrNew(Input::get('id'));
        $role->name = Input::get('name');
        $role->is_active = Input::get('is_active');
        $role->save();
        return redirect()->route('admin.cities.view');
    }

    public function delete() {
        $city = City::find(Input::get('id'));
        $city->delete();
        return redirect()->back()->with("message", "City deleted sucessfully");
    }

}
