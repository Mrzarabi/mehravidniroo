<?php

namespace App\Models;

use App\User;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    /**
     * Relations
     */

    /**
     * Each Role can has many users
     */
    public function users() {
        return $this->hasMany(User::class);
    }
}
