<?php

namespace Database\Factories;

use App\Models\ThesisTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisTopic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence
        ];
    }
}
