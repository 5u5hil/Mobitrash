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
use App\Models\Contactus;
use App\Models\Subscription;
use App\Models\Service;
use Mail;

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

    public function forgotPassword() {
        return view(Config('constants.frontendView') . '.forgot');
    }

    public function updateForgotPassword() {
        $user = User::where("email", "=", Input::get("email"))->first();
        $random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 35); //time(); //substr(str_shuffle(time().time()), 0, 20);
        if ($user) {
            $user->varification_code = $random;
            $user->update();
            $user->var_code_enc = base64_encode($random);
            Mail::send(Config('constants.frontendEmail') . '.forgot', ['user' => $user], function ($message) {
                $message->to(Input::get("email"));
                $message->subject('Password Reset');
            });
            return ['flash' => 'success'];
        } else {
            return ['flash' => 'invalidEmail'];
        }
    }

    public function passwordReset() {
        $user = User::where("varification_code", "=", base64_decode(Input::get("id")))->first();
        return view(Config('constants.frontendView') . '.reset', compact('user'));
    }

    public function passwordUpdate() {
        $user = User::where("varification_code", "=", base64_decode(Input::get("var_code")))->first();
        if (Input::get('new_password') && Input::get('confirm_password')) {
            if ((Input::get('new_password')) == Input::get('confirm_password')) {
                $user->password = Hash::make(Input::get('new_password'));
                $user->varification_code = NULL;
                $user->update();
                Session::flash('PasswordSuccess', 'Password Reset successful!');
                return redirect()->route('user.login');
            } else {
                Session::flash('PasswordError', 'Password not changed: Confirmed Password does not match');
                return redirect()->back();
            }
        } else {
            return redirect()->route('user.forgot.password');
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

    public function password() {
        $user = User::find(Auth::id());
        $action = 'user.password.change';
        return view(Config('constants.frontendView') . '.password', compact('user', 'action'));
    }
    
    public function contact() {
        $action = 'user.contact.save';
        return view(Config('constants.frontendView') . '.contact', compact('action'));
    }
    
    public function saveContact() {
        $contact_us = new Contactus();
        $contact_us->fill(Input::all())->save();
        Session::flash('contactSuccess', 'Details saved successfully!');
        return redirect()->route('user.contact.view');
    }

    public function update() {

        $user = User::find(Input::get('id'));
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->phone_number = Input::get('phone_number');
        $user->email = Input::get('email');
        $user->user_type = 1;
        $user->update();
        Session::flash('profileSuccess', 'Profile Updated successfully!');
        return redirect()->route('user.myprofile.view');
    }

    public function changePassword() {

        $user = User::find(Input::get('id'));
        
        if (Input::get('old_password') && Input::get('new_password') && Input::get('confirm_password')) {
            $check = Hash::check(Input::get('old_password'), $user->password);
            if ($check == true) {
                if ((Input::get('new_password')) == Input::get('confirm_password')) {
                    $user->password = Hash::make(Input::get('new_password'));
                    $user->update();
                    Session::flash('profileSuccess', 'Password updated successfully!');
                } else {
                    Session::flash('ProfileError', 'Password not changed: Confirmed Password does not match');
                }
            } else {
                Session::flash('ProfileError', 'Password not changed: Incorrect Old Password');
            }
        }
        return redirect()->route('user.mypassword.view');
    }

    public function serviceSummary() {
        $user = User::find(Auth::id());
        $services = Service::where('user_id', Auth::id())->get();
        //Controller::pr($services);
        return view(Config('constants.frontendView') . '.myaccount', compact('user', 'services'));
    }

    public function showUserSubscription() {
        $subscription = Subscription::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->with('frequency', 'timeslot', 'user', 'wastetypes', 'occupancy')->first();
        $address;$cities;
        if($subscription){
        $address = Address::where("id", $subscription->user_address_id)->first();
        $cities = City::where("id", $address->city)->first()->toArray();
        }
        $action = 'user.subscription.save';
        return view(Config('constants.frontendView') . '.subscription', compact('subscription', 'address', 'cities', 'action'));
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
        $subscription->wastetype_id = Input::get('wastetype_id');
        $subscription->max_waste = Input::get('max_waste');
        $subscription->start_date = Input::get('start_date');
        $subscription->end_date = Input::get('end_date');
        $subscription->approximate_processing_time = Input::get('approximate_processing_time');
        $subscription->weekly_quantity = Input::get('weekly_quantity');
        $subscription->user_address_id = $address->id;
        $subscription->remark = Input::get('remark');
        $subscription->save();
        return redirect()->route('user.myprofile.view');
    }

}
