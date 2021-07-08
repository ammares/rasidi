<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\CategoriesController;
use Modules\Admin\Http\Controllers\ChargeOperationsController;
use Modules\Admin\Http\Controllers\ClientsController;
use Modules\Admin\Http\Controllers\ClientsBillsController;
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

            Route::prefix('categories')->group(function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('settings.categories');
                Route::post('/', [CategoriesController::class, 'store'])->name('settings.categories.store');
                Route::delete('{id}/destroy', [CategoriesController::class, 'destroy'])->name('settings.categories.destroy');

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
