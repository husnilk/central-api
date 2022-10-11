<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSupervisorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSupervisor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $thesis = Thesis::factory()->create();
        return [
            'thesis_id' => $thesis->id,
            'lecturer_id' => Lecturer::factory(),
            'position' => $this->faker->randomDigit([1, 2, 3]),
            'status' => 1,
            'created_by' => $thesis->student_id
        ];
    }
}
