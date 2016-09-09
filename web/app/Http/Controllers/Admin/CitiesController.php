<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PipedriveController;

class CitiesController extends Controller {

    function index() {
        $cities = City::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminCityView') . '.index', compact('cities'));
    }

    public function add() {
        $city = new City();
        $pipes = app('App\Http\Controllers\Admin\PipedriveController')->getPipelines();
        $pipelines = [0 => 'Select Pipeline'];
        $stages = [];
        foreach ($pipes['data'] as $val) {
            $pipelines[$val['id']] = $val['name'];
        }
        $action = "admin.cities.save";
        return view(Config('constants.adminCityView') . '.addEdit', compact('city', 'action', 'pipelines', 'stages'));
    }

    public function edit() {
        $city = City::find(Input::get('id'));
        $pipes = app('App\Http\Controllers\Admin\PipedriveController')->getPipelines();
        $pipelines = [ '' => 'Select Pipeline'];        
        foreach ($pipes['data'] as $val) {
            $pipelines[$val['id']] = $val['name'];
        }
        $stage = app('App\Http\Controllers\Admin\PipedriveController')->getStage($city->pipeline_id);
        $stages = ['' => 'Select Pipeline Stage'];
        foreach ($stage['stages'] as $val){
            $stages[$val['id']] = $val['name'];
        }
        $action = "admin.cities.save";
        return view(Config('constants.adminCityView') . '.addEdit', compact('city', 'action', 'pipelines', 'stages'));
    }

    public function save() {
        $role = City::findOrNew(Input::get('id'));
        $role->fill(Input::all())->save();
        return redirect()->route('admin.cities.view');
    }

    public function delete() {
        $city = City::find(Input::get('id'));
        $city->delete();
        return redirect()->back()->with("message", "City deleted sucessfully");
    }

}
