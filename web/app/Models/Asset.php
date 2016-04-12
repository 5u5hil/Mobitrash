<?php

namespace App\Models;

class Asset extends \Eloquent {

    public $timestamps = false;
    protected $guarded = [];

    public function city() {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function type() {
        return $this->belongsTo('App\Models\AssetType', 'type_id');
    }

    public function addedBy() {
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function partOf() {
        return $this->belongsTo('App\Models\Asset', 'parent_id');
    }

}
