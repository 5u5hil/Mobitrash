<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Record;
use App\Models\Recordtype;
use App\Models\Fueltype;
use App\Models\Asset;
use App\Models\Attachment;
use App\Http\Controllers\Controller;

class RecordController extends Controller {

    function index() {

        $rtypes = Recordtype::where("is_active", 1)->get()->toArray();
        $recordtypes = [];
        $recordtypes = [0 => "Select Record Type"];
        foreach ($rtypes as $value) {
            $recordtypes[$value['id']] = $value['name'];
        }
        $v = Asset::where("is_active", 1)->get()->toArray();
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }
        $filter = array('' => 'All', 'recordtype_id' => 'Record Type', 'asset_id' => 'Record For', 'date' => 'Receipt Date');
        
        $filter_type = NULL;
        $record_type = NULL;
        $assets_type = NULL;
        $filter_value = NULL;
        $filter_date = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'date') {
                $filter_date = Input::get('filter_value');
            } else if ($filter_type == 'recordtype_id') {
                $record_type = Input::get('filter_value');
            } else if ($filter_type == 'asset_id') {
                $assets_type = Input::get('filter_value');
            }
            $record = Record::where(Input::get('filter_type'), Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
        } else {
            $record = Record::with(['rtype', 'addedBy', 'asset'])->paginate(Config('constants.paginateNo'));
        }

        return view(Config('constants.adminRecordView') . '.index', compact('record', 'filter', 'recordtypes', 'vans', 'filter_type', 'filter_value', 'record_type', 'assets_type', 'filter_date'));
    }

    public function add() {
        $record = new Record();

        $rtypes = Recordtype::where("is_active", 1)->get()->toArray();
        $recordtypes = [];
        $recordtypes = [0 => "Select Record Type"];
        foreach ($rtypes as $value) {
            $recordtypes[$value['id']] = $value['name'];
        }

        $fuel_types = Fueltype::all()->toArray();
        $fueltypes = [];
        $fueltypes = ["" => "Select Fuel Type"];
        foreach ($fuel_types as $value) {
            $fueltypes[$value['id']] = $value['name'];
        }

        $v = Asset::where("is_active", 1)->get()->toArray();
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }

        $action = "admin.record.save";
        return view(Config('constants.adminRecordView') . '.addEdit', compact('record', 'recordtypes', 'vans', 'action', 'fueltypes'));
    }

    public function edit() {
        $record = Record::find(Input::get('id'));

        $rtypes = Recordtype::all()->toArray();
        $recordtypes = [];
        $recordtypes = [0 => "Select Record Type"];
        foreach ($rtypes as $value) {
            $recordtypes[$value['id']] = $value['name'];
        }

        $fuel_types = Fueltype::all()->toArray();
        $fueltypes = [];
        $fueltypes = ["" => "Please Select"];
        foreach ($fuel_types as $value) {
            $fueltypes[$value['id']] = $value['name'];
        }

        $v = Asset::where("is_active", 1)->get()->toArray();
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }


        $action = "admin.record.save";
        return view(Config('constants.adminRecordView') . '.addEdit', compact('record', 'action', 'recordtypes', 'vans', 'fueltypes'));
    }

    public function show() {
        $record = Record::find(Input::get('id'));
        $atts = $record->atts()->get();
        return view(Config('constants.adminRecordView') . '.show', compact('record', 'atts'));
    }

    public function save() {
        $record = Record::findOrNew(Input::get('id'));
        $record->fill(Input::except('att'))->save();
        foreach (Input::file('att') as $key => $att) {
            if ($att) {
                $destinationPath = public_path() . '/uploads/records/';
                $fileName = time() . $key . '.' . $att->getClientOriginalExtension();
                if ($att->move($destinationPath, $fileName)) {
                    Attachment::create(['record_id' => $record->id, 'file' => $fileName, 'filename' => $att->getClientOriginalName(), 'is_active' => 1, "added_by" => Input::get("added_by")]);
                }
            }
        }
        return redirect()->route('admin.record.view');
    }

    public function delete() {
        $record = Record::find(Input::get('id'));
        $record->delete();
        return redirect()->back()->with("message", "Record deleted sucessfully");
    }

    public function rmfile() {
        $atta = Attachment::find(Input::get('id'));
        $atta->is_active = '0';
        $atta->save();
        return redirect()->back()->with("message", "Attachment Removed sucessfully");
        exit();
    }

}
