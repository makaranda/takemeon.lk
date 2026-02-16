<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_info')->insert([
            'intro' => 'In another lifetime, Things could have turned any number of ways. I could have been a bee keeper, an elephant handler (yes, for real), and even climbing a coconut tree for a daily wage - its a real “thing" where I come from. But those possibilities were taken out of the equation very early in life. Luck for me (I think)!',
            'description' => 'I look back and music has been the only constant. Regardless of what I did, the love for song writing was there waiting to color any lane I picked. It heals, finds solutions to complex problems and brings it home. So I keep writing music. But I cant help think about those other possibilities that could have narrated this life. I am greatful to music. I am always greatful for those that made it possible for me. Doesnt matter where it goes from here, because of you, I consider mine to be a successful story.',
            'image' => 'king-viking-about-poster.jpg'
        ]);
    }
}
