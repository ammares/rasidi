<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\ProviderTranslation;
use App\Models\Country;
use Illuminate\Database\Seeder;

class ProviderSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Provider::truncate();
        ProviderTranslation::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        $countries = Country::all();
        $data = [];
        foreach ($countries as $key => $country) {
            $country_row = ['country_id' => $country->id];
            
            foreach (config('translatable.locales') as $locale) {
                $country_row[$locale] = ['name' => $country->name.'_provider'];
            }
            $data[] = $country_row;
        }
        foreach ($data as $one_row) {
            Provider::create($one_row);
        }
    }
}
