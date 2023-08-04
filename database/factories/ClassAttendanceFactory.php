<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassAttendance;
use App\Models\ClassMeeting;
use App\Models\StudyPlan;

class ClassAttendanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassAttendance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'study_plan_id' => StudyPlan::factory(),
            'class_meeting_id' => ClassMeeting::factory(),
            'device_id' => $this->faker->word,
            'device_name' => $this->faker->word,
            'lattitude' => $this->faker->randomFloat(0, 0, 9999999999.),
            'longitude' => $this->faker->longitude,
            'attendance_status' => $this->faker->numberBetween(-10000, 10000),
            'need_attention' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
