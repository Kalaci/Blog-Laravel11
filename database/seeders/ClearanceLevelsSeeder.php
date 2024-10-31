<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClearanceLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['name' => 'User', 'level' => 1],
            ['name' => 'Moderator', 'level' => 5],
            ['name' => 'Admin', 'level' =>10],
        ];

        DB::table('clearance_levels')->insert($levels);
    }
}
