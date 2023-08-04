<?php

namespace Database\Factories;

use App\Models\Internship;
use App\Models\InternshipLogbook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InternshipLogbook>
 */
class InternshipLogbookFactory extends Factory
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
            'date' => $this->faker->date(),
            'activities' => $this->faker->sentence,
            'note' => $this->faker->sentence,
            'status' => $this->faker->randomElement([0, 1])
        ];
    }
}
