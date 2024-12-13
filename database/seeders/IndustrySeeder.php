<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Industry;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Industry::create([
            'name' => 'Technology',
            'description' => 'The technology industry includes companies that develop and manufacture electronic devices, software, and other technology-related products.',
            'icon' => 'https://example.com/technology-icon.png',
        ]);

        Industry::create([
            'name' => 'Finance',
            'description' => 'The finance industry includes companies that provide financial services, such as banking, investments, and insurance.',
            'icon' => 'https://example.com/finance-icon.png',
        ]);

        Industry::create([
            'name' => 'Healthcare',
            'description' => 'The healthcare industry includes companies that provide medical services, develop pharmaceuticals, and manufacture medical devices.',
            'icon' => 'https://example.com/healthcare-icon.png',
        ]);

        Industry::create([
            'name' => 'Manufacturing',
            'description' => 'The manufacturing industry includes companies that produce goods, such as textiles, machinery, and electronics.',
            'icon' => 'https://example.com/manufacturing-icon.png',
        ]);

        Industry::create([
            'name' => 'Energy',
            'description' => 'The energy industry includes companies that produce and distribute energy, such as oil, gas, and renewable energy.',
            'icon' => 'https://example.com/energy-icon.png',
        ]);
    }
}
