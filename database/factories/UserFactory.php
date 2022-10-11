<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->firstName,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'type' => 1,
            'active' => 1,
            'avatar' => null
        ];
    }

    public function student(){
        return $this->state([
            'type' => User::STUDENT,
            'username' => $this->faker->numerify('S#####')
        ]);
    }

    public function lecturer(){
        return $this->state([
            'type' => User::LECTURER,
            'username' => $this->faker->numerify('L####')
        ]);
    }

    public function staff(){
        return $this->state([
            'type' => User::STAFF,
            'username' => $this->faker->numerify('T####')
        ]);
    }
}
