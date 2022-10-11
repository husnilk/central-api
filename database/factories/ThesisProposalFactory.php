<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Thesis;
use App\Models\ThesisProposal;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisProposalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisProposal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_id' => Thesis::factory(),
            'datetime' => $this->faker->dateTimeBetween(),
            'room_id' => Room::factory(),
        ];
    }
}
