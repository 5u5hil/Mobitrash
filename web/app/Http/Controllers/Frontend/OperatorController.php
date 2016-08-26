<?php

namespace App\Http\Controllers\Frontend;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\VanLocation;
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
use App\Models\Attendance;
use App\Models\Subscription;
use App\Models\Configuration;
use App\Models\Shift;
use File;
use App\Http\Controllers\Controller;
use Session;

class OperatorController extends Controller {

    public function login() {
        $user = User::where('id', Input::get("id"))->whereHas('roles', function($q) {
                    $q->where('id', '!=', 1);
                })->first();
        $attendance = Attendance::where('user_id', Input::get("id"))->where('date', date('Y-m-d'))->count();
        $schedules = Schedule::where('for', date('Y-m-d'));
        $schedules = $schedules->where(function($subQuery) {
            $subQuery->whereHas('operators', function($q) {
                        $q->where('user_id', Input::get("id"));
                    })
                    ->orWhereHas('drivers', function ( $q ) {
                        $q->where('user_id', Input::get("id"));
                    });
        });
        $schedules = $schedules->orderBy('created_at', 'DESC')->first(['id', 'start_kilometer', 'end_kilometer']);
        if ($user) {
            return ['flash' => 'success', 'User' => $user, 'Attendance' => $attendance, 'Schedule' => $schedules];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function schedules() {
        $wastetype = Wastetype::where('is_active', 1)->get();
        $additives = Additive::where('is_active', 1)->get();
        $schedules = Schedule::where('for', date('Y-m-d'))->with(['pickups.subscription.address', 'shift']);
        $schedules = $schedules->where('van_id', Input::get("id"));
        $schedules = $schedules->orderBy('sort_order', 'asc')->get();
        $services = Service::get(['pickup_id']);
        $pickupids = array();
        foreach ($services as $service) {
            array_push($pickupids, $service->pickup_id);
        }
        $cnt = 0;
        if ($schedules) {
            foreach ($schedules as $ke => $schedule) {
                unset($schedules[$ke]);
                $schedules['SH' . $schedule->id] = $schedule;
            }
            foreach ($schedules as $ke => $schedule) {
                foreach ($schedule['pickups'] as $key => $pickup) {
                    unset($schedules[$ke]['pickups'][$key]);
                    $schedules[$ke]['pickups']['ID' . $pickup->id] = $pickup;
                }
            }
            foreach ($schedules as $ke => $schedule) {
                foreach ($schedule['pickups'] as $key => $pickup) {
                    $schedules[$ke]['pickups'][$key]['pickuptime'] = date('h:i A', strtotime($pickup['pickuptime']));
                    if (in_array($pickup->id, $pickupids)) {
                        $cnt++;
                        unset($schedules[$ke]['pickups'][$key]);
                    }
                }
            }
        }
        if ($schedules) {
            return ['flash' => 'success', 'Schedules' => $schedules, 'Wastetype' => $wastetype, 'Additive' => $additives, 'cnt' => $cnt];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function pickupDetails() {
        $wastetype = Wastetype::where('is_active', 1)->get();
        $additives = Additive::where('is_active', 1)->get();
        $pickup = Pickup::where('id', Input::get("id"))->with(['user', 'address'])->first();
        if ($wastetype && $pickup && $additives) {
            return ['flash' => 'success', 'Wastetype' => $wastetype, 'Pickup' => $pickup, 'Additive' => $additives];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function serviceSave() {
        $pickup_data = Input::get("pickup");
        $service_data = Input::get("service");
        $service = new Service;
        $subscription = Subscription::find($pickup_data['subscription_id']);
        $service->operator_id = $service_data['operator_id'];
        $service->subscription_id = $pickup_data['subscription_id'];
        $service->user_id = $subscription->user_id;
        $service->address_id = $subscription->user_address_id;
        $service->schedule_id = $pickup_data['schedule_id'];
        $service->pickup_id = $pickup_data['id'];
        if (isset($service_data['crates_filled'])) {
            $service->crates_filled = $service_data['crates_filled'];
        }
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

    public function vanData() {
        $assets = Asset::where('is_active', 1)->get();
        if ($assets) {
            return ['flash' => 'success', 'Assets' => $assets];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function scheduleList() {
        $schedules = Schedule::where('for', date('Y-m-d'));
        $schedules = $schedules->where('van_id', Input::get("id"));
        $schedules = $schedules->orderBy('sort_order', 'asc')->get();
        if ($schedules) {
            return ['flash' => 'success', 'Schedules' => $schedules];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function settingSave() {
        $configuration = Configuration::where('id', 1)->first()->toArray();
        if (Input::get('password') == $configuration['van_password']) {
            return ['flash' => 'success'];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function logoutSave() {
        $attendance = Attendance::where('user_id', Input::get("id"))->where('date', date('Y-m-d'))->first();
        $attendance->logout_at = date('Y-m-d H:i:s');
        if (Input::get('image_data')) {
            $destinationPath = public_path() . '/uploads/attendance/';
            $fileName = time() . '.jpg';
            if (File::put($destinationPath . $fileName, base64_decode(Input::get('image_data')))) {
                $attendance->logout_image = $fileName;
            }
        }
        if ($attendance->update()) {
            return ['flash' => 'success'];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function receiptSave() {
        $record = new Record();
        $record->date = date('Y-m-d');
        $record->fill(Input::except('attachment'))->save();
        if (Input::get('attachment')) {
            $att = Input::get('attachment');
            $destinationPath = public_path() . '/uploads/records/';
            $fileName = 'Receipt-' . time() . '.jpg';
            if (File::put($destinationPath . $fileName, base64_decode($att))) {
                Attachment::create(['record_id' => $record->id, 'file' => $fileName, 'filename' => $fileName, 'is_active' => 1, "added_by" => Input::get("added_by")]);
            }
        }
        return ['flash' => 'success'];
    }

    public function attendance() {
        $user = User::where('id', Input::get("id"))->with('roles')->first()->toArray();
        
        foreach (Input::get('schedule_id') as $sch_id) {            
            if ($sch_id['checked']) {
                $schedule = Schedule::where('id', $sch_id['id'])->first();
                if ($user['roles'][0]['id'] == 3) {
                    $schedule->operators()->attach([Input::get("id")]);
                } else if ($user['roles'][0]['id'] == 4) {
                    $schedule->drivers()->attach([Input::get("id")]);
                }
            }
        }
        
        $attendance_exist = Attendance::where('user_id', Input::get("id"))->where('date', date('Y-m-d'))->count();
        if ($attendance_exist > 0) {
            return ['flash' => 'exist'];
        } else {
            $attendance = new Attendance();
            $attendance->user_id = Input::get('id');
            $attendance->date = date('Y-m-d');
            $attendance->app_version = Input::get('app_version');
            $user = User::where('id', Input::get('id'))->first();
            if (Input::get('image_data')) {
                $destinationPath = public_path() . '/uploads/attendance/';
                $fileName = time() . '.jpg';
                if (File::put($destinationPath . $fileName, base64_decode(Input::get('image_data')))) {
                    $attendance->image = $fileName;
                }
            }
            if ($attendance->save()) {
                return ['flash' => 'success', 'User' => $user];
            } else {
                return ['flash' => 'error'];
            }
        }
    }

    public function getAttendance() {
        $attendance_exist = Attendance::where('user_id', Input::get("id"))->where('date', date('Y-m-d'))->count();
        if ($attendance_exist > 0) {
            return ['attendance' => true];
        } else {
            return ['attendance' => false];
        }
    }

    public function cleaningData() {
        $record = Record::where('recordtype_id', 3)->where('asset_id', Input::get("id"))->where('date', date('Y-m-d'))->count();
        $vans = Asset::where('is_active', 1)->get()->toArray();
        return ['flash' => 'success', 'Records' => $record, 'Vans' => $vans];
    }

    public function kilometerUpdate() {
        if (Input::get('schedule_id')) {
            $schedule = Schedule::find(Input::get('schedule_id'));
            if (Input::get('start')) {
                $schedule->start_kilometer = Input::get('start');
            } else if (Input::get('end')) {
                $schedule->end_kilometer = Input::get('end');
            }
            $schedule->update();
            return ['flash' => 'success', 'start' => $schedule->start_kilometer, 'end' => $schedule->end_kilometer];
        } else {
            return ['flash' => 'error', 'message' => 'Invalid request! Please try again.'];
        }
    }

    public function offlineDataSave() {
        $pickups = Input::get('offlinePickup');
        $kilometers = Input::get('offlineKM');
        $cc = 0;
        if ($pickups) {
            foreach ($pickups as $pickup) {
                $cc++;
                $pickup_data = $pickup['pickup'];
                $service_data = $pickup['service'];
                $service = new Service;
                $subscription = Subscription::find($pickup_data['subscription_id']);
                $service->operator_id = $service_data['operator_id'];
                $service->user_id = $subscription->user_id;
                $service->address_id = $subscription->user_address_id;
                $service->schedule_id = $pickup_data['schedule_id'];
                $service->subscription_id = $pickup_data['subscription_id'];
                $service->pickup_id = $pickup_data['id'];
                if (isset($service_data['crates_filled'])) {
                    $service->crates_filled = $service_data['crates_filled'];
                }
                $service->time_taken = $service_data['time_taken'];
                $service->created_at = $service_data['created_at'];
                $service->save();
                $service->wastetypes()->sync($service_data['wastetype']);
                $service->additives()->sync($service_data['additive']);
            }
        }

        if ($kilometers) {
            foreach ($kilometers as $kms) {
                $schedule = Schedule::find($kms['schedule_id']);
                if (isset($kms['start'])) {
                    $schedule->start_kilometer = $kms['start'];
                } else if (isset($kms['end'])) {
                    $schedule->end_kilometer = $kms['end'];
                }
                $schedule->update();
            }
        }
        return ['flash' => 'success', 'cnt' => $cc];
    }

    public function locationUpdate() {
        $van_id = Input::get('id');
        $latitude = Input::get('lat');
        $longitude = Input::get('lng');
        if ($van_id && $latitude && $longitude) {
            $van_location = VanLocation::where('van_id', $van_id)->first();
            if (!$van_location) {
                $van_location = new VanLocation();
                $van_location->van_id = $van_id;
            }
            $van_location->latitude = $latitude;
            $van_location->longitude = $longitude;
            $van_location->save();
            return ['flash' => 'success'];
        } else {
            return ['flash' => 'error'];
        }
    }

}
