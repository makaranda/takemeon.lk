<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicBeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $music_beats = [
            ['title' => 'Beat - 01', 'audio' => 'peter-pan-beat7.mp3', 'track_image' => 'music-symbol-icon-latest.png','order' => 1,'status' => 1],
            ['title' => 'Beat - 02', 'audio' => 'sugarcane-beat-8.mp3', 'track_image' => 'music-symbol-icon-latest.png','order' => 2,'status' => 1]
        ];

        DB::table('music_beats')->insert($music_beats);
    }
}
