<?php

namespace Database\Factories;

use App\Models\InternshipCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InternshipProposal>
 */
class InternshipProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_id' => InternshipCompany::factory(),
            'title' => $this->faker->title,
            'background' => $this->faker->text,
            'purpose' => $this->faker->text,
            'planning' => $this->faker->text,
            'start_at' => $this->faker->date,
            'end_at' => $this->faker->date,
            'status' => $this->faker->randomElement([0, 1]),
            'note' => $this->faker->text,
            'active' => $this->faker->randomElement([0, 2]),
            'response_letter' => $this->faker->filePath(),
        ];
    }
}
