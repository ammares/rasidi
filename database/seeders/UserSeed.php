<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::updateOrCreate(
            [
                'email' => 'admin@rasidi.com',
            ],
            [
                'name' => 'Admin',
                'password' => bcrypt('123123'),
                'avatar' => 'user_silhouette.png',
            ]
        );
        $admin->assignRole(Role::findByName('admin'));
    }
}
