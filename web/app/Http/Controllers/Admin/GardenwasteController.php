<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\GardenWaste;
use App\Models\Configuration;
use App\Models\PickupSlot;
use Request;
use Session;

class GardenwasteController extends Controller {

    function index() {
        $pickups = GardenWaste::orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminGardenwasteView') . '.index', compact('pickups'));
    }

    function setting() {
        $configuration = Configuration::find(1);
        $action = "admin.gardenwaste.savesetting";
        return view(Config('constants.adminGardenwasteView') . '.setting', compact('action', 'configuration'));
    }

    public function saveSetting() {
        $configuration = Configuration::findOrNew(Input::get('id'))->fill(Input::all())->save();
        Session::flash('message', "Settings Updated Successfully!");
        return redirect()->route('admin.gardenwaste.setting');
    }

    function pickupslot() {
        $pickups = PickupSlot::get()->toArray();
        $pickupslots = [];
        foreach ($pickups as $key => $pickup) {
            array_push($pickupslots, $pickup['pickup_date']);
        }
        $pickupslots = json_encode($pickupslots);
        $action = "admin.gardenwaste.savepickupslot";
        return view(Config('constants.adminGardenwasteView') . '.pickupslot', compact('action', 'pickupslots'));
    }

    public function savePickupslot() {
        if (Input::get('multiple_dates')) {
            PickupSlot::truncate();
            $slots = explode(', ', Input::get('multiple_dates'));
            foreach ($slots as $slot) {
                $pickupslot = new PickupSlot();
                $pickupslot->pickup_date = $slot;
                $pickupslot->save();
            }
        }
        Session::flash('message', "Pickup Slots Updated Successfully!");
        return redirect()->route('admin.gardenwaste.pickupslot');
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
        return redirect()->back()->with("message", "Asset deleted sucessfully");
    }

}
