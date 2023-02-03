<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClassCourse;
use App\Models\ClassMeeting;
use App\Models\CoursePlanDetail;
use App\Models\Room;

class ClassMeetingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClassMeeting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'meet_no' => $this->faker->numberBetween(-10000, 10000),
            'class_id' => ClassCourse::factory(),
            'course_plan_detail_id' => CoursePlanDetail::factory(),
            'method' => $this->faker->numberBetween(-10000, 10000),
            'ol_platform' => $this->faker->word,
            'ol_links' => $this->faker->word,
            'room_id' => Room::factory(),
            'lecture_date' => $this->faker->date(),
            'start_at' => $this->faker->time(),
            'end_at' => $this->faker->time(),
        ];
    }
}
