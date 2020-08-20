<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * Relations
     */

    /**
     * Each brand can has many products
     */
    public function products() {
        return $this->hasMany(Product::class);
    }
}
