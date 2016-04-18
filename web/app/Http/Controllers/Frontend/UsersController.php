<?php

namespace App\Http\Controllers\Frontend;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Hash;
use Session;
use App\Models\Wastetype;
use App\Models\Frequency;
use App\Models\Timeslot;
use App\Models\Package;
use App\Models\City;
use App\Models\Occupancy;
use App\Models\Address;
use App\Models\Subscription;

class UsersController extends Controller {

    public function login() {
        return view(Config('constants.frontendView') . '.login');
    }

    public function register() {
        $wastetypess = Wastetype::all()->toArray();
        $wastetype = [];
        foreach ($wastetypess as $value) {
            $wastetype[$value['id']] = $value['name'];
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

        $t = Timeslot::where("is_active", 1)->where("type", 2)->get()->toArray();
        $timeslot = [];
        foreach ($t as $value) {
            $timeslot[$value['id']] = $value['name'];
        }

        $citiesd = City::where("is_active", 1)->get()->toArray();
        $cities = [];
        foreach ($citiesd as $value) {
            $cities[$value['id']] = $value['name'];
        }
        $occupancyd = Occupancy::where("is_active", 1)->get()->toArray();
        $occupancy = [];
        foreach ($occupancyd as $value) {
            $occupancy[$value['id']] = $value['name'];
        }
        return view(Config('constants.frontendView') . '.register', compact('frequency', 'timeslot', 'action', 'wastetype', 'wastetype_selected', 'packages', 'cities', 'occupancy'));
    }

    public function registerUser() {
        $chk = User::where("email", "=", Input::get('email'))->first();

        if (empty($chk)) {
            $user = new User();
            $user->first_name = Input::get('first_name');
            $user->last_name = Input::get('last_name');
            $user->email = Input::get('email');
            $user->phone_number = Input::get('phone_number');
            $user->password = Hash::make(Input::get('password'));
            $user->user_type = 1;
            $user->save();
            $user->roles()->sync([2]);
            $userD = ['email' => Input::get('email'),
                'password' => Input::get('password')
            ];
            if (Auth::attempt($userD, true)) {
                Session::put('loggedinUserId', $user->id);
                return redirect()->route('user.register');
            } else {
                return redirect()->route('user.register');
            }
        } else {
            Session::flash("usenameError", "Username already exist");
            return redirect()->back();
        }
    }

    public function checkUserLogin() {
        $userDetails = User::where("email", "=", Input::get("email"))->first();
        $userData = ['email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        if (Auth::attempt($userData, true)) {
            $user = User::with('roles')->find($userDetails->id);

            Session::put('loggedinUserId', $userDetails->id);
            $roles = $user->roles()->first();
            $r = Role::find($roles->id);
            $per = $r->perms()->get()->toArray();
            return redirect()->route('user.myprofile.view');
        } else {
            Session::flash('invalidUser', 'Invalid Username or Password');
            return redirect()->route('user.login');
        }
    }

    public function userLogout() {
        Auth::logout();
        Session::flush();
        return redirect()->route('user.login');
    }

    public function myProfile() {
        $user = User::find(Auth::id());
        $action = 'user.profile.update';
        return view(Config('constants.frontendView') . '.myprofile', compact('user', 'action'));
    }

    public function update() {

        $user = User::find(Input::get('id'));
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->phone_number = Input::get('phone_number');
        $user->email = Input::get('email');
        if (Input::get('old_password') && Input::get('new_password') && Input::get('confirm_password')) {
            if (Hash::make(Input::get('old_password')) == $user->password) {
                $user->password = Hash::make(Input::get('new_password'));
            }
            else{
                $message= 'Password Not Changed! Incorrect Old password or Confirm Password doed not match with New Password';
            }
        }
        $user->user_type = 1;
        $user->update();
        return redirect()->route('user.myprofile.view');
    }

    public function myAccount() {
        return view(Config('constants.frontendView') . '.myaccount');
    }

    public function showUserSubscription() {
        return view(Config('constants.frontendView') . '.subscription');
    }

    public function chk_existing_username() {
        $getname = Input::get('username');
        // dd($getname);
        $chk = User::where("user_name", "=", $getname)->first();

        if (!empty($chk)) {
            echo "Invalid";
        } else {
            echo "valid";
        }
    }

    public function delete() {
        $user = User::find(Input::get('id'));
        $user->delete();
        return redirect()->back()->with("message", "User deleted successfully!");
    }

    public function saveSubscription() {
        $address = Address::findOrNew(Input::get('address_id'));
        $address->user_id = Auth::id();
        $address->address = Input::get('address');
        $address->city = Input::get('city');
        $address->pincode = Input::get('pincode');
        $address->save();
        $subscription = Subscription::findOrNew(Input::get('id'));
        $subscription->user_id = Auth::id();
        $subscription->timeslot_id = Input::get('timeslot_id');
        $subscription->frequency_id = Input::get('frequency_id');
        $subscription->package_id = Input::get('package_id');
        $subscription->occupancy_id = Input::get('occupancy_id');
        $subscription->max_waste = Input::get('max_waste');
        $subscription->start_date = Input::get('start_date');
        $subscription->end_date = Input::get('end_date');
        $subscription->approximate_processing_time = Input::get('approximate_processing_time');
        $subscription->weekly_quantity = Input::get('weekly_quantity');
        $subscription->user_address_id = $address->id;
        $subscription->remark = Input::get('remark');
        $subscription->save();
        $subscription->wastetypes()->sync(Input::get('wastetype'));
        return redirect()->route('user.myprofile.view');
    }
     
}
