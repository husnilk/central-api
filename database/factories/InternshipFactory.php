<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisTopic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
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
