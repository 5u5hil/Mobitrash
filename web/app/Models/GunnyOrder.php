<?php

namespace App\Models;

class GunnyOrder extends \Eloquent {

    protected $table = "gunny_orders";
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function address() {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }

}
