<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\User;
use Session;
use App\Http\Controllers\Controller;

class PipedriveController extends Controller {

    //api key 0fbf69c98241b4dcc270bba263269c2fd6950f25
    public function getAll() {
        //filter 16-today subscription
        $deals = file_get_contents('https://api.pipedrive.com/v1/deals/3?api_token=' . Config('constants.pipedriveApiToken') . '&filter_id=16');
        $deals = json_decode($deals);
        Controller::pr($deals);
        if ($deals) {
            foreach ($deals->data as $key => $deal) {
                $user = new User();
                $user->name = $deal->person_id->name;
                $user->email = $deal->person_id->email[0]->value;
                $user->phone_number = $deal->person_id->phone[0]->value;
                $user->save();
                $user->roles()->sync([2]);
                $address = new Address();
                $address->user_id = $user->id;
                $address->address = $deal->org_id->address;
                $address->latitude = '19.184753';
                $address->longitude = '72.978853';
                $address->city = 1;
                $address->save();
                Controller::pr($user);
            }
        }
    }

}
