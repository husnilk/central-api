<?php

namespace Database\Factories;

use App\Models\ThesisTrialExaminerScore;
use App\Models\ThesisRubricDetail;
use App\Models\ThesisTrialExaminer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisTrialExaminerScoreFactory extends Factory
{
    protected $model = ThesisTrialExaminerScore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_trial_examiner_id' => ThesisTrialExaminer::factory(),
            'thesis_rubric_detail_id' => ThesisRubricDetail::factory(),
            'score' => $this->faker->randomFloat(100),
            'notes' => $this->faker->paragraph
        ];
    }
}
