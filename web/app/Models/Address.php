<?php

namespace App\Models;

class Address extends \Eloquent {

    protected $table = "has_addresses";
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
