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
        $record = Record::with(['rtype', 'addedBy', 'asset'])->paginate(Config('constants.paginateNo'));

        return view(Config('constants.adminRecordView') . '.index', compact('record'));
    }

    public function add() {
        $record = new Record();

        $rtypes = Recordtype::all()->toArray();
        $recordtypes = [];
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
        $vans = [0 => "Not Part of Any Asset"];
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
        $vans = [0 => "Not Part of Any Asset"];
        foreach ($v as $value) {
            $vans[$value['id']] = $value['name'] . " - " . $value['asset_no'];
        }


        $action = "admin.record.save";
        return view(Config('constants.adminRecordView') . '.addEdit', compact('record', 'action', 'recordtypes', 'vans', 'fueltypes'));
    }

    public function save() {
        $record = Record::findOrNew(Input::get('id'));
        $record->fill(Input::except('att'))->save();
        foreach (Input::file('att') as $key => $att) {
            if ($att) {
                $destinationPath = public_path() . '/uploads/records/';
                $fileName = time() . $key . '.' . $att->getClientOriginalExtension();
                if ($att->move($destinationPath, $fileName)) {
                    Attachment::create(['record_id' => $record->id, 'file' => $fileName, 'filename' => $att->getClientOriginalName(),  'is_active' => 1, "added_by" => Input::get("added_by")]);
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

}
