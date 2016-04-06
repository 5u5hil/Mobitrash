<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable,
        EntrustUserTrait,
        CanResetPassword;

    public function addresses() {
        return $this->hasMany('App\Models\Address', 'user_id');
    }
    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
    }

}
