<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'desc',
        'body',
        'u_price',
        'c_price',
        'inventory',
        'code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'products.title' => 10,
        ],
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
    public function images() {
        return $this->hasMany(Image::class);
    }

    /**
     * Each product can has many comments
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
