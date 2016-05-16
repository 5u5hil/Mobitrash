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
        $filter = array('' => 'All', 'user_id' => 'Operator Id', 'date' => 'Date');        
        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'user_id') {
                $field1 = Input::get('filter_value');
                $attendances = Attendance::where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'date') {
                $field2 = Input::get('filter_value');
                $attendances = Attendance::where(Input::get('filter_type'), date("Y-m-d", strtotime(Input::get('filter_value'))))->paginate(Config('constants.paginateNo'));
            }            
        } else {
            $attendances = Attendance::paginate(Config('constants.paginateNo'));
        }
        
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
        return redirect()->back()->with("message", "Attendance deleted sucessfully");
    }

}
