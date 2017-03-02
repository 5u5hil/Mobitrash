<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Gallery;
use Auth;
use Session;
use App\Http\Controllers\Controller;
use Request;

class GalleryController extends Controller {

    function index() {        
        $images = Gallery::orderBy("created_at","desc")->paginate(Config('constants.paginateNo'));            
        Session::put('backUrl', Request::fullUrl());
        return view(Config('constants.adminGalleryView') . '.index', compact('images'));
    }

    public function save() { 
        
        if (Input::file('image')) {
            $att = Input::file('image');
                $destinationPath = public_path() . '/uploads/gallery/';
                $fileName = time(). '.' . $att->getClientOriginalExtension();
                if ($att->move($destinationPath, $fileName)) {
                    Gallery::create(['name'=> $att->getClientOriginalName(),'image' => $fileName]);
                    return redirect()->route('admin.gallery.view')->with("message", "Image uploaded successfully");
                }
            }
        return redirect()->route('admin.gallery.view')->with("messageError", "Error occured! Please try again");
    }

    public function delete() {
        $gallery = Gallery::find(Input::get('id'));
        $gallery->delete();
        return redirect()->back()->with("message", "Image deleted successfully");
    }

}
