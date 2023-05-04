<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Report::factory(10)->create();
        // \App\Models\Company::factory(10)->create();
        \App\Models\Agent::factory(10)->create();
    }
}
