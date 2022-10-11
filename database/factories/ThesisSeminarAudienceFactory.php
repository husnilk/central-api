<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisSeminarAudience;
use App\Models\ThesisSeminar;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThesisSeminarAudienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ThesisSeminarAudience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'thesis_seminar_id' => ThesisSeminar::factory(),
            'student_id' => Student::factory()
        ];
    }
}
