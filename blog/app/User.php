<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'admin';
    // const ROLE_MANAGER = 'manager';
    const ROLE_USER = 'user';
    const ROLE_SUSPEND = 'suspend';
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];
}
