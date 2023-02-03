<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Period;
use App\Models\Student;
use App\Models\StudyPlan;

class StudyPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudyPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::factory(),
            'period_id' => Period::factory(),
            'status' => $this->faker->numberBetween(-10000, 10000),
            'registered_date' => $this->faker->date(),
        ];
    }
}
