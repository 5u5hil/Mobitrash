<?php

namespace App\Models;

class Message extends \Eloquent {

    protected $table = "messages";
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
}
