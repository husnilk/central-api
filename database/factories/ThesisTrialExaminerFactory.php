<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\ThesisTrial;
use App\Models\ThesisTrialExaminer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisTrialExaminerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisTrialExaminer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_trial_id' => ThesisTrial::factory(),
            'examiner_id' => Lecturer::factory(),
            'position' => $this->faker->randomElement([0, 1, 2]),
            'status' => 0,
        ];
    }
}
