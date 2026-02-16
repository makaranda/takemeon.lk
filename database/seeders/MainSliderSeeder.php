<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('main_slider')->insert([
            'banner' => 'main-banner-poster-001.jpg',
            'heading' => 'King Viking',
            'sub_heading' => 'King Viking is a musician from Canada. He is known for his unique style of music and his ability to connect with his audience.'
        ]);
    }
}
