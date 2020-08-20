<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent',
        'title',
        'desc',
        'image'
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
    public function children() {
        return $this->hasMany(Category::class, 'parent');
    }

    /**
     * Get the all category parent.
     */
    public function parent_group()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    /**
     * Each category can has many products
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
}
