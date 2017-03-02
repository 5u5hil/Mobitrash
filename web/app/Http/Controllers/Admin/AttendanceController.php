<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Attendance;
use App\Models\User;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Request;

class AttendanceController extends Controller {

    function index() {        
        $attendances = Attendance::orderBy("created_at","desc");
            if (Input::get('staff_id')) {
                $attendances = $attendances->where('user_id', Input::get('staff_id'));                
            } 
            if (Input::get('start_date') && Input::get('end_date')) {
                $attendances = $attendances->whereBetween('date', [date("Y-m-d", strtotime(Input::get('start_date'))),date("Y-m-d", strtotime(Input::get('end_date')))]);                
            }else if (Input::get('start_date')) {
                $attendances = $attendances->where('date', '>=', date("Y-m-d", strtotime(Input::get('start_date'))));
            }else if (Input::get('end_date')) {
                $attendances = $attendances->where('date', '<=' , date("Y-m-d", strtotime(Input::get('end_date'))));
            } 
        $attendances = $attendances->paginate(100);
        Session::put('backUrl', Request::fullUrl());
        return view(Config('constants.adminAttendanceView') . '.index', compact('attendances', 'filter', 'filter_type', 'filter_value', 'field1', 'field2'));
    }

    public function add() {
        $attendance = new Attendance();
        
        $action = "admin.attendance.save";
        return view(Config('constants.adminAttendanceView') . '.add', compact('attendance', 'action', 'subscription'));
    }

    public function delete() {
        $attendance = Attendance::find(Input::get('id'));
        $attendance->delete();
        return redirect()->back()->with("message", "Attendance deleted successfully");
    }

}
