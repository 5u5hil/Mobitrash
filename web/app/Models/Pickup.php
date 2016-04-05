<?php

namespace App\Models;

class Pickup extends \Eloquent {

    protected $table = "pickups";
    protected $guarded = [];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function schedule() {
        return $this->belongsTo('App\Models\User', 'schedule');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address', 'user_address_id');
    }

}
