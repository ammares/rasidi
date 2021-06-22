<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Faqs;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Faqs::class;

    public function definition()
    {
        return [
            'order' => $this->faker->randomDigit,
        ];
    }
}
