<?php

namespace App\Http\Controllers\Admin;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use App\Models\Asset;
use App\Models\Subscription;
use App\Models\Service;
use App\Models\Payment;
use App\Models\Wastetype;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Session;

class LoginController extends Controller {

    public function index() {

        return view(Config('constants.adminView') . '.login');
    }

    public function dashboard() {
        $current_week_start = Date('Y-m-d', strtotime('previous monday'));
        $current_week_end = Date('Y-m-d', strtotime('next sunday'));
        $last_week_start = Date('Y-m-d', strtotime($current_week_start . ' -7 day'));
        $last_week_end = Date('Y-m-d', strtotime($current_week_end . ' -7 day'));
        $current_month['start'] = Date('Y-m-01');
        $current_month['end'] = Date('Y-m-t');
        $last_month['start'] = date('Y-m-d', strtotime('first day of last month'));
        $last_month['end'] = date('Y-m-d', strtotime('last day of last month'));
        $subscription['current_week'] = Subscription::where('start_date', '>=', $current_week_start)->where('start_date', '<=', $current_week_end)->count();
        $subscription['last_week'] = Subscription::where('start_date', '>=', $last_week_start)->where('start_date', '<=', $last_week_end)->count();
        $subscription['current_month'] = Subscription::where('start_date', '>=', $current_month['start'])->where('start_date', '<=', $current_month['end'])->count();
        $pending_payment['current_month'] = Payment::where(function($query)use ($current_month) {
                    $query->where('invoice_date', '>=', $current_month['start']);
                    $query->where('invoice_date', '<=', $current_month['end']);
                    $query->where('payment_made', 0);
                })->orWhere(function($query) {
                    $query->where('invoice_month', Date('Y-m'));
                    $query->where('payment_made', 0);
                })->count();
        $pending_payment['last_month'] = Payment::where(function($query)use ($last_month) {
                    $query->where('invoice_date', '>=', $last_month['start']);
                    $query->where('invoice_date', '<=', $last_month['end']);
                    $query->where('payment_made', 0);
                })->orWhere(function($query) {
                    $query->where('invoice_month', date('Y-m', strtotime(date('Y-m') . " -1 month")));
                    $query->where('payment_made', 0);
                })->count();

        $vans = Asset::where("is_active", 1)->where("type_id", 1)->with('schedules')->get()->toArray();
        $services = Service::where('created_at', 'LIKE', "%" . date('Y-m-d') . "%")->get(['pickup_id']);
        $pickupids = array(); //        
        foreach ($services as $service) {
            array_push($pickupids, $service->pickup_id);
        }
        foreach ($vans as $key => $van) {
            if (isset($van['schedules'][0])) {
                foreach ($van['schedules'][0]['pickups'] as $pkey => $pickup) {
                    if (in_array($pickup['id'], $pickupids)) {
                        $vans[$key]['schedules'][0]['pickups'][$pkey]['isPicked'] = true;
                    } else {
                        $vans[$key]['schedules'][0]['pickups'][$pkey]['isPicked'] = false;
                    }
                }
            }
        }
        $monthly_sub_amt = Payment::where('billing_method', 1)->where('invoice_month', date('Y-m'))->sum('invoice_amount');
        $wastes = array();
        $totalwastes = Service::where('created_at', 'LIKE', date('Y-m-d') . "%")->with('wastetypes')->get()->toArray();
        
        foreach ($totalwastes as $totalwaste) {
            foreach ($totalwaste['wastetypes'] as $key => $wastetype) {
                $wastes[$wastetype['id']]['id'] = $wastetype['id'];
                $wastes[$wastetype['id']]['name'] = $wastetype['name'];
                if (isset($wastes[$wastetype['id']]['total_quantity'])) {
                    $wastes[$wastetype['id']]['total_quantity'] += $wastetype['pivot']['quantity'];
                } else {
                    $wastes[$wastetype['id']]['total_quantity'] = $wastetype['pivot']['quantity'];
                }
            }
        }

        $additives = array();
        $totaladditives = Service::where('created_at', 'LIKE', date('Y-m-d') . "%")->with('additives')->get()->toArray();

        foreach ($totaladditives as $totaladditive) {
            foreach ($totaladditive['additives'] as $key => $additive) {
                $additives[$additive['id']]['id'] = $additive['id'];
                $additives[$additive['id']]['name'] = $additive['name'];
                if (isset($additives[$additive['id']]['total_quantity'])) {
                    $additives[$additive['id']]['total_quantity'] += $additive['pivot']['quantity'];
                } else {
                    $additives[$additive['id']]['total_quantity'] = $additive['pivot']['quantity'];
                }
            }
        }
        
        $pia_colors = ['#F15854', '#5DA5DA', '#60BD68', '#FAA43A', '#F17CB0', '#B2912F', '#B276B2', '#DECF3F', '#00FF66', '#5668E2', '#3B3178', '#3B5323'];
        $cnt = 0;
        foreach ($wastes as $key => $waste) {
            $wastes[$key]['color'] = $pia_colors[$cnt];
            $cnt++;
        }
        $cnt = 0;
        foreach ($additives as $key => $additive) {
            $additives[$key]['color'] = $pia_colors[$cnt];
            $cnt++;
        }

//        Controller::pr($wastes);

        return view(Config('constants.adminView') . '.dashboard', compact(['subscription', 'pending_payment', 'vans', 'monthly_sub_amt', 'wastes', 'additives']));
    }

    public function unauthorised() {

        return view(Config('constants.adminView') . '.unauthorized');
    }

    public function chk_admin_user() {
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

            return redirect()->route('admin.dashboard');
        } else {

            Session::flash('invalidUser', 'Invalid Username or Password');
            return redirect()->route('user.unauthorised');
        }
    }

    public function admin_logout() {
        Auth::logout();
        Session::flush();
        return redirect()->route('adminLogin');
    }

}
