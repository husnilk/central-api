<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppVersion>
 */
class AppVersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'app_id' => $this->faker->uuid(),
            'app_token' => $this->faker->uuid,
            'version' => $this->faker->randomDigit(),
            'major_ver' => $this->faker->randomDigit(),
            'minor_ver' => $this->faker->randomDigit(),
            'enabled' => $this->faker->randomElement([0, 1]),
            'active' => $this->faker->randomElement([0, 1]),
            'url' => $this->faker->url,
        ];
    }
}
