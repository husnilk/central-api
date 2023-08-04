<?php

namespace Database\Seeders;

use App\Models\InternshipCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternshipCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InternshipCompany::factory(3)->create();
    }
}
