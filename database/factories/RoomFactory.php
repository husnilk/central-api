<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'building_id' => Building::factory(),
            'name' => $this->faker->bothify('?#.#'),
            'number' => $this->faker->randomNumber(2),
            'floor' => $this->faker->randomElement([1, 2, 3]),
            'capacity' => $this->faker->numberBetween(25, 80),
            'size' => $this->faker->numberBetween(40, 100),
            'location' => null,
            'status' => $this->faker->numberBetween(1, 0)
        ];
    }
}
