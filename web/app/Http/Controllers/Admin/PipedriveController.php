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
        $deals = file_get_contents('https://api.pipedrive.com/v1/pipelines/3/deals?filter_id=2&api_token=' . Config('constants.pipedriveApiToken'));
        $deals = json_decode($deals, true);
        $count = 0;
        if (isset($deals['data'])) {
            foreach ($deals['data'] as $key => $deal) {
                if (!$deal['f9717f095c375ebfc91312429b54821df8972fb3']) {
                    continue;
                } else {
                    $user = User::where('email', $deal['f9717f095c375ebfc91312429b54821df8972fb3'])->first();
                    if (!$user) {
                        $user = new User();
                        $user->name = $deal['person_name'];
                        $random = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                        $user->password = Hash::make($random);
                        $user->email = $deal['f9717f095c375ebfc91312429b54821df8972fb3'];
                        $user->phone_number = $deal['f856d0351336a040cbe422113dbcf31736fa29a6'];
                        $user->user_type = 1;
                        $user->save();
                        $user->roles()->sync([2]);
                    }
                    $address = Address::where('user_id', $user->id)->where('pipedrive_id', $deal['id'])->first();
                    if (!$address) {
                        $address = new Address();
                        $address->user_id = $user->id;
                        $address->pipedrive_id = $deal['id'];
                        $address->address = $deal['0f564b10f66aa6eba1294de86c0ffcb670039947'];
                        if ($address->address) {
                            $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . urlencode($address->address) . '&sensor=false');
                            $geocode = json_decode($geocode);
                            if ($geocode->results) {
                                $address->latitude = $geocode->results[0]->geometry->location->lat;
                                $address->longitude = $geocode->results[0]->geometry->location->lng;
                            }
                        }
                        $address->pincode = $deal['0f564b10f66aa6eba1294de86c0ffcb670039947_postal_code'];
                        $address->save();

                        $subscription = new Subscription();
                        $subscription->name = $deal['title'];
                        $subscription->user_id = $user->id;
                        $subscription->user_address_id = $address->id;
                        $subscription->prefered_timeslot = $deal['3b42df7b2b72ff332057b8d4de9188cf796cb5f5'] . ' - ' . $deal['3b42df7b2b72ff332057b8d4de9188cf796cb5f5_until'];
                        if ($deal['value']) {
                            $subscription->billing_method = 1;
                            $subscription->amt_paid = $deal['value'];
                        }
                        $subscription->return_of_compost = 0;
                        $subscription->occupancy_id = $deal['48fdb5f9798aa624c6b3bdcd322edd091757a28f'];
                        $wastetype_id = array(9 => 1, 10 => 2, 11 => 3);
                        if ($deal['cd9bd35d3a76ea6c6dce0703a962081eba45f727']) {
                            $subscription->wastetype_id = $wastetype_id[$deal['cd9bd35d3a76ea6c6dce0703a962081eba45f727']];
                        }
                        $subscription->max_waste = $deal['2409d0d57ae03b6dad63635eb89b31b531ca9cc0'];
                        $subscription->onfield_person_name = $deal['person_name'];
                        $subscription->onfield_person_contact_number = $deal['f856d0351336a040cbe422113dbcf31736fa29a6'];
                        $subscription->remark = $deal['2a033409ddd60999280fa4c8b4ff539a8758f926'];
                        $subscription->added_by = Auth::id();
                        $subscription->save();
                        $count++;
                    }
                }
            }
            if ($count > 0) {
                Session::flash('message', "Subscriptions Imported Successfully! Missing Data for fields in customers and subscriptions required to be filled manually!");
            } else {
                Session::flash('messageError', "No new data found to Import");
            }
        } else {
            Session::flash('messageError', "No new data found to Import");
        }
        return redirect()->back();
    }

}
