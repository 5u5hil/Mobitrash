<?php

namespace App\Models;

class Payment extends \Eloquent {

    protected $table = "payments";
    protected $guarded = [];

    public function subscription() {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function addedBy() {
        return $this->belongsTo('App\Models\User', 'added_by');
    }    
}
