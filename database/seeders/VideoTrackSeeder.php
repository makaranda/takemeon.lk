<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideoTrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $video_tracks = [
            ['title' => 'The  Joker','sub_title' => 'First Albem', 'video' => 'do-you-know-the-reason.mp4', 'video_image' => 'the-joker-video-thumbnail.jpg','order' => 1,'status' => 1],
            ['title' => 'Do you Know the Reason','sub_title' => 'First Albem', 'video' => 'do-you-know-the-reason.mp4', 'video_image' => 'do-you-know-the-reason-video-thumbnail.jpg','order' => 2,'status' => 1],
            ['title' => 'Stay with me','sub_title' => 'First Albem', 'video' => 'do-you-know-the-reason.mp4', 'video_image' => 'stay-with-me-video-thumbnail.jpg','order' => 3,'status' => 1]
        ];

        DB::table('video_tracks')->insert($video_tracks);
    }
}
