<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Address;
use Session;
use App\Http\Controllers\Controller;
use Hash;
use Auth;

class PipedriveController extends Controller {

    public function getAll() {
        $deals = file_get_contents('https://api.pipedrive.com/v1/deals?api_token=' . Config('constants.pipedriveApiToken') . '&filter_id=16');
        $deals = json_decode($deals, true);
        $count = 0;
        if (isset($deals['data'])) {
            foreach ($deals['data'] as $key => $deal) {
                $user = User::where('email', $deal['cc92372cd36ce0b84471f039d33f25abae52ea31'])->first();
                if (!$user) {
                    $user = new User();
                    $user->name = $deal['person_name'];
                    $random = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                    $user->password = Hash::make($random);
                    $user->email = $deal['cc92372cd36ce0b84471f039d33f25abae52ea31'];
                    $user->phone_number = $deal['e4d30c50d6fb077889c33d141299bae39f63b9f7'];
                    $user->user_type = 1;
                    $user->save();
                    $user->roles()->sync([2]);
                }
                $address = Address::where('user_id', $user->id)->where('pipedrive_id', $deal['id'])->first();
                if (!$address) {
                    $address = new Address();
                    $address->user_id = $user->id;
                    $address->pipedrive_id = $deal['id'];
                    $address->address = $deal['bca62ef549323c41b73434c332caba3ed6dc2912'];
                    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . urlencode($address->address) . '&sensor=false');
                    if ($geocode) {
                        $geocode = json_decode($geocode);
                        $address->latitude = $geocode->results[0]->geometry->location->lat;
                        $address->longitude = $geocode->results[0]->geometry->location->lng;
                    }
                    $address->city = 1;
                    $address->pincode = $deal['bca62ef549323c41b73434c332caba3ed6dc2912_postal_code'];
                    $address->save();

                    $subscription = new Subscription();
                    $subscription->name = $deal['title'];
                    $subscription->user_id = $user->id;
                    $subscription->user_address_id = $address->id;
                    $subscription->prefered_timeslot = $deal['e1056138c7533df19805bb0a74277ff6aa5bcca3'] . ' - ' . $deal['e1056138c7533df19805bb0a74277ff6aa5bcca3_until'];
                    $subscription->amt_paid = $deal['value'];
                    $subscription->occupancy_id = $deal['ac59cf3932b79c2fe2917257dcbdec8a4a359027'];
                    $wastetype_id = array(9 => 1, 10 => 2, 11 => 3);
                    $subscription->wastetype_id = $wastetype_id[$deal['e41a77f535537a9f9b1042639180870b127b30fa']];
                    $subscription->max_waste = $deal['24b3eed8d4f223f3626267be9a5407883ed0fcf0'];
                    $subscription->onfield_person_name = $deal['person_name'];
                    $subscription->onfield_person_contact_number = $deal['e4d30c50d6fb077889c33d141299bae39f63b9f7'];
                    $subscription->remark = $deal['42487678785cd65cddb7d01eb25440a0b02728f4'];
                    $subscription->added_by = Auth::id();
                    $subscription->save();
                    $count++;
                }
            }
            if($count > 0) {
                Session::flash('message', $count+" Subscriptions Imported Successfully!");
            } else {
                Session::flash('messageError', "No data found to Import");
            }
        } else {
            Session::flash('messageError', "No data found to Import");
        }
        return redirect()->back();
    }

}
