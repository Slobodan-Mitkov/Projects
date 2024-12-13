<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Position::create(['name' => 'CEO']);
        Position::create(['name' => 'CTO']);
        Position::create(['name' => 'CMO']);
        Position::create(['name' => 'Manager']);
        Position::create(['name' => 'Team Lead']);
        Position::create(['name' => 'Software Engineer']);
        Position::create(['name' => 'Data Scientist']);
        Position::create(['name' => 'Marketing Manager']);
        Position::create(['name' => 'Sales Representative']);
        Position::create(['name' => 'Customer Support Specialist']);
    }
}
