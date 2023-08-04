<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Period;
use App\Models\Semester;

class PeriodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Period::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'year' => $this->faker->numberBetween(-10000, 10000),
            'semester_id' => Semester::factory(),
            'active' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
