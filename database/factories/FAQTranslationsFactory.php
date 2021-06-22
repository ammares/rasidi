<?php

namespace Database\Factories;

use App\Models\Faqs;
use App\Models\FaqTranslation;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class FAQTranslationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FaqTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faqId = Faqs::pluck('id');
        return [
            'region_id' => $this->faker->randomElement($faqId),
            'question' => $this->faker->sentence,
            'answer' => $this->faker->paragraph
        ];
    }
}
