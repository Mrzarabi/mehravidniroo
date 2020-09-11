<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'name',
        'email',
        'status',
        'title',
        'body',
        'image',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relations
     */

    /**
     * Each Category can has many Children
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Each commet can has a parent.
     */
    public function parent()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Each Ticket can has many children
     */
    public function tickets()
    {
        return $this->hasOne(Ticket::class);
    }

}
