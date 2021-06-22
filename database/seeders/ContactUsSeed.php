<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class ContactUsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void

     */

    public function run()
    {
        if (Client::count() > 0) {
            ContactUs::factory()->count(100)->create();
        }

    }
}
