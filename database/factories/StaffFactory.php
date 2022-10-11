<?php

namespace Database\Factories;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->staff()->create();
        $user->assignRole(config('central.system_roles')['staff']);

        return [
            'id' => $user->id,
            'nip' => $user->username,
            'nik' => $this->faker->numerify('#############'),
            'name' => $this->faker->name,
            'birthday' => $this->faker->date(),
            'birthplace' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
