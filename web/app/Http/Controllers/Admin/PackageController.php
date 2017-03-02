<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Package;
use App\Http\Controllers\Controller;

class PackageController extends Controller {

    function index() {
        $package = Package::paginate(Config('constants.paginateNo'));
        return view(Config('constants.adminPackageView') . '.index', compact('package'));
    }

    public function add() {
        $package = new Package();
        $action = "admin.package.save";
        return view(Config('constants.adminPackageView') . '.addEdit', compact('package', 'action'));
    }

    public function edit() {
        $package = Package::find(Input::get('id'));
        $action = "admin.package.save";
        return view(Config('constants.adminPackageView') . '.addEdit', compact('package', 'action'));
    }

    public function save() {
        $package = Package::findOrNew(Input::get('id'))->fill(Input::all())->save();
        return redirect()->route('admin.package.view');
    }

    public function delete() {
        $package = Package::find(Input::get('id'));
        $package->delete();
        return redirect()->back()->with("message", "Package deleted successfully");
    }

}
