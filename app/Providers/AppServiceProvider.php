<?php

namespace App\Providers;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*',function($view){
            $view->with('cartGetContents',Cart::getContent());
            $view->with('totalQuantity',Cart::getTotalQuantity());
            $view->with('totalPrice', Cart::getSubTotal());
        });
    }
}
