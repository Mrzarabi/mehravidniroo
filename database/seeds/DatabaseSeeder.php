<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Ticket;
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
                    factory(Product::class, rand(0,20))
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

        $users = factory(User::class, 5)->create();
        $users->each( function($user) {
            $tickets = $user->tickets()->saveMany(
                factory(Ticket::class, rand(3, 5))->make()
            );
            $tickets->each( function($ticket) use($user) {
                $ticket->tickets()->saveMany(
                    factory(Ticket::class, rand(2, 5))->make(
                        ['user_id' => $user->id]
                    )
                );
            });
        });

    }
}
