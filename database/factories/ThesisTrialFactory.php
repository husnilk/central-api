<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisRubric;
use App\Models\ThesisTrial;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisTrialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisTrial::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_id' => Thesis::factory(),
            'thesis_rubric_id' => ThesisRubric::factory(),
            'registered_at' => $this->faker->dateTimeBetween('-1 years'),
            'trial_at' => $this->faker->dateTimeBetween('-1 years'),
            'start_at' => $this->faker->time(),
            'end_at' => $this->faker->time(),
            'room_id' => Room::factory(),
            'online_url' => $this->faker->url,
            'score' => $this->faker->randomFloat(100),
            'grade' => $this->faker->randomElement(['C+', 'B-', 'B', 'B+', 'A-', 'A']),
            'description' => $this->faker->paragraph(3)
        ];
    }
}
