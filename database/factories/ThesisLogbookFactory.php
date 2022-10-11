<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use App\Models\ThesisSupervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisLogbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisLogbook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_id' => Thesis::factory(),
            'supervisor_id' => ThesisSupervisor::factory(),
            'date' => $this->faker->dateTimeBetween('-10 years'),
            'progress' => $this->faker->paragraph,
            'notes' => $this->faker->paragraph,
        ];
    }
}
