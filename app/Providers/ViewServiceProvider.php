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
            ['name'=>'User',
            'url'=>'/users',
            'icon'=>'account_circle'],
            ['name'=>'Products',
            'url'=>'/products',
            'icon'=>'account_circle']
        ];
        View::share('foo', json_encode($menu));
    }
}
