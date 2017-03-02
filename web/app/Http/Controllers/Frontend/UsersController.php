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
use App\Models\Configuration;
use App\Models\Contactus;
use App\Models\Subscription;
use App\Models\PickupSlot;
use App\Models\Service;
use App\Models\Payment;
use App\Models\GardenWaste;
use App\Models\GunnyOrder;
use App\Models\Message;
use App\Models\Gallery;
use Mail;

class UsersController extends Controller {

    public function login() {
        return view(Config('constants.frontendView') . '.login');
    }

    public function loginGarden() {
        return view(Config('constants.frontendView') . '.login_garden');
    }

    public function register() {
        $action = 'user.register.save';
        $city = City::where('name', '!=', 'Other')->where('is_active', 1)->where('garden_waste', 1)->get()->toArray();
        $cityother = City::where('name', 'Other')->where('is_active', 1)->get()->toArray();
        if ($cityother) {
            array_push($city, $cityother[0]);
        }
        $cities = ['' => 'Select City'];
        foreach ($city as $value) {
            $cities[$value['id']] = $value['name'];
        }
        return view(Config('constants.frontendView') . '.register', compact('action', 'cities'));
    }

    public function registerSave() {
        $chk = User::where("email", "=", Input::get('email'))->first();
        $city = City::where('id', Input::get('location'))->where('is_active', 1)->first()->toArray();
        if (empty($chk)) {
            if ($city['name'] == 'Other') {
                $result = $this->saveContact();
                if ($result) {
                    Session::flash('message', 'Thank you! We shall get in touch with you soon.');
                    return redirect()->route(Input::get('redirect_url'));
                } else {
                    Session::flash('messageError', 'Error Occured! Please try again!');
                    return redirect()->route(Input::get('redirect_url'));
                }
            } else {
                $user = new User();
                $user->name = Input::get('name');
                $user->email = Input::get('email');
                $user->phone_number = Input::get('phone_number');
                $user->password = Hash::make(Input::get('password'));
                $user->city_id = Input::get('location');
                $user->user_type = 1;
                $user->save();
                $user->roles()->sync([2]);
                $userD = ['email' => Input::get('email'),
                    'password' => Input::get('password')
                ];
                if (Auth::attempt($userD, true)) {
                    Session::put('loggedinUserId', $user->id);
                    return redirect()->route('garden.waste');
                } else {
                    return redirect()->route('user.register');
                }
            }
        } else {
            Session::flash("messageError", "Email already exist");
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

            if (!empty(Input::get('rurl')))
                return redirect()->route(Input::get('rurl'));
            else
                return redirect()->route('user.subscription.view');
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
        $city = City::where('name', '!=', 'Other')->where('is_active', 1)->get()->toArray();
        $cityother = City::where('name', 'Other')->where('is_active', 1)->get()->toArray();
        if ($cityother) {
            array_push($city, $cityother[0]);
        }
        $action = 'user.contact.save';
        return view(Config('constants.frontendView') . '.contact', compact('action', 'city'));
    }

    public function faq() {
        return view(Config('constants.frontendView') . '.faq');
    }

    public function gallery() {
        $images = Gallery::get()->toArray();
        return view(Config('constants.frontendView') . '.gallery', compact('images'));
    }

    public function about() {
        return view(Config('constants.frontendView') . '.about');
    }

    public function terms() {
        return view(Config('constants.frontendView') . '.terms');
    }

    public function privacy() {
        return view(Config('constants.frontendView') . '.privacy');
    }

    public function saveContact() {
        $city = City::where('id', Input::get('location'))->where('is_active', 1)->first()->toArray();
        $location_name = "";
        if ($city['name'] == 'Other') {
            if (Input::get('city_name')) {
                $location_name = Input::get('city_name');
            } else {
                $location_name = 'Other City';
            }
        } else {
            $location_name = $city['name'];
        }
        $postData = array(
            'title' => Input::get('name'),
            'person_id' => Input::get('name'),
            'f9717f095c375ebfc91312429b54821df8972fb3' => Input::get('email'),
            'f856d0351336a040cbe422113dbcf31736fa29a6' => Input::get('phone_number'),
            '57790cc8503d26fece54897eb9ed1ef7de4407a6' => 'Website Subscription',
            '0f564b10f66aa6eba1294de86c0ffcb670039947' => $location_name,
            'stage_id' => $city['inquiry_stage_id']
        );

        $ch = curl_init('https://api.pipedrive.com/v1/deals?api_token=' . Config('constants.pipedriveApiToken'));
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));
        $output = curl_exec($ch);
        $output = json_decode($output, true);
        if ($output['success'] == true) {
            $data = Input::all();
            $data['city'] = $location_name;
            Mail::send(Config('constants.adminEmail') . '.inquiryReceived', ['data' => $data], function ($message) {
                $message->to('getit@mobitrash.in');
//                $message->to(['nithika.sailesh@excelind.com','saurabh.shah@excelind.com']);
//                $message->to('sharad@infiniteit.biz');
                $message->subject('MobiTrash Inquiry Received');
            });
            Session::flash('contactSuccess', 'Thank you! We shall get in touch with you soon.');
        } else {
            Session::flash('contactError', 'Error Occured! Please try again!');
        }
        curl_close($ch);
        if (Input::get('redirect_url')) {
            if ($output['success'] == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return redirect()->route('user.contact.view');
        }
    }

    public function update() {

        $user = User::find(Input::get('id'));
        $user->name = Input::get('name');
        $user->phone_number = Input::get('phone_number');
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
//        Controller::pr($services);
        return view(Config('constants.frontendView') . '.myaccount', compact('user', 'services'));
    }

    public function paymentInfo() {
        $user = User::find(Auth::id());
        $payments = Payment::where('user_id', Auth::id())->get();
        return view(Config('constants.frontendView') . '.paymentinfo', compact('user', 'payments'));
    }

    public function showUserSubscription() {
        $subscription = Subscription::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->with('frequency', 'timeslot', 'user', 'wastetypes', 'occupancy')->first();
        $wastetypes = "";
        if (isset($subscription->wastetypes)) {
            foreach ($subscription->wastetypes as $waste) {
                $wastetypes .= $waste->name . ', ';
            }
        }
        $address;
        if ($subscription) {
            $address = Address::where("id", $subscription->user_address_id)->first();
        }
        $action = 'user.subscription.save';
        return view(Config('constants.frontendView') . '.subscription', compact('subscription', 'address', 'action', 'wastetypes'));
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

    public function gardenWaste() {
        $city = City::where('id', Auth::user()->city_id)->first();
        $pickups = PickupSlot::get()->toArray();
        $pickupslots = [];
        foreach ($pickups as $key => $pickup) {
            array_push($pickupslots, $pickup['pickup_date']);
        }
        $pickupslots = json_encode($pickupslots);
        $config = Configuration::first(['gunny_bag_price', 'garden_waste_pickup_price', 'max_gunny_bags'])->toArray();
        $gunny_bags = GunnyOrder::where('payment_made', 1)->where('user_id', Auth::user()->id)->sum('no_of_bags');
        $addresses = Address::where('flag', 1)->where('user_id', Auth::user()->id)->get()->toArray();
        $action = 'garden.waste.save';
        if ($gunny_bags > 0) {
            return view(Config('constants.frontendView') . '.garden_waste', compact('action', 'config', 'pickupslots', 'addresses', 'city'));
        } else {
            return redirect()->route('garden.waste.emptygunny');
        }
    }

    public function gardenWasteSave() {
        $config = Configuration::first(['gunny_bag_price', 'garden_waste_pickup_price', 'max_gunny_bags'])->toArray();
        if (Input::get('no_of_gunny') <= $config['max_gunny_bags']) {
            $garden_waste = new GardenWaste();
            $garden_waste->user_id = Input::get('user_id');
            $garden_waste->address_id = Input::get('pickup_address_id');
            $garden_waste->gunny_bags = Input::get('no_of_gunny');
            $garden_waste->amount = Input::get('no_of_gunny') * $config['garden_waste_pickup_price'];
            $garden_waste->payment_made = 0;
            $garden_waste->pickup_date = Input::get('date_of_pickup');
            $garden_waste->pickup_status = 'Request Received';
            $user = User::where('id', Auth::user()->id)->first()->toArray();
            $payment_for = 'garden_waste';
            $amount = Input::get('no_of_gunny') * $config['garden_waste_pickup_price'];
            if ($garden_waste->save()) {
                $id = base64_encode($garden_waste->id);
                return view(Config('constants.frontendView') . '.confirmpay', compact('id', 'user', 'amount', 'payment_for'));
            } else {
                Session::flash('messageError', 'Error Occured! Please try again!');
            }
        } else {
            Session::flash('messageError', 'Gunny bags exceeds maximum limit!');
        }
        return redirect()->back();
    }

    public function emptyGunny() {
        $city = City::where('id', Auth::user()->city_id)->first();
        $config = Configuration::first(['gunny_bag_price', 'garden_waste_pickup_price', 'max_gunny_bags'])->toArray();
        $action = 'garden.waste.savegunny';
        return view(Config('constants.frontendView') . '.empty_gunny', compact('action', 'config', 'city'));
    }

    public function saveGunny() {
        $config = Configuration::first(['gunny_bag_price', 'garden_waste_pickup_price', 'max_gunny_bags'])->toArray();
        if (Input::get('no_of_gunny') <= $config['max_gunny_bags']) {
            $address = new Address();
            $address->fill(Input::except('no_of_gunny'))->save();
            $gunny_order = new GunnyOrder();
            $gunny_order->user_id = Input::get('user_id');
            $gunny_order->address_id = $address->id;
            $gunny_order->no_of_bags = Input::get('no_of_gunny');
            $gunny_order->amount = $config['gunny_bag_price'] * Input::get('no_of_gunny');
            $gunny_order->payment_made = 1; // nopay
            $gunny_order->payment_date = date("Y-m-d"); // nopay
            $user = User::where('id', Auth::user()->id)->first()->toArray();
            $payment_for = 'gunny_bags';
//            $amount = $config['gunny_bag_price'] * Input::get('no_of_gunny'); // nopay
            $amount = 0; // nopay
            if ($gunny_order->save()) {
                $id = base64_encode($gunny_order->id);
                //////No pay mail here
                Mail::send(Config('constants.frontendEmail') . '.gunnyOrderConfirmation', ['user' => $user, 'no_of_bags'=>Input::get('no_of_gunny'), 'amount'=>$amount, 'address' => $address->toArray()], function ($message) use ($user) {
                    $message->to($user['email']);
                    $message->subject('Gunny Order Confirmation');
                });
                Mail::send(Config('constants.frontendEmail') . '.gunnyOrderReceived', ['user' => $user, 'no_of_bags'=>Input::get('no_of_gunny'), 'amount'=>$amount, 'address' => $address->toArray()], function ($message) {
                    $message->to('getit@mobitrash.in');
                    $message->subject('Gunny Order Received');
                });
                //////
                Session::flash('message', 'Empty Gunny bags drop request received successfully!'); // nopay
                return redirect()->route('gunny.order.success', ['success' => 1, 'id' => $gunny_order->id]); // nopay
//                return view(Config('constants.frontendView') . '.confirmpay', compact('id', 'user', 'amount', 'payment_for')); // nopay
            } else {
                Session::flash('messageError', 'Error Occured! Please try again!');
            }
        } else {
            Session::flash('messageError', 'Gunny bags exceeds maximum limit!');
        }
        return redirect()->back();
    }

    public function addressSave() {
        $address = new Address();
        $address->fill(Input::all());
        if ($address->save()) {
            $address_text = $address->address_line_1 . ' ' . $address->address_line_2 . ' ' . $address->locality . ' ' . $address->city . ' ' . $address->pincode;
            return ['flash' => 'success', 'address_id' => $address->id, 'address' => $address_text];
        } else {
            return ['flash' => 'error'];
        }
    }

    public function pickupHistory() {
        $pickups = GardenWaste::where('user_id', Auth::id())->where('payment_made', 1)->get();
        return view(Config('constants.frontendView') . '.pickuphistory', compact('pickups'));
    }

    public function pickupHistoryView($id) {
        $pickup = GardenWaste::where('user_id', Auth::id())->where('id', $id)->first();
        return view(Config('constants.frontendView') . '.pickuphistoryview', compact('pickup'));
    }

    public function userMessage() {
        $action = 'user.message.save';
        return view(Config('constants.frontendView') . '.messageus', compact('action'));
    }

    public function userMessageSave() {
        $message = new Message();
        $message->fill(Input::all());
        $user = User::where('id', Input::get('user_id'))->first()->toArray();
        $data = Input::all();
        if ($message->save()) {
            Session::flash('message', 'Thank You, for your feedback! Your message saved successfully!');
            Mail::send(Config('constants.adminEmail') . '.messageReceived', ['data' => $data, 'user' => $user], function ($message) use ($user) {
                $message->to('getit@mobitrash.in');
//                $message->to('sharad@infiniteit.biz');
                $message->replyTo($user['email'], $user['name']);
                $message->subject('Feedback Received');
            });
        } else {
            Session::flash('messageError', 'Error Occured! Please try again!');
        }
        return redirect()->back();
    }

}
