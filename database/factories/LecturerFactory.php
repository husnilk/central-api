<?php

namespace Database\Factories;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LecturerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecturer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->lecturer()->create();
        $user->assignRole(config('central.system_roles')['lecturer']);

        return [
            'id' => $user->id,
            'nip' => $user->username,
            'nik' => $this->faker->numerify('#############'),
            'name' => $this->faker->name,
            'nidn' => $this->faker->numerify('##########'),
            'birthday' => $this->faker->date(),
            'birthplace' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
