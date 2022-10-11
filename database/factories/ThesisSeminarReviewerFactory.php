<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarReviewer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSeminarReviewerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSeminarReviewer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_seminar_id' => ThesisSeminar::factory(),
            'reviewer_id' => Lecturer::factory(),
            'status' => 1,
        ];
    }
}
