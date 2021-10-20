<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        $users = User::factory()->count(3)->create();
        $users->each(static function ($user){
            $user->lessons()->attach(random_int(1, 20), ['watched' => true]);
            $user->lessons()->attach(random_int(1, 20), ['watched' => true]);
        });
        Comment::factory()->count(3)->create(['user_id' => 1]);
        Comment::factory()->count(3)->create(['user_id' => 2]);
        $users->first()->achievements()->syncWithoutDetaching([1,2,3,6,7]);
        $users->first()->badges()->syncWithoutDetaching([1,2,3]);
    }
}
