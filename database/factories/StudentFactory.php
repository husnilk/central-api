<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->student()->create();
        $user->assignRole(config('central.system_roles')['student']);

        return [
            'id' => $user->id,
            'nim' => $user->username,
            'name' => $this->faker->name,
            'year' => $this->faker->numerify('201#'),
            'birthday' => $this->faker->date(),
            'birthplace' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
