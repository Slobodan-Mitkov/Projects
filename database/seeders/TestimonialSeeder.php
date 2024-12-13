<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Testimonial::create([
            'testimonial_text' => 'We have been working with this company for several years and have always been impressed with their professionalism and expertise.',
            'client_name' => 'John Doe',
            'client_position' => 'CEO',
            'client_company' => 'ABC Corporation',
            'client_profile_picture' => 'https://example.com/profile-picture1.jpg',
        ]);

        Testimonial::create([
            'testimonial_text' => 'I have worked with this company on several projects and have always been satisfied with the results.',
            'client_name' => 'Jane Smith',
            'client_position' => 'Marketing Manager',
            'client_company' => 'DEF Inc.',
            'client_profile_picture' => 'https://example.com/profile-picture2.jpg',
        ]);

        Testimonial::create([
            'testimonial_text' => 'This company has provided us with excellent service and support.',
            'client_name' => 'Bob Johnson',
            'client_position' => 'IT Director',
            'client_company' => 'GHI Ltd.',
            'client_profile_picture' => 'https://example.com/profile-picture3.jpg',
        ]);
    }
}
