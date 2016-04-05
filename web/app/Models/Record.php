<?php

namespace App\Models;

class Record extends \Eloquent {

    protected $table = "records";
    protected $guarded = [];

    public function addedBy() {
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function asset() {
        return $this->belongsTo('App\Models\Asset', 'asset_id');
    }

    public function rtype() {
        return $this->belongsTo('App\Models\Recordtype', 'recordtype_id');
    }

    public function atts() {
        return $this->hasMany('App\Models\Attachment', 'record_id');
    }
    
    public function fueltypes() {
        return $this->belongsTo('App\Models\Fueltype', 'fueltype_id');
    }

}
