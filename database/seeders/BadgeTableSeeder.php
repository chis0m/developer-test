<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Seeder;

class BadgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $badges = [
            [
                'title' => 'beginner',
                'total' => 0,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'title' => 'intermediate',
                'total' => 4,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'title' => 'advanced',
                'total' => 8,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'title' => 'master',
                'total' => 10,
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        ];

        Badge::insert($badges);
    }
}
