<?php

namespace Database\Seeders;

use App\Models\Thesis;
use App\Models\ThesisRubric;
use App\Models\ThesisRubricDetail;
use Illuminate\Database\Seeder;

class ThesisRubricDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ThesisRubric::factory()
            ->hasDetails(3)
            ->create();
    }
}
