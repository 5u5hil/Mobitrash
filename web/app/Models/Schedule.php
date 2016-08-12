<?php

namespace App\Models;

class Schedule extends \Eloquent {

    protected $table = "schedules";
    protected $guarded = [];

    public function operators() {
        return $this->belongsToMany('App\Models\User', 'has_operators', 'schedule_id', 'user_id');
    }
    
    public function drivers() {
        return $this->belongsToMany('App\Models\User', 'has_drivers', 'schedule_id', 'user_id');
    }

    public function addedBy() {
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function van() {
        return $this->belongsTo('App\Models\Asset', 'van_id');
    }
    
    public function shift() {
        return $this->belongsTo('App\Models\Shift', 'shift_id');
    }
    
    public function pickups() {
        return $this->hasMany('App\Models\Pickup', 'schedule_id')->orderBy('pickuptime','ASC');
    }
    
    
    
}
