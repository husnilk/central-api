<?php

namespace Database\Factories;

use App\Models\ThesisRubric;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisRubricFactory extends Factory
{
    protected $model = ThesisRubric::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'active' => 0
        ];
    }
}
