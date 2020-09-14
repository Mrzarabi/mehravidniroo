<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Category extends Model
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
        // 'desc',
        // 'image'
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
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'categories.title' => 10,
        ],
        // 'joins' => [
        //     'categories' => ['categories.id','categories.category_id'],
        // ],
    ];

    /**
     * Relations
     */

    /**
     * Each Category can has many Children
     */
    public function categories() {
        return $this->hasMany(Category::class);
    }

    /**
     * Get the all category parent.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Each category can has many products
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
}
