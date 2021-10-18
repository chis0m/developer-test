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
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'title' => 'intermediate',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'title' => 'advanced',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
            [
                'title' => 'master',
                'created_at'=> now(),
                'updated_at'=> now()
            ]
        ];

        Badge::insert($badges);
    }
}
