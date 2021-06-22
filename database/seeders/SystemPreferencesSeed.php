<?php

namespace Database\Seeders;

use App\Models\SystemPreference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class SystemPreferencesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Legal pages
        foreach (config('translatable.locales') as $locale) {
            SystemPreference::firstOrCreate(
                ['key' => 'term_of_use_' . $locale],
                ['value' => '<p><br></p>'],
                ['type' => 'legal_pages']
            );
            SystemPreference::firstOrCreate(
                ['key' => 'privacy_policy_' . $locale],
                ['value' => '<p><br></p>'],
                ['type' => 'legal_pages']
            );
        }
    }
}
