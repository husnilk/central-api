<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\InternshipProposal;
use App\Models\Lecturer;
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
            'proposal_id' => InternshipProposal::factory(),
            'student_id' => Student::factory(),
            'supervisor_id' => Lecturer::factory(),
            'status' => $this->faker->randomElement(array_keys(Internship::STATUSES)),
            'start_at' => $this->faker->date,
            'end_at' => $this->faker->date,
            'report_title' => $this->faker->title,
            'division' => $this->faker->randomElement(["IT", 'Teknisi', 'Maintenance']),
        ];
    }
}
