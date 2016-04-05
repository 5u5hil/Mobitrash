<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Asset;
use App\Models\City;
use App\Models\AssetType;
use App\Http\Controllers\Controller;

class AssetsController extends Controller {

    function index() {
        $assets = Asset::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminAssetView') . '.index', compact('assets'));
    }

    public function add() {
        $asset = new Asset();
        $eassets = Asset::where("type", 1)->get()->toArray();
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
        $eassets = Asset::where("type", 1)->get()->toArray();
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

    public function save() {
        $asset = Asset::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.assets.view');
    }

    public function delete() {
        $city = Asset::find(Input::get('id'));
        $city->delete();
        return redirect()->back()->with("message", "Asset deleted sucessfully");
    }

}
