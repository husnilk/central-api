<?php

namespace Database\Factories;

use App\Models\Thesis;
use App\Models\ThesisRubric;
use App\Models\ThesisTopic;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Thesis::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student = Student::factory()->create();
        return [
            'topic_id' => ThesisTopic::factory(),
            'student_id' => $student->id,
            'title' => $this->faker->sentence,
            'abstract' => $this->faker->paragraph,
            'start_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(array_keys(Thesis::STATUS_SELECT)),
            'created_by' => $student->id
        ];
    }
}
