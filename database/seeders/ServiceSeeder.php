<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Service::create([
            'name' => 'Web Development',
            'description' => 'We develop custom web applications using the latest technologies.',
            'service_category_id' => 1,
            'industry_id' => 1,
        ]);

        Service::create([
            'name' => 'Mobile App Development',
            'description' => 'We develop custom mobile applications for iOS and Android.',
            'service_category_id' => 1,
            'industry_id' => 1,
        ]);

        Service::create([
            'name' => 'E-commerce Solutions',
            'description' => 'We develop custom e-commerce solutions using Shopify and WooCommerce.',
            'service_category_id' => 2,
            'industry_id' => 2,
        ]);

        Service::create([
            'name' => 'Digital Marketing',
            'description' => 'We provide digital marketing services including SEO, PPC, and social media marketing.',
            'service_category_id' => 3,
            'industry_id' => 3,
        ]);

        Service::create([
            'name' => 'IT Consulting',
            'description' => 'We provide IT consulting services including network setup and cybersecurity.',
            'service_category_id' => 4,
            'industry_id' => 4,
        ]);
    }
}
