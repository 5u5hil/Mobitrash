<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Asset;
use App\Models\City;
use App\Models\AssetType;
use App\Http\Controllers\Controller;
use Request;
use Session;

class AssetsController extends Controller {

    function index() {
        
        $acities = City::where("is_active", 1)->get()->toArray();
        $cities = [];
        foreach ($acities as $value) {
            $cities[$value['id']] = $value['name'];
        }


        $atypes = AssetType::select('id', 'name')->get()->toArray();
        $types = [];
        foreach ($atypes as $value) {
            $types[$value['id']] = $value['name'];
        }
        $filter = array('' => 'All', 'name' => 'Asset Name', 'type_id' => 'Type', 'city_id' => 'City');
        
        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'name') {
                $field1 = Input::get('filter_value');
                $assets = Asset::where(Input::get('filter_type'), 'LIKE' , "%".Input::get('filter_value')."%")->orderBy("id","desc")->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'type_id') {
                $field2 = Input::get('filter_value');
                $assets = Asset::where(Input::get('filter_type'), Input::get('filter_value'))->orderBy("id","desc")->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'city_id') {
                $field3 = Input::get('filter_value');
                $assets = Asset::where(Input::get('filter_type'), Input::get('filter_value'))->orderBy("id","desc")->paginate(Config('constants.paginateNo'));
            }
            
        } else {
            $assets = Asset::orderBy("id","desc")->paginate(Config('constants.paginateNo'));
        }
        Session::put('backUrl', Request::fullUrl());
        return view(Config('constants.adminAssetView') . '.index', compact('assets', 'cities', 'types', 'filter', 'filter_type', 'filter_value','field1', 'field2', 'field3'));
    }

    public function add() {
        $asset = new Asset();
        $eassets = Asset::where("type_id", 1)->get()->toArray();
        $exassets = [0 => "Individual Asset"];
        foreach ($eassets as $value) {
            $exassets[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }

        $acities = City::where("is_active", 1)->get()->toArray();
        $cities = [];
        foreach ($acities as $value) {
            $cities[$value['id']] = $value['name'];
        }


        $atypes = AssetType::select('id', 'name')->get()->toArray();
        $types = [];
        foreach ($atypes as $value) {
            $types[$value['id']] = $value['name'];
        }
        $action = "admin.assets.save";
        return view(Config('constants.adminAssetView') . '.addEdit', compact('asset', 'types', 'cities', 'exassets', 'action'));
    }

    public function edit() {
        $asset = Asset::find(Input::get('id'));
        $eassets = Asset::where("type_id", 1)->get()->toArray();
        $exassets = [0 => "Individual Asset"];
        foreach ($eassets as $value) {
            $exassets[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }

        $acities = City::where("is_active", 1)->get()->toArray();
        $cities = [];
        foreach ($acities as $value) {
            $cities[$value['id']] = $value['name'];
        }


        $atypes = AssetType::select('id', 'name')->get()->toArray();
        $types = [];
        foreach ($atypes as $value) {
            $types[$value['id']] = $value['name'];
        }


        $action = "admin.assets.save";
        return view(Config('constants.adminAssetView') . '.addEdit', compact('asset', 'types', 'cities', 'exassets', 'action'));
    }
    
    public function show() {
        $assets = Asset::find(Input::get('id')); 
        return view(Config('constants.adminAssetView') . '.show', compact('assets'));
    }

    public function save() {
        $asset = Asset::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->to(Session::get('backUrl'));
    }

    public function delete() {
        $city = Asset::find(Input::get('id'));
        $city->delete();
        return redirect()->back()->with("message", "Asset deleted successfully");
    }

}
