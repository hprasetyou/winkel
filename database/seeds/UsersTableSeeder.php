<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 5)->create()->each(function ($company) {
            $company->users()->save(factory(App\User::class)->make());
            for ($i=0; $i < 20; $i++) { 
                $company->products()->save(factory(App\Product::class)->make());
            }
        });
    }
}
