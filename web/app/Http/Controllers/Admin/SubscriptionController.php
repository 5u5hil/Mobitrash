<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\Role;
use App\Models\Wastetype;
use App\Models\Frequency;
use App\Models\Timeslot;
use App\Models\Package;
use App\Models\Attachment;
use App\Http\Controllers\Controller;
use App\Models\Occupancy;

class SubscriptionController extends Controller {

    function index() {
        $f = Frequency::where("is_active", 1)->get()->toArray();
        $frequency = [];
        foreach ($f as $value) {
            $frequency[$value['id']] = $value['name'];
        }

        $t = Timeslot::where("is_active", 1)->where("type", 2)->get()->toArray();
        $timeslot = [];
        foreach ($t as $value) {
            $timeslot[$value['id']] = $value['name'];
        }
        $filter = array('' => 'All', 'renewal' => 'Due for Renewal', 'frequency_id' => 'Frequency', 'amt_paid' => 'Amount Paid', 'start_date' => 'Start Date', 'end_date' => 'End Date');

        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
        $field4 = NULL;
        $field5 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'timeslot_id') {
                $field1 = Input::get('filter_value');
            } else if ($filter_type == 'frequency_id') {
                $field2 = Input::get('filter_value');
            } else if ($filter_type == 'amt_paid') {
                $field3 = Input::get('filter_value');
            } else if ($filter_type == 'start_date') {
                $field4 = Input::get('filter_value');
                $filter_value = date("Y-m-d", strtotime(Input::get('filter_value')));
            } else if ($filter_type == 'end_date') {
                $field5 = Input::get('filter_value');
                $filter_value = date("Y-m-d", strtotime(Input::get('filter_value')));
            }
            $subscription = Subscription::where(Input::get('filter_type'), $filter_value)->orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        } else if (Input::get('filter_type') == 'renewal') {
            $filter_type = Input::get('filter_type');
            $now = Date('Y-m-d');
            $now_10days = Date('Y-m-d', strtotime($now . ' +10 day'));
            $subscription = Subscription::where('end_date', '<=', $now_10days)->orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        } else {
            $subscription = Subscription::orderBy('created_at', 'desc')->paginate(Config('constants.paginateNo'));
        }

        return view(Config('constants.adminSubscriptionView') . '.index', compact('subscription', 'frequency', 'timeslot', 'filter', 'filter_type', 'filter_value', 'field1', 'field2', 'field3', 'field4', 'field5'));
    }

    function renewal() {
        $now = Date('Y-m-d');
        $now_10days = Date('Y-m-d', strtotime($now . ' +10 day'));
        $f = Frequency::where("is_active", 1)->get()->toArray();
        $frequency = [];
        foreach ($f as $value) {
            $frequency[$value['id']] = $value['name'];
        }

        $t = Timeslot::where("is_active", 1)->where("type", 2)->get()->toArray();
        $timeslot = [];
        foreach ($t as $value) {
            $timeslot[$value['id']] = $value['name'];
        }
        $filter = array('' => 'All', 'timeslot_id' => 'Preffered Timeslot', 'frequency_id' => 'Frequency', 'amt_paid' => 'Amount Paid', 'start_date' => 'Start Date', 'end_date' => 'End Date');

        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
        $field4 = NULL;
        $field5 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'timeslot_id') {
                $field1 = Input::get('filter_value');
            } else if ($filter_type == 'frequency_id') {
                $field2 = Input::get('filter_value');
            } else if ($filter_type == 'amt_paid') {
                $field3 = Input::get('filter_value');
            } else if ($filter_type == 'start_date') {
                $field4 = Input::get('filter_value');
            } else if ($filter_type == 'end_date') {
                $field5 = Input::get('filter_value');
            }
            $subscription = Subscription::where('end_date', '<=', $now_10days)->where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
        } else {
            $subscription = Subscription::where('end_date', '<=', $now_10days)->paginate(Config('constants.paginateNo'));
        }
        return view(Config('constants.adminRenewalView') . '.renewal', compact('subscription', 'frequency', 'timeslot', 'filter', 'filter_type', 'filter_value', 'field1', 'field2', 'field3', 'field4', 'field5'));
    }

    public function add() {
        $subscription = new Subscription();

        $userss = Role::find(2)->users->toArray();
        $users = [];
        $users = [0 => "Select a Customer"];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['name'];
        }

        $occupancyd = Occupancy::where("is_active", 1)->get()->toArray();
        $occupancy = [];
        foreach ($occupancyd as $value) {
            $occupancy[$value['id']] = $value['name'];
        }

        $wastetypess = Wastetype::where("is_active", 1)->get()->toArray();
        $wastetype = [];
        foreach ($wastetypess as $value) {
            $wastetype[$value['id']] = $value['name'];
        }
        $return_of_compost = false;

        $f = Frequency::where("is_active", 1)->get()->toArray();
        $frequency = [];
        foreach ($f as $value) {
            $frequency[$value['id']] = $value['name'];
        }

        $pack = Package::where("is_active", 1)->get()->toArray();
        $packages = [];
        foreach ($pack as $value) {
            $packages[$value['id']] = $value['name'];
        }

        $t = Timeslot::where("is_active", 1)->where("type", 2)->get()->toArray();
        $timeslot = [];
        foreach ($t as $value) {
            $timeslot[$value['id']] = $value['name'];
        }


        $action = "admin.subscription.save";
        return view(Config('constants.adminSubscriptionView') . '.addEdit', compact('subscription', 'users', 'frequency', 'timeslot', 'action', 'wastetype', 'wastetype_selected', 'packages', 'occupancy', 'return_of_compost'));
    }

    public function edit() {
        $subscription = Subscription::find(Input::get('id'));
        $userss = Role::find(2)->users->toArray();

        $users = [];
        $users = [0 => "Select a Customer"];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['name'];
        }

        $wastetypess = Wastetype::where("is_active", 1)->get()->toArray();
        $wastetype = [];
        foreach ($wastetypess as $value) {
            $wastetype[$value['id']] = $value['name'];
        }
        $return_of_compost = false;
        if ($subscription->return_of_compost) {
            $return_of_compost = true;
        }

        $billing_method = false;
        if ($subscription->billing_method == 1) {
            $billing_method = true;
        }

        $occupancyd = Occupancy::where("is_active", 1)->get()->toArray();
        $occupancy = [];
        foreach ($occupancyd as $value) {
            $occupancy[$value['id']] = $value['name'];
        }


        $f = Frequency::where("is_active", 1)->get()->toArray();
        $frequency = [];
        foreach ($f as $value) {
            $frequency[$value['id']] = $value['name'];
        }

        $pack = Package::where("is_active", 1)->get()->toArray();
        $packages = [];
        foreach ($pack as $value) {
            $packages[$value['id']] = $value['name'];
        }

        $t = Timeslot::where("is_active", 1)->get()->toArray();
        $timeslot = [];
        foreach ($t as $value) {
            $timeslot[$value['id']] = $value['name'];
        }

        $action = "admin.subscription.save";
        return view(Config('constants.adminSubscriptionView') . '.addEdit', compact('subscription', 'users', 'frequency', 'timeslot', 'action', 'wastetype', 'wastetype_selected', 'packages', 'occupancy', 'return_of_compost', 'billing_method'));
    }

    public function save() {
        $subscription = Subscription::findOrNew(Input::get('id'));
        $subscription->fill(Input::except('att'))->save();
        foreach (Input::file('att') as $key => $att) {
            if ($att) {
                $destinationPath = public_path() . '/uploads/records/';
                $fileName = time() . $key . '.' . $att->getClientOriginalExtension();
                if ($att->move($destinationPath, $fileName)) {
                    Attachment::create(['subscription_id' => $subscription->id, 'file' => $fileName, 'filename' => $att->getClientOriginalName(), 'is_active' => 1, "added_by" => Input::get("added_by")]);
                }
            }
        }
        return redirect()->route('admin.subscription.view');
    }

    public function delete() {
        $subscription = Subscription::find(Input::get('id'));
        $subscription->delete();
        return redirect()->back()->with("message", "Subscription deleted sucessfully");
    }

    public function rmfile() {
        $atta = Attachment::find(Input::get('id'));
        $atta->is_active = '0';
        $atta->save();
        return redirect()->back()->with("message", "Attachment Removed sucessfully");
        exit();
    }

}
