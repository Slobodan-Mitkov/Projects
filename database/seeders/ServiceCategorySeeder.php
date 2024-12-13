<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ServiceCategory::create([
            'name' => 'Web Development',
        ]);

        ServiceCategory::create([
            'name' => 'Mobile App Development',
        ]);

        ServiceCategory::create([
            'name' => 'E-commerce Solutions',
        ]);

        ServiceCategory::create([
            'name' => 'Digital Marketing',
        ]);

        ServiceCategory::create([
            'name' => 'IT Consulting',
        ]);
    }
}
