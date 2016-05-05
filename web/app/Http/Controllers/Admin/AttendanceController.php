<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Attendance;
use App\Models\User;
use Auth;
use Session;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller {

    function index() {
        $filter = array('' => 'All', 'name' => 'Schedule Name', 'for' => 'Schedule Date', 'van_id' => 'Van');
        $filter_type = NULL;
        $filter_value = NULL;
        $attendances = Attendance::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminAttendanceView') . '.index', compact('attendances', 'filter', 'filter_type', 'filter_value'));
    }

    public function add() {
        $attendance = new Attendance();
        
        $action = "admin.attendance.save";
        return view(Config('constants.adminAttendanceView') . '.add', compact('attendance', 'action', 'subscription'));
    }

    public function delete() {
        $attendance = Attendance::find(Input::get('id'));
        $attendance->delete();
        return redirect()->back()->with("message", "Attendance deleted sucessfully");
    }

}
