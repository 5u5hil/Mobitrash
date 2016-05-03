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
        return $this->belongsTo('App\Models\Schedule', 'schedule_id');
    }
    
    public function subscription() {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }

    public function address() {
        return $this->belongsTo('App\Models\Address', 'user_address_id');
    }

}
