<?php

namespace Database\Seeders;

use App\Models\Internship;
use App\Models\InternshipLogbook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternshipLogbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Internship::factory()->hasLogbooks(10)->create();
    }
}
