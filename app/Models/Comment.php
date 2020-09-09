<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment_id',
        'product_id',
        'body',
        'status',
        'is_show',
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
     * Each comment belongs to one User
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Each comment belongs to one product
     */
    public function product() {
        return $this->belongsTo(Product::class);
    }

    /**
     * Each comment belongs to one article
     */
    public function article() {
        return $this->belongsTo(Article::class);
    }

    /**
     * Each Comment can has many Children
     */
    public function Comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the all Comment parent.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }

}
