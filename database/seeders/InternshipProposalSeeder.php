<?php

namespace Database\Seeders;

use App\Models\InternshipProposal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InternshipProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InternshipProposal::factory(3)->create();
    }
}
