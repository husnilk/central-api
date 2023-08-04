<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassCourse;
use App\Models\Course;
use App\Models\CoursePlan;
use App\Models\Period;

class ClassCourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassCourse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'course_id' => Course::factory(),
            'period_id' => Period::factory(),
            'course_plan_id' => CoursePlan::factory(),
        ];
    }
}
