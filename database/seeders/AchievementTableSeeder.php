<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $achievements = [
            [
                'type' => 'lesson',
                'title' => 'first lesson watched',
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '5 lessons watched',
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '10 lesson watched',
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '25 lesson watched',
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '50 lesson watched',
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'comment',
                'title' => 'first comment written',
                'created_at'=> now(),
                'updated_at'=> now()
            ],            [
                'type' => 'comment',
                'title' => '3 comments written',
                'created_at'=> now(),
                'updated_at'=> now()
            ],            [
                'type' => 'comment',
                'title' => '5 comments written',
                'created_at'=> now(),
                'updated_at'=> now()
                ],            [
                'type' => 'comment',
                'title' => '10 comments written',
                'created_at'=> now(),
                'updated_at'=> now()
            ],            [
                'type' => 'comment',
                'title' => '20 comments written',
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ];
        Achievement::insert($achievements);
    }
}
