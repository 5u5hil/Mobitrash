<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Address;
use App\Models\City;
use Session;
use App\Http\Controllers\Controller;
use Hash;
use Auth;

class PipedriveController extends Controller {

    public function getAll() {
        $cities = City::where('is_active', 1)->get();
        $flashMessage = "";
        $usercount = 0;
        $updatecount = 0;
        $count = 0;
        foreach ($cities as $key => $city) {

            if ($city->pipeline_id) {
                $deals = file_get_contents('https://api.pipedrive.com/v1/pipelines/' . $city->pipeline_id . '/deals?filter_id=2&api_token=' . Config('constants.pipedriveApiToken'));
                $deals = json_decode($deals, true);

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
                                $user->user_type = 2;
                                $user->save();
                                $user->roles()->sync([2]);
                                $usercount++;
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
                            }
                            $subscription = Subscription::where('name', $deal['title'])->first();
                            if (!$subscription) {
                                $subscription = new Subscription();
                                $subscription->name = $deal['title'];
                                $subscription->user_id = $user->id;
                                $subscription->user_address_id = $address->id;
                                $subscription->city_id = $city->id;
                                $subscription->prefered_timeslot = $deal['3b42df7b2b72ff332057b8d4de9188cf796cb5f5'] . ' - ' . $deal['3b42df7b2b72ff332057b8d4de9188cf796cb5f5_until'];
                                if ($deal['value']) {
                                    $subscription->billing_method = 1;
                                    $subscription->amt_paid = $deal['value'];
                                }
                                $subscription->return_of_compost = 0;
                                $occupancy_id = array(13 => 1, 14 => 3, 15 => 2, 16 => 6, 17 => 5, 18 => 7, 19 => 8,);
                                if ($deal['48fdb5f9798aa624c6b3bdcd322edd091757a28f']) {
                                    $subscription->occupancy_id = $occupancy_id[$deal['48fdb5f9798aa624c6b3bdcd322edd091757a28f']];
                                }
                                $wastetype_id = array(20 => 1, 21 => 2, 22 => 3);
                                if ($deal['1c4a26787973f885f4c7f68f852c34cd8191486d']) {
                                    $west_ids = explode(',', $deal['1c4a26787973f885f4c7f68f852c34cd8191486d']);
                                    $watetype_category = array();
                                    foreach ($west_ids as $west_id) {
                                        array_push($watetype_category, $wastetype_id[$west_id]);
                                    }
                                    if ($subscription->id) {
                                        $subscription->wastetypes()->sync($watetype_category);
                                    }
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
                }
            }
        }
        if ($usercount > 0) {
            $flashMessage = "Users Imported Successfully. ";
        }
        if ($updatecount > 0) {
            $flashMessage = $updatecount . " Subscriptions Updated Successfully. ";
        }
        if ($count > 0) {
            $flashMessage .= "Subscriptions Imported Successfully! Missing Data for fields in customers and subscriptions required to be filled manually!";
        } else {
            $flashMessage .= "No Subscription data found";
        }
        Session::flash('message', $flashMessage);

        return redirect()->back();
    }

    public function getTrial() {
        $cities = City::where('is_active', 1)->get();
        $flashMessage = "";
        $usercount = 0;
        $count = 0;
        foreach ($cities as $key => $city) {

            if ($city->stage_id) {
                $deals = file_get_contents('https://api.pipedrive.com/v1/stages/'.$city->stage_id.'/deals?filter_id=1&api_token=' . Config('constants.pipedriveApiToken'));
                $deals = json_decode($deals, true);
                if (isset($deals['data'])) {
                    foreach ($deals['data'] as $key => $deal) {
                        if ($deal['f9717f095c375ebfc91312429b54821df8972fb3']) {

                            $user = User::where('email', $deal['f9717f095c375ebfc91312429b54821df8972fb3'])->first();
                            if (!$user) {
                                $user = new User();
                                $user->name = $deal['person_name'];
                                $random = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
                                $user->password = Hash::make($random);
                                $user->email = $deal['f9717f095c375ebfc91312429b54821df8972fb3'];
                                $user->phone_number = $deal['f856d0351336a040cbe422113dbcf31736fa29a6'];
                                $user->user_type = 2;
                                $user->save();
                                $user->roles()->sync([2]);
                                $usercount++;
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
                            }

                            $subscription = Subscription::where('name', $deal['title'])->first();
                            if (!$subscription) {
                                $subscription = new Subscription();
                                $subscription->name = $deal['title'];
                                $subscription->user_id = $user->id;
                                $subscription->is_trial = 1;
                                $subscription->user_address_id = $address->id;
                                $subscription->city_id = $city->id;
                                $subscription->prefered_timeslot = $deal['3b42df7b2b72ff332057b8d4de9188cf796cb5f5'] . ' - ' . $deal['3b42df7b2b72ff332057b8d4de9188cf796cb5f5_until'];
                                if ($deal['value']) {
                                    $subscription->billing_method = 1;
                                    $subscription->amt_paid = $deal['value'];
                                }
                                $subscription->return_of_compost = 0;
                                $occupancy_id = array(13 => 1, 14 => 3, 15 => 2, 16 => 6, 17 => 5, 18 => 7, 19 => 8,);
                                if ($deal['48fdb5f9798aa624c6b3bdcd322edd091757a28f']) {
                                    $subscription->occupancy_id = $occupancy_id[$deal['48fdb5f9798aa624c6b3bdcd322edd091757a28f']];
                                }
                                $wastetype_id = array(20 => 1, 21 => 2, 22 => 3);
                                if ($deal['1c4a26787973f885f4c7f68f852c34cd8191486d']) {
                                    $west_ids = explode(',', $deal['1c4a26787973f885f4c7f68f852c34cd8191486d']);
                                    $watetype_category = array();
                                    foreach ($west_ids as $west_id) {
                                        array_push($watetype_category, $wastetype_id[$west_id]);
                                    }
                                    if ($subscription->id) {
                                        $subscription->wastetypes()->sync($watetype_category);
                                    }
                                }
                                $subscription->max_waste = $deal['2409d0d57ae03b6dad63635eb89b31b531ca9cc0'];
                                $subscription->onfield_person_name = $deal['person_name'];
                                $subscription->onfield_person_contact_number = $deal['f856d0351336a040cbe422113dbcf31736fa29a6'];
                                $subscription->remark = $deal['2a033409ddd60999280fa4c8b4ff539a8758f926'];
                                $subscription->added_by = Auth::id();
                                $subscription->save();
                                $count++;
                            }
                        } else {
                            continue;
                        }
                    }
                }
            }
        }
        if ($usercount > 0) {
            $flashMessage = "Users Imported Successfully. ";
        }
        if ($count > 0) {
            $flashMessage .= "Trial Subscriptions Imported Successfully! Missing Data for fields in customers and subscriptions required to be filled manually!";
        } else {
            $flashMessage .= "No Subscription data found";
        }
        Session::flash('message', $flashMessage);
        return redirect()->back();
    }
    
    public function getStage($id){
        $stages = file_get_contents('https://api.pipedrive.com/v1/stages?pipeline_id='.$id.'&api_token=' . Config('constants.pipedriveApiToken'));
        $stages = json_decode($stages, true);
        return array('flash'=>'success', 'stages'=>$stages['data']);
    }
    public function getStages(){
        $stages = file_get_contents('https://api.pipedrive.com/v1/stages?pipeline_id='.Input::get('id').'&api_token=' . Config('constants.pipedriveApiToken'));
        $stages = json_decode($stages, true);
        return array('flash'=>'success', 'stages'=>$stages['data']);
    }
    public function getPipelines(){
        $pipes = file_get_contents('https://api.pipedrive.com/v1/pipelines?api_token=' . Config('constants.pipedriveApiToken'));
        $pipes = json_decode($pipes, true);
        return $pipes;
    }

}
