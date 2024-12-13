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
        $this->call([
            RolesSeeder::class,
            AdminSeeder::class,
            JobsSeeder::class,
            IndustrySeeder::class,
            PartnerSeeder::class,
            MessageSeeder::class,
            TestimonialSeeder::class,
            ServiceCategorySeeder::class,
            PositionSeeder::class,
            MemberSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
