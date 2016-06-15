<?php

namespace App\Models;

class Service extends \Eloquent {
    protected $table = "services";
    protected $guarded = [];
    
    public function schedule() {
        return $this->belongsTo('App\Models\Schedule', 'schedule_id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function address() {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }
    public function operator() {
        return $this->belongsTo('App\Models\User', 'operator_id');
    }
    public function subscription() {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }
    public function wastetypes() {
        return $this->belongsToMany('App\Models\Wastetype', 'has_wastetypes', 'service_id', 'wastetype_id')->withPivot('quantity');
    }
    public function additives() { 
        return $this->belongsToMany('App\Models\Additive', 'has_additives', 'service_id', 'additive_id')->withPivot('quantity');
    }
}
