<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $users = factory(App\User::class, 10)->create();

        $users->each(function(App\User $user) use ($users) {
            $products = factory(App\Product::class)
            	->times(10)
                ->create([
                    'user_id' => $user->id,
                    'owner' => random_int(1,3),
                ]);

            $products->each(function (App\Product $product) use ($users) {
                factory(App\Response::class, random_int(1, 10))->create([
                    'product_id' => $product->id,
                    'user_id' => $users->random(1)->first()->id,
                ]);
            });
          });
    }
}
