<?php

namespace App\Http\Controllers\Frontend;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\Wastetype;
use App\Models\Additive;
use App\Models\Pickup;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Recordtype;
use App\Models\Asset;
use App\Models\Fueltype;
use App\Models\Record;
use App\Models\Attachment;
use App\Models\Subscription;
use File;
use App\Http\Controllers\Controller;
use Session;

class OperatorController extends Controller {

    public function login() {
        $user = User::where('id', Input::get("id"))->whereHas('roles', function($q) {
                    $q->where('id', 3);
                })->first();
        if ($user) {
            return ['flash' => 'success', 'User' => $user];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function schedules() {
        $schedules = Schedule::where('for', date('Y-m-d'))->with(['pickups.user', 'pickups.address'])->whereHas('operators', function($q) {
                    $q->where('user_id', Input::get("id"));
                })->orderBy('created_at', 'DESC')->get();
        $services = Service::get(['pickup_id']);
        $pickupids = array();
        foreach ($services as $service) {
            array_push($pickupids, $service->pickup_id);
        }
        foreach ($schedules as $key1 => $schedule) {
            foreach ($schedule['pickups'] as $key2 => $pickup) {
                if (in_array($pickup->id, $pickupids)) {
                    unset($schedules[$key1]['pickups'][$key2]);
                }
            }
            if (count($schedule['pickups']) == 0) {
                unset($schedules[$key1]);
            }
        }
        if ($schedules) {
            return ['flash' => 'success', 'Schedules' => $schedules];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function pickupDetails() {
        $wastetype = Wastetype::where('is_active', 1)->get();
        $additives = Additive::where('is_active', 1)->get();
        $pickup = Pickup::where('id', Input::get("id"))->with(['user', 'address'])->first();
        $maxwaste = Subscription::where('user_id', $pickup->user_id)->where('user_address_id', $pickup->user_address_id)->orderBy('created_at', 'DESC')->with('frequency', 'timeslot')->first(['max_waste']);
        if ($wastetype && $pickup && $additives) {
            return ['flash' => 'success', 'Wastetype' => $wastetype, 'Pickup' => $pickup, 'Additive' => $additives, 'Max_waste'=>$maxwaste];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function serviceSave() {
        $pickup_data = Input::get("pickup");
        $service_data = Input::get("service");
        $service = new Service;
        $service->user_id = $pickup_data['user_id'];
        $service->address_id = $pickup_data['user_address_id'];
        $service->schedule_id = $pickup_data['schedule_id'];
        $service->pickup_id = $pickup_data['id'];
        $service->crates_filled = $service_data['crates_filled'];
        $service->compost = $service_data['compost'];
        $service->start_kilometer = $service_data['start_kilometer'];
        $service->end_kilometer = $service_data['end_kilometer'];
        $service->time_taken = $service_data['time_taken'];
        $service->save();
        $service->wastetypes()->sync($service_data['wastetype']);
        $service->additives()->sync($service_data['additive']);
        return ['flash' => 'success'];
    }

    public function receiptData() {
        $assets = Asset::where('is_active', 1)->get();
        $recordtype = Recordtype::where('is_active', 1)->where('id', '!=', 3)->get();
        $fueltype = Fueltype::where('is_active', 1)->get();
        if ($assets && $recordtype && $fueltype) {
            return ['flash' => 'success', 'Assets' => $assets, 'Recordtype' => $recordtype, 'Fueltype' => $fueltype];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function receiptSave() {
        $record = new Record();
        $record->date = date('Y-m-d');
        $record->fill(Input::except('attachment'))->save();
        //Controller::pr(Input::all());
        if (Input::get('attachment')) {
            $att = Input::get('attachment');
            $destinationPath = public_path() . '/uploads/records/';
            $fileName = time() . '.' . $att['name'];
            if (File::put($destinationPath . $fileName, base64_decode($att['data']))) {
                Attachment::create(['record_id' => $record->id, 'file' => $fileName, 'filename' => $att['name'], 'is_active' => 1, "added_by" => Input::get("added_by")]);
            }
        }
        return ['flash' => 'success'];
    }

    public function cleaningData() {
        $record = Record::where('recordtype_id', 3)->where('date', date('Y-m-d'))->count();
        return ['flash' => 'success', 'Records' => $record];
    }

}
