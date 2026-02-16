<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'main_logo' => 'king-viking-logo.jpg',
            'fevicon_logo' => 'king-viking-logo.jpg',
            'contact_number'=> '94773944180',
            'email_address'=> 'info@kingviking.com',
            'address'=> '600/D, Canada',
            'google_map'=> 'https://www.google.com/maps/embed?pb=!1m19!1m8!1m3!1d39970.61252233662!2d-79.40594099633311!3d43.663568319643446!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x89d4cb90d7c63ba5%3A0x323555502ab4c477!2sToronto%20Ontario%20Canada!3m2!1d43.653226!2d-79.3831843!5e0!3m2!1sen!2slk!4v1739695286635!5m2!1sen!2slk',
            'social_facebook'=> '#',
            'social_twitter'=> '#',
            'social_youtube'=> '#',
            'social_instagram'=> '#',
            'footer_content'=> 'Looking back, music has been my constant. No matter the path, songwriting was always there—healing, solving, and guiding me. Im grateful for music and those who made it possible. Wherever it leads, my story is already a success.'
        ]);
    }
}
