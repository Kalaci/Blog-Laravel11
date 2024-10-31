<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Moderator', 
            'email' => 'test@testing.com',
            'password' => Hash::make('password'), 
            'clearance_level_id' => 2, 
        ]);

        // Create an admin
        User::create([
            'name' => 'Admin', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), 
            'clearance_level_id' => 3, 
        ]);
    }
}
