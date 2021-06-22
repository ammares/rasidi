<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
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
        if (config('system-preferences.email_mailer')) {
            $config = array(
                'driver' => config('system-preferences.email_mailer'),
                'host' => config('system-preferences.email_server_host'),
                'port' => config('system-preferences.email_server_port'),
                'username' => config('system-preferences.email_username'),
                'password' => config('system-preferences.email_password'),
                'encryption' => config('system-preferences.email_encryption'),
                'from' => array(
                    'address' => config('system-preferences.email_from_address'),
                    'name' => config('system-preferences.email_from_name'),
                ),
                'sendmail' => '/usr/sbin/sendmail -bs',
                'pretend' => false,
            );

            Config::set('mail', $config);
        }
    }
}
