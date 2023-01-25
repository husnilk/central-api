<?php

namespace Database\Seeders;

use App\Models\InternshipSeminarAudience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternshipSeminarAudienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InternshipSeminarAudience::factory(3)->create();
    }
}
