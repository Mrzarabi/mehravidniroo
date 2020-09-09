<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\User;
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
        $user = factory(User::class)->create();

        $categories = factory(Category::class, 10)->create();
        $categories->each( function($category) use($user) {
            $category->categories()->saveMany( 
                factory(Category::class, rand(0,5))->make()
             )->each(function($category) use($user) {
                $products = $category->products()->saveMany(
                    factory(Product::class, rand(0,5))
                        ->create(['user_id' => $user->id])
                );
                $products->each(function($product) use($user) {
                    $comments = $product->comments()->saveMany(
                        factory(Comment::class, rand(0, 6)) 
                            ->make( ['user_id' => $user->id])
                    );
                    $comments->each( function($comment) use($user, $product) {
                        $comment->comments()->saveMany( 
                            factory(Comment::class, rand(0, 6)) 
                            ->make([
                                'product_id' => $product->id,
                                'user_id' => $user->id,
                                ])
                        );
                    });
                });
            });
        });

        // $categories->each(function($category) use($user){
        //     $category->products()->saveMany(
        //         factory(Product::class, rand(0,5))
        //             ->create(['user_id' => $user->id])
        //     );
        // });
        // $brands = factory(Brand::class, 10)->create();
    }
}
