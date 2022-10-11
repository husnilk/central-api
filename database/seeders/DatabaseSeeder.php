<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        // \App\Models\User::factory(10)->create();
        $this->call(LecturerSeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ThesisSeeder::class);
        $this->call(ThesisRubricDetailSeeder::class);
    }
}
