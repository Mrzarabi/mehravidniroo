<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'images',
        'title',
        'desc',
        'body',
        'u_price',
        'c_price',
        'inventory',
    ];

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
     * Get the all category parent.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Each product can has many Images
     */
    public function Images() {
        $this->hasMany(Image::class);
    }

    /**
     * Each product can has many comments
     */
    public function comments() {
        $this->hasMany(Comment::class);
    }
}
