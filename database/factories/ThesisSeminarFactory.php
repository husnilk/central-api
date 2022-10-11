<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSeminarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSeminar::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_id' => Thesis::factory(),
            'registered_at' => $this->faker->dateTimeBetween('-1 years'),
            'method' => 1,
            'seminar_at' => $this->faker->dateTimeBetween('-1 years'),
            'room_id' => Room::factory(),
            'online_url' => $this->faker->url,
            'recommendation' => 2,
            'description' => $this->faker->paragraph(3)
        ];
    }
}
