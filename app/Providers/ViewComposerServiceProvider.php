<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeSidebar();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composeSidebar(){
        view()->composer('layouts.sidebar', function($view){
            $view->with('categories', Category::all());
        });

        view()->composer('layouts.categoryList', function($view){
            $view->with('categories', Category::all());
        });
    }
}
