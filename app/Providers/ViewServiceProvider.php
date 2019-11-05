<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Using Closure based composers...
        $menu = [
            ['name'=>'Dashboard',
            'url'=>'/',
            'icon'=>'home'],
            ['name'=>'Sale',
            'url'=>'/sale',
            'icon'=>'book'],
            ['name'=>'Inventory',
            'icon'=>'book',
            'menus'=> [
                ['name'=>'Products',
                'url'=>'/products',
                'icon'=>'account_circle']]
            ],
            ['name'=>'Store',
            'url'=>'/store',
            'icon'=>'account_circle']
        ];
        View::share('foo', json_encode($menu));
    }
}
