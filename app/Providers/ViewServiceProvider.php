<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'admin::pages.settings.devices.index',
            'admin::pages.settings.introductions.index',
            'admin::pages.settings.howitworks.index',
            'admin::pages.settings.keyfeatures.index',
            'admin::pages.settings.faq.index',
            'admin::pages.settings.providers.index',
            'admin::pages.reports.login_logs.index',
        ], 'App\Http\View\Composers\LangComposer');
    }
}
