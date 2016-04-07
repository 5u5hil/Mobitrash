<?php

namespace App\Models;

class Subscription extends \Eloquent {

    protected $table = "subscriptions";
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function addedBy() {
        return $this->belongsTo('App\Models\User', 'added_by');
    }

    public function timeslot() {
        return $this->belongsTo('App\Models\Timeslot', 'timeslot');
    }

    public function frequency() {
        return $this->belongsTo('App\Models\Frequency', 'frequency_id');
    }

    public function servicetype() {
        return $this->belongsTo('App\Models\Servicetype', 'servicetype_id');
    }
    
    public function packages() {
        return $this->belongsTo('App\Models\Package', 'package_id');
    }
    
    public function atts() {
        return $this->hasMany('App\Models\Attachment', 'subscription_id');
    }
    
    public function wastetypes() {
        return $this->belongsToMany('App\Models\Wastetype', 'subscription_wastetype', 'subscription_id', 'wastetype_id');
    }
    
    public function address() {
        return $this->belongsTo('App\Models\Address', 'user_address_id');
    }

}
