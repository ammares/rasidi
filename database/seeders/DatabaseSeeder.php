<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeed::class);
        $this->call(UserRolesSeed::class);
        $this->call(UserSeed::class);
        $this->call(PermissionSeed::class);
        $this->call(SystemPreferencesSeed::class);
        $this->call(EmailTemplateSeed::class);
        $this->call(FAQSeed::class);
        $this->call(IntroductionSeed::class);
        $this->call(ClientSeed::class); // @todo delete for testing phase
        $this->call(ContactUsSeed::class); // @todo delete for testing phase
    }
}
