<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Store::class, 5)->create()->each(function ($store) {
            $store->products()->save(factory(App\Product::class)->make());
        });
    }
}
