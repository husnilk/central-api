<?php

namespace Database\Factories;

use App\Models\ThesisRubric;
use App\Models\ThesisRubricDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisRubricDetailFactory extends Factory
{
    protected $model = ThesisRubricDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_rubric_id' => ThesisRubric::factory(),
            'description' => $this->faker->text,
            'percentage' => $this->faker->randomFloat(100)
        ];
    }
}
