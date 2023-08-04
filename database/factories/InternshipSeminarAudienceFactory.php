<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InternshipSeminarAudience>
 */
class InternshipSeminarAudienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'internship_id' => Internship::factory(),
            'student_id' => Student::factory(),
            'attended' => 1,
            'role' => null,
            'description' => null
        ];
    }
}
