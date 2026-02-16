<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Raveen',
            'email' => 'donraveen@gmail.com ',
            'username' => 'raveen',
            'password' => Hash::make('KingViking2020'), // Corrected hashing method
            'role' => 'admin'
        ]);
    }
}
