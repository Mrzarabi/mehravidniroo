<?php

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = factory(Category::class, 10)->create();
        $categories->each( function($category) {
            $category->categories()->saveMany( 
                factory(Category::class, rand(0,5))->make()
             );
        });

        $brands = factory(Brand::class, 10)->create();
    }
}
