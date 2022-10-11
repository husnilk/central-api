<?php

namespace Database\Seeders;

use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;
use Illuminate\Database\Seeder;

class ThesisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thesis::factory()
            ->hasLogbooks()
            ->create();

        Thesis::factory()
            ->hasProposals()
            ->create();

        ThesisSeminar::factory()
            ->hasReviewers(2)
            ->hasAudiences(10)
            ->create();

        ThesisTrial::factory()
            ->hasExaminers(2)
            ->create();
    }
}
