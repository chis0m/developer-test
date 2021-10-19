<?php

use App\Models\Achievement;
use App\Models\User;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', static function (){
    $coment = \App\Models\Comment::find(1);
    return $coment->user->comments;
    $user = User::find(1);
    $lessonAchievements = Achievement::getAchievements('lesson');
    $numberOfWatched = $user->watched->count();
    $achievement = $lessonAchievements->filter(static function($achievement) use ($numberOfWatched){
        return $achievement->count === $numberOfWatched;
    })->first() ?? 'hello';
    return $achievement;
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
