<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\Role;
use App\Models\Wastetype;
use App\Models\Frequency;
use App\Models\Timeslot;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller {

    function index() {
        $subscription = Subscription::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminSubscriptionView') . '.index', compact('subscription'));
    }

    public function add() {
        $subscription = new Subscription();

        $userss = Role::find(2)->users->toArray();
        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        $wastetypess = Wastetype::all()->toArray();
        $wastetype = [];
        foreach ($wastetypess as $value) {
            $wastetype[$value['id']] = $value['name'];
        }

        $wastetype_selected = [];
        $wastetype_selecteds = $subscription->wastetypes->toArray();
        foreach ($wastetype_selecteds as $val)
            array_push($wastetype_selected, $val['id']);

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


        $action = "admin.subscription.save";
        return view(Config('constants.adminSubscriptionView') . '.addEdit', compact('subscription', 'users', 'frequency', 'timeslot', 'action', 'wastetype', 'wastetype_selected'));
    }

    public function edit() {
        $subscription = Subscription::find(Input::get('id'));
        $userss = Role::find(2)->users->toArray();

        $users = [];
        foreach ($userss as $value) {
            $users[$value['id']] = $value['first_name'] . " " . $value['last_name'];
        }

        $wastetypess = Wastetype::all()->toArray();
        $wastetype = [];
        foreach ($wastetypess as $value) {
            $wastetype[$value['id']] = $value['name'];
        }

        $wastetype_selected = [];
        $wastetype_selecteds = $subscription->wastetypes->toArray();
        foreach ($wastetype_selecteds as $val)
            array_push($wastetype_selected, $val['id']);

        $f = Frequency::where("is_active", 1)->get()->toArray();
        $frequency = [];
        foreach ($f as $value) {
            $frequency[$value['id']] = $value['name'];
        }

        $t = Timeslot::where("is_active", 1)->get()->toArray();
        $timeslot = [];
        foreach ($t as $value) {
            $timeslot[$value['id']] = $value['name'];
        }

        $action = "admin.subscription.save";
        return view(Config('constants.adminSubscriptionView') . '.addEdit', compact('subscription', 'users', 'frequency', 'timeslot', 'action', 'wastetype', 'wastetype_selected'));
    }

    public function save() {
        $subscription = Subscription::findOrNew(Input::get('id'));
        $subscription->fill(Input::except('wastetype'))->save();
        $subscription->wastetypes()->sync(Input::get('wastetype'));
        return redirect()->route('admin.subscription.view');
    }

    public function delete() {
        $subscription = Subscription::find(Input::get('id'));
        $subscription->delete();
        return redirect()->back()->with("message", "Subscription deleted sucessfully");
    }

}
