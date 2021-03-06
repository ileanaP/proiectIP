<?php

namespace App\Providers;

use App\Category;
use App\Org;
use App\User;
use Illuminate\Support\Facades\DB;
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

    private function composeSidebar()
    {
        view()->composer('includes.sidebar', function($view) {
            $view->with('categories', Category::all());
        });

        view()->composer('layouts.categoryList', function($view) {
            $view->with('categories', Category::all());
        });

        view()->composer('pages.adminPageModifyOrgs', function($view) {
            $view->with('org', Org::all());
        });


        view()->composer('pages.organizerEventsPage', function($view) {
            $view->with('org', Org::all());
        });

        view()->composer('includes.header', function($view) {
            $orgFromTable = User::where('type','3')->get();
            $org = array();
            foreach($orgFromTable as $organizer){
                $org[] = $organizer->id;
            }
            $view->with('org', $org);
        });

        view()->composer('includes.header', function($view){
            $organizersObject = User::whereIn('type',array('2','3','4'))->get();
            $orgIds = [];
            foreach($organizersObject as $organizer){
                $orgIds [] = $organizer->id;
            }
            $view->with('orgIds', $orgIds);
        });
    }
}
