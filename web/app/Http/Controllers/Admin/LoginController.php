<?php

namespace App\Http\Controllers\Admin;

use Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Payment;
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
                    $query->where('invoice_month', date('Y-m', strtotime(date('Y-m')." -1 month")));
                    $query->where('payment_made', 0);
                })->count();
        return view(Config('constants.adminView') . '.dashboard', compact(['subscription', 'pending_payment']));
    }

    public function unauthorized() {

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
            return redirect()->route('adminLogin');
        }
    }

    public function admin_logout() {
        Auth::logout();
        Session::flush();
        return redirect()->route('adminLogin');
    }

}
