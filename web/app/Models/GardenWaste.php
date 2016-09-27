<?php

namespace App\Models;

class GardenWaste extends \Eloquent {

    protected $table = "garden_waste";
    protected $guarded = [];    

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function address() {
        return $this->belongsTo('App\Models\Address', 'address_id');
    }
}
