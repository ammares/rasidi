<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\CategoriesController;
use Modules\Admin\Http\Controllers\ChargeOperationsController;
use Modules\Admin\Http\Controllers\ClientsController;
use Modules\Admin\Http\Controllers\ClientsBillsController;
use Modules\Admin\Http\Controllers\ContactUsController;
use Modules\Admin\Http\Controllers\DevicesController;
use Modules\Admin\Http\Controllers\EmailTemplatesController;
use Modules\Admin\Http\Controllers\FaqController;
use Modules\Admin\Http\Controllers\GatewaysController;
use Modules\Admin\Http\Controllers\GridPreferencesController;
use Modules\Admin\Http\Controllers\HomeController;
use Modules\Admin\Http\Controllers\HowItWorksController;
use Modules\Admin\Http\Controllers\IntroductionsController;
use Modules\Admin\Http\Controllers\KeyFeaturesController;
use Modules\Admin\Http\Controllers\LoginLogsController;
use Modules\Admin\Http\Controllers\MqttController;
use Modules\Admin\Http\Controllers\NotificationsController;
use Modules\Admin\Http\Controllers\ProvidersController;
use Modules\Admin\Http\Controllers\ReportsController;
use Modules\Admin\Http\Controllers\SettingsController;
use Modules\Admin\Http\Controllers\SystemPreferencesController;
use Modules\Admin\Http\Controllers\TransferOperationsController;
use Modules\Admin\Http\Controllers\UserPreferencesController;
use Modules\Admin\Http\Controllers\UserProfileController;
use Modules\Admin\Http\Controllers\UsersController;

Route::prefix('admin')->group(function () {
    Auth::routes(['register' => false, 'reset' => false, 'confirm' => false, 'verify' => false]);

    Route::group(['middleware' => ['auth', 'authorize']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        Route::get('grid_preferences', [GridPreferencesController::class, 'load']);
        Route::post('grid_preferences', [GridPreferencesController::class, 'save']);

        Route::post('user_preferences', [UserPreferencesController::class, 'save']);

        Route::get('notifications', [NotificationsController::class, 'index']);
        Route::delete('notifications/delete_all', [NotificationsController::class, 'deleteAll']);
        Route::delete('notifications/{notification_id}', [NotificationsController::class, 'delete']);

        Route::prefix('clients')->group(function () {
            Route::get('', [ClientsController::class, 'index'])->name('clients');
            Route::get('{client}/gateway_details', [ClientsController::class, 'gatewayDetails'])
                ->name('clients.gateway_details');
            Route::get('export', [ClientsController::class, 'export'])->name('clients.export');
            Route::patch('update/{client}', [ClientsController::class, 'update'])->name('clients.update');
            Route::patch('{client}/activate_deactivate', [ClientsController::class, 'activateDeactivate'])
                ->name('clients.activate_deactivate');
            Route::patch('{client}/ban_unban', [ClientsController::class, 'banUnban'])
                ->name('clients.ban_unban');
            Route::patch('{client}/reset_password', [ClientsController::class, 'resetPassword'])
                ->name('clients.reset_password');
            Route::patch('{client}/renew_subscription', [ClientsController::class, 'renewSubscription'])
                ->name('clients.renew_subscription');
        });

        Route::prefix('messages')->group(function () {
            Route::get('', [ContactUsController::class, 'index'])->name('messages');
            Route::get('export', [ContactUsController::class, 'export'])->name('messages.export');
            Route::patch('{contact_us}/mark_as_replied', [ContactUsController::class, 'markAsReplied'])
                ->name('messages.mark_as_replied');
        });

        Route::prefix('reports')->group(function () {
            Route::get('', [ReportsController::class, 'index'])->name('reports');

            Route::prefix('login_logs')->group(function () {
                Route::get('', [LoginLogsController::class, 'index'])->name('reports.login_logs');
                Route::get('export', [LoginLogsController::class, 'export'])->name('reports.login_logs.export');

            });
        });

        Route::get('user_profile', [UserProfileController::class, 'index'])->name('user_profile');
        Route::patch('update_profile', [UserProfileController::class, 'update'])->name('user_profile.update');
        Route::patch('change_password', [UserProfileController::class, 'changePassword'])->name('user_profile.change_password');
        Route::prefix('settings')->group(function () {
            Route::get('', [SettingsController::class, 'index'])->name('settings');

            Route::prefix('faq')->group(function () {
                Route::get('', [FaqController::class, 'index'])->name('settings.faq');
                Route::get('/create', [FaqController::class, 'create'])->name('settings.faq.create');
                Route::post('', [FaqController::class, 'store'])->name('settings.faq.store');
                Route::get('/{faq}/edit', [FaqController::class, 'edit'])->name('settings.faq.edit');
                Route::patch('/sort', [FaqController::class, 'sort'])->name('settings.faq.sort');
                Route::patch('/{faq}', [FaqController::class, 'update'])->name('settings.faq.update');
                Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('settings.faq.destroy');

            });
            Route::get('legal', [SystemPreferencesController::class, 'legalPages'])->name('settings.legal');
            Route::post('legal', [SystemPreferencesController::class, 'storeLegalPages'])->name('settings.legal.store');

            Route::get('business_profiles', [SystemPreferencesController::class, 'businessProfilePages'])->name('settings.business_profiles');
            Route::post('business_profiles', [SystemPreferencesController::class, 'storeBusinessProfilePages'])->name('settings.business_profiles.store');

            Route::prefix('general')->group(function () {
                Route::get('', [SystemPreferencesController::class, 'generalSettings'])->name('settings.general');

                Route::get('email_settings', [SystemPreferencesController::class, 'emailSettings'])->name('settings.general.email_settings');
                Route::post('email_settings', [SystemPreferencesController::class, 'storeEmailSettings'])->name('settings.general.email_settings.store');
            });

            Route::prefix('gateways')->group(function () {
                Route::get('', [GatewaysController::class, 'index'])->name('settings.gateways');
                Route::get('{id}/details', [GatewaysController::class, 'details'])->name('settings.gateways.details');
                Route::get('export', [GatewaysController::class, 'export'])->name('settings.gateways.export');
                Route::get('import', [GatewaysController::class, 'importForm']);
                Route::post('import', [GatewaysController::class, 'import'])->name('settings.gateways.import');
                Route::get('import/download_template', [GatewaysController::class, 'downloadTemplate'])->name('settings.gateways.download_template');
                Route::post('', [GatewaysController::class, 'store'])->name('settings.gateways.store');
                Route::patch('{gateway}', [GatewaysController::class, 'update'])->name('settings.gateways.update');
                Route::patch('{gateway}/activate_deactivate', [GatewaysController::class, 'activateDeactivate'])
                    ->name('settings.gateways.activate_deactivate');
            });

            Route::prefix('introductions')->group(function () {
                Route::get('', [IntroductionsController::class, 'index'])->name('settings.introductions');
                Route::get('/create', [IntroductionsController::class, 'create'])->name('settings.introductions.create');
                Route::post('', [IntroductionsController::class, 'store'])->name('settings.introductions.store');
                Route::get('/{introduction}/edit', [IntroductionsController::class, 'edit'])->name('settings.introductions.edit');
                Route::patch('/sort', [IntroductionsController::class, 'sort'])->name('settings.introductions.sort');
                Route::patch('/{introduction}', [IntroductionsController::class, 'update'])->name('settings.introductions.update');
                Route::delete('/{introduction}', [IntroductionsController::class, 'destroy'])->name('settings.introductions.destroy');

            });

            Route::prefix('howitworks')->group(function () {
                Route::get('', [HowItWorksController::class, 'index'])->name('settings.howitworks');
                Route::get('/create', [HowItWorksController::class, 'create'])->name('settings.howitworks.create');
                Route::post('', [HowItWorksController::class, 'store'])->name('settings.howitworks.store');
                Route::get('/{howitworks}/edit', [HowItWorksController::class, 'edit'])->name('settings.howitworks.edit');
                Route::patch('/sort', [HowItWorksController::class, 'sort'])->name('settings.howitworks.sort');
                Route::patch('/{howitworks}', [HowItWorksController::class, 'update'])->name('settings.howitworks.update');
                Route::delete('/{howitworks}', [HowItWorksController::class, 'destroy'])->name('settings.howitworks.destroy');

            });

            Route::prefix('keyfeatures')->group(function () {
                Route::get('', [KeyFeaturesController::class, 'index'])->name('settings.keyfeatures');
                Route::get('/create', [KeyFeaturesController::class, 'create'])->name('settings.keyfeatures.create');
                Route::post('', [KeyFeaturesController::class, 'store'])->name('settings.keyfeatures.store');
                Route::get('/{keyfeatures}/edit', [KeyFeaturesController::class, 'edit'])->name('settings.keyfeatures.edit');
                Route::patch('/sort', [KeyFeaturesController::class, 'sort'])->name('settings.keyfeatures.sort');
                Route::patch('/{keyfeatures}', [KeyFeaturesController::class, 'update'])->name('settings.keyfeatures.update');
                Route::delete('/{keyfeatures}', [KeyFeaturesController::class, 'destroy'])->name('settings.keyfeatures.destroy');
            });

            Route::prefix('devices')->group(function () {
                Route::get('', [DevicesController::class, 'index'])->name('settings.devices');
                Route::post('', [DevicesController::class, 'store'])->name('settings.devices.store');
                Route::get('export', [DevicesController::class, 'export'])->name('settings.devices.export');
                Route::patch('{id}', [DevicesController::class, 'update'])->name('settings.devices.update');
                Route::patch('{id}/update_schedule', [DevicesController::class, 'updateSchedule'])->name('settings.devices.update_schedule');
                Route::patch('{id}/enable_disable', [DevicesController::class, 'enableDisable'])
                    ->name('settings.devices.enable_disable');
                Route::patch('{id}/common_normal', [DevicesController::class, 'commonNormal'])
                    ->name('settings.devices.common_normal');
                Route::delete('/{id}', [DevicesController::class, 'destroy'])->name('settings.devices.destroy');
            });

            Route::prefix('users')->group(function () {
                Route::get('', [UsersController::class, 'index'])->name('settings.users');
                Route::post('', [UsersController::class, 'store'])->name('settings.users.store');
                Route::patch('/{user}', [UsersController::class, 'update'])->name('settings.users.update');
                Route::patch('/{user}/activate_deactivate', [UsersController::class, 'activateDeactivate'])
                    ->name('settings.users.activate_deactivate');
                Route::patch('/{user}/reset_password', [UsersController::class, 'resetPassword'])
                    ->name('settings.users.reset_password');
            });

            Route::resource('roles', 'RolesController', [
                'names' => [
                    'index' => 'settings.roles',
                    'create' => 'settings.roles.create',
                    'store' => 'settings.roles.store',
                    'edit' => 'settings.roles.edit',
                    'update' => 'settings.roles.update',
                    'destroy' => 'settings.roles.destroy',
                ],
            ])->except(['show']);

            Route::prefix('email_templates')->group(function () {
                Route::get('', [EmailTemplatesController::class, 'index'])->name('settings.email_templates');
                Route::get('/create', [EmailTemplatesController::class, 'create'])->name('settings.email_templates.create');
                Route::post('', [EmailTemplatesController::class, 'store'])->name('settings.email_templates.store');
                Route::get('{email_template}/edit', [EmailTemplatesController::class, 'edit'])->name('settings.email_templates.edit');
                Route::get('{id}/mail_logs/{status}', [EmailTemplatesController::class, 'loadMailLogs'])->name('settings.email_templates.load_mail_logs');
                Route::post('{id}/mail_logs/clear/{status}', [EmailTemplatesController::class, 'clearMailLogs'])->name('settings.email_templates.clear_failed_mail_logs');
                Route::patch('{id}/activate_deactivate', [EmailTemplatesController::class, 'activateDeactivate'])->name('settings.email_templates.activate_deactivate');
                Route::patch('{email_template}/update', [EmailTemplatesController::class, 'update'])->name('settings.email_templates.update');
                Route::post('{email_template}/send_test_mail', [EmailTemplatesController::class, 'sendTestMail'])->name('settings.email_templates.send_test_mail');
            });

            Route::prefix('providers')->group(function () {
                Route::get('/', [ProvidersController::class, 'index'])->name('settings.providers');
                Route::post('', [ProvidersController::class, 'store'])->name('settings.providers.store');
                Route::get('{id}/edit', [ProvidersController::class, 'edit'])->name('settings.providers.edit');
                Route::patch('{id}', [ProvidersController::class, 'update'])->name('settings.providers.update');
                Route::delete('{id}/destroy', [ProvidersController::class, 'destroy'])->name('settings.providers.destroy');
                Route::patch('{id}/verify_unverify', [ProvidersController::class, 'verifyUnverify'])->name('settings.providers.verify_unverify');
            });

            Route::prefix('categories')->group(function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('settings.categories');

            });

            Route::prefix('transfer_operations')->group(function () {
                Route::get('/', [TransferOperationsController::class, 'index'])->name('settings.transfer_operations');

            });

            Route::prefix('charge_operations')->group(function () {
                Route::get('/', [ChargeOperationsController::class, 'index'])->name('settings.charge_operations');

            });
            Route::prefix('clients_bills')->group(function () {
                Route::get('/', [ClientsBillsController::class, 'index'])->name('settings.clients_bills');

            });

        });

        Route::get('mqtt', [MqttController::class, 'index']);
        Route::post('mqtt', [MqttController::class, 'send']);
    });
});
