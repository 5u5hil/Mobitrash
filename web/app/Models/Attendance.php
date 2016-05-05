<?php

namespace App\Models;

class Attendance extends \Eloquent {
    protected $table = "attendances";
    protected $guarded = [];
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
