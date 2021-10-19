<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
//                'slug' => Str::slug('first lesson watched'),
                'total' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '5 lessons watched',
//                'slug' => Str::slug('5 lessons watched'),
                'total' => 5,
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '10 lesson watched',
//                'slug' => Str::slug('10 lesson watched'),
                'total' => 10,
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '25 lesson watched',
//                'slug' => Str::slug('25 lesson watched'),
                'total' => 25,
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'lesson',
                'title' => '50 lesson watched',
//                'slug' => Str::slug('50 lesson watched'),
                'total' => 50,
                'created_at'=> now(),
                'updated_at'=> now()
                ],
            [
                'type' => 'comment',
                'title' => 'first comment written',
//                'slug' => Str::slug('first comment written'),
                'total' => 1,
                'created_at'=> now(),
                'updated_at'=> now()
            ],            [
                'type' => 'comment',
                'title' => '3 comments written',
//                'slug' => Str::slug('3 comments written'),
                'total' => 3,
                'created_at'=> now(),
                'updated_at'=> now()
            ],            [
                'type' => 'comment',
                'title' => '5 comments written',
//                'slug' => Str::slug('5 comments written'),
                'total' => 5,
                'created_at'=> now(),
                'updated_at'=> now()
                ],            [
                'type' => 'comment',
                'title' => '10 comments written',
//                'slug' => Str::slug('10 comments written'),
                'total' => 10,
                'created_at'=> now(),
                'updated_at'=> now()
            ],            [
                'type' => 'comment',
                'title' => '20 comments written',
//                'slug' => Str::slug('20 comments written'),
                'total' => 20,
                'created_at'=> now(),
                'updated_at'=> now()
            ],
        ];
        Achievement::insert($achievements);
    }
}
