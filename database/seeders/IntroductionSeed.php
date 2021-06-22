<?php

namespace Database\Seeders;

use App\Models\Introduction;
use App\Models\IntroductionTranslation;
use Illuminate\Database\Seeder;

class IntroductionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        Introduction::truncate();
        IntroductionTranslation::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        $data = [ //1
            [
                'order' => '1',
                'en' => [
                    'title' => 'brighter energy is savings',
                    'summary' => '<p>use your electricity at the right time
                    and in the right way to slash your bill</p>',
                ],
                'es' => [
                    'title' => 'brighter energy is savings',
                    'summary' => '<p>use your electricity at the right time
                    and in the right way to slash your bill</p>',
                ],
            ],
            [
                'order' => '2',
                'en' => [
                    'title' => 'brighter energy is control',
                    'summary' => '<p>use your green energy to run your
                    appliances and know exactly how much
                    leftover power you can get credit for </p>',
                ],
                'es' => [
                    'title' => 'brighter energy is control',
                    'summary' => '<p>use your green energy to run your
                    appliances and know exactly how much
                    leftover power you can get credit for </p>',
                ],
            ],
            [
                'order' => '3',
                'en' => [
                    'title' => 'brighter energy is convenience',
                    'summary' => '<p>sit back, relax and let the brighter energy
                    device save you electricity on its own </p>',
                ],
                'es' => [
                    'title' => 'brighter energy is convenience',
                    'summary' => '<p>sit back, relax and let the brighter energy
                    device save you electricity on its own </p>',
                ],
            ],
            [
                'order' => '1',
                'type' => 'key_features',
                'en' => [
                    'title' => 'all your renewable energy will be utilized',
                ],
                'es' => [
                    'title' => 'all your renewable energy will be utilized',
                ],
            ],
            [
                'order' => '2',
                'type' => 'key_features',
                'en' => [
                    'title' => 'your heavy electricity usage will be scheduled for the tight time of day',
                ],
                'es' => [
                    'title' => 'your heavy electricity usage will be scheduled for the tight time of day',
                ],
            ],
            [
                'order' => '3',
                'type' => 'key_features',
                'en' => [
                    'title' => 'your air conditions and heating will be set to comfort temperatures',
                ],
                'es' => [
                    'title' => 'your air conditions and heating will be set to comfort temperatures',
                ],
            ],
            [
                'order' => '4',
                'type' => 'key_features',
                'en' => [
                    'title' => 'you will know to the day your electricity dues',
                ],
                'es' => [
                    'title' => 'you will know to the day your electricity dues',
                ],
            ],
            [
                'order' => '1',
                'type' => 'how_it_works',
                'en' => [
                    'title' => 'step 1',
                    'summary' => '<p> introduce yourself </p>',
                ],
                'es' => [
                    'title' => 'step 1',
                    'summary' => '<p> introduce yourself </p>',
                ],
            ],
            [
                'order' => '2',
                'type' => 'how_it_works',
                'en' => [
                    'title' => 'step 2',
                    'summary' => '<p> tell us your location </p>',
                ],
                'es' => [
                    'title' => 'step 2',
                    'summary' => '<p> tell us your location </p>',
                ],
            ],
            [
                'order' => '3',
                'type' => 'how_it_works',
                'en' => [
                    'title' => 'step 3',
                    'summary' => '<p> enter the electrical appliances </p>',
                ],
                'es' => [
                    'title' => 'step 3',
                    'summary' => '<p> enter the electrical appliances </p>',
                ],
            ],
            [
                'order' => '4',
                'type' => 'how_it_works',
                'en' => [
                    'title' => 'step 4',
                    'summary' => '<p> key in your renewable energy details </p>',
                ],
                'es' => [
                    'title' => 'step 4',
                    'summary' => '<p> key in your renewable energy details </p>',
                ],
            ],
        ];
        foreach ($data as $one) {
            Introduction::create($one);
        }
    }
}
