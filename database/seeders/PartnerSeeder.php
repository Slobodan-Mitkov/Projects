<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Partner::create([
            'company_name' => 'ABC Corporation',
            'industry_id' => 1,
            'logo' => 'https://example.com/logo1.png',
            'collaboration_description' => 'We have partnered with ABC Corporation to provide innovative solutions for the technology industry.',
        ]);

        Partner::create([
            'company_name' => 'DEF Inc.',
            'industry_id' => 2,
            'logo' => 'https://example.com/logo2.png',
            'collaboration_description' => 'We have partnered with DEF Inc. to provide financial services for the finance industry.',
        ]);

        Partner::create([
            'company_name' => 'GHI Ltd.',
            'industry_id' => 3,
            'logo' => 'https://example.com/logo3.png',
            'collaboration_description' => 'We have partnered with GHI Ltd. to provide healthcare services for the healthcare industry.',
        ]);
    }
}
