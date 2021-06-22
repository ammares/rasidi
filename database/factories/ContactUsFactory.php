<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactUs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => $this->faker->numberBetween(Client::min('id'), Client::max('id')),
            'subject' => $this->faker->name(),
            'message' => $this->faker->text(),
            'replied_at' => $this->faker->randomElement([$this->faker->dateTimeBetween('-2 week', '-1 week'), null]),
            'created_at' => $this->faker->dateTimeBetween('-4 week', '-3 week'),
        ];
    }
}
