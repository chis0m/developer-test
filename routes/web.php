<?php

use App\Http\Controllers\CommentAchievementController;
use App\Http\Controllers\LessonAchievementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;


Route::get('/', static function () {
    return [
      'message' => 'Welcome to a high Achievement!',
    ];
});
Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
Route::post('achievements/lesson', [LessonAchievementController::class, 'store']);
Route::post('achievements/comment', [CommentAchievementController::class, 'store']);
