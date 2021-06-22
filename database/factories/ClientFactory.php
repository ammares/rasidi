<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Country;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $country_ids = Country::pluck('id');
        $city_ids = City::pluck('id');
        return [
            'country_id' => $this->faker->randomElement($country_ids),
            'city_id' => $this->faker->randomElement($city_ids),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'mobile' => $this->faker->e164PhoneNumber,
            'email_verified' => $this->faker->randomElement(['0', '1']),
            'created_at' => $this->faker->dateTimeBetween('-6 week', '-5 week'),

        ];
    }
}
