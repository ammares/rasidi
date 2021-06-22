<?php

namespace App\Models;

use App\Traits\DataViewer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'avatar',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function loadAll($export = false)
    {
        return DataViewer::searchDataGrid(
            User::select([
                'users.id', 'users.name', 'users.email', 'users.avatar',
                'users.mobile', 'users.active', 'users.created_at',
            ])->with('roles'),
            ['name', 'email'],
            $export
        );
    }
}
