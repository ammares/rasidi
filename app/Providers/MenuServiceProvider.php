<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
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
        // Share all menuData to all the views
        view()->composer('*', function ($view)
        {
            $menuData = null;
            // get all data from menu.json file
            if (auth()->check()) {
                if (auth()->user()->hasRole('admin') || auth()->user()->can('clients') || auth()->user()->can('reports')) {
                    $menuJson = file_get_contents(base_path('Modules/Admin/Resources/data/menu-data/adminMenu.json'));
                    $menuData = json_decode($menuJson);
                }
            }
            // TODO add all menu roles
            $view->with('menuData', $menuData );
        });
    }
}
