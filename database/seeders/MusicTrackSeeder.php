<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MusicTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $music_tracks = [
            ['title' => 'Do You Know the Reason Master', 'audio' => 'do-you-know-the-reason-master_2_147bpm.mp3', 'track_image' => 'king-viking-banner-audio-poster.jpg','order' => 0,'status' => 1],
            ['title' => 'Hold On (to my side of the story)', 'audio' => '7010-fvr-master_3.mp3', 'track_image' => 'hold-on.jpg','order' => 1,'status' => 1],
            ['title' => 'I Am Fallin', 'audio' => 'i-am-fallin-king-viking-26Oct2024.mp3', 'track_image' => 'i-am-fallin.jpg','order' => 2,'status' => 1],
            ['title' => 'Stay With Me V2 MIX', 'audio' => 'stay-with-me-remix.mp3', 'track_image' => 'stay-with-me-remix.jpg','order' => 3,'status' => 1],
            ['title' => 'Stay WIth Me', 'audio' => 'stay-with-me-sample-mix-128.mp3', 'track_image' => 'stay-with-me.jpg','order' => 4,'status' => 1],
            ['title' => 'Sing to you', 'audio' => 'stay-with-me-sample-mix-128.mp3', 'track_image' => 'stay-with-me.jpg','order' => 5,'status' => 1],
            ['title' => 'The Joker', 'audio' => 'stay-with-me-sample-mix-128.mp3', 'track_image' => 'stay-with-me.jpg','order' => 6,'status' => 1],
            ['title' => 'Do you know the reason', 'audio' => 'stay-with-me-sample-mix-128.mp3', 'track_image' => 'stay-with-me.jpg','order' => 7,'status' => 1]
        ];

        DB::table('music_tracks')->insert($music_tracks);
    }
}
