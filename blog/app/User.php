<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    // use SoftDeletes;
    const ROLE_ADMIN = 'admin';
    // const ROLE_MANAGER = 'manager';
    const ROLE_USER = 'user';
    const ROLE_SUSPEND = 'suspend';
    protected $fillable = [
        'id', 'name', 'email', 'password', 'role'
    ];
    // protected $dates = ['deleted_at'];
}
