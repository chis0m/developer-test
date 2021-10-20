<?php

namespace Database\Seeders;

use App\Models\Badge;
use App\Utilities\Enum;
use Illuminate\Database\Seeder;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'title' => Enum::BEGINNER,
                'size' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Enum::INTERMEDIATE,
                'size' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Enum::ADVANCED,
                'size' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => Enum::MASTER,
                'size' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Badge::insert($badges);
    }
}
