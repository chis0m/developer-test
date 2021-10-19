<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Services\AchievementStrategy;
use App\Services\LessonService;
use App\Utilities\Enum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LessonWatchedListener
{
    /**
     * Handle the event.
     *
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event): void
    {
        $event->user->lessons()->attach($event->lesson, ['watched' => true]);
        $achievement = new AchievementStrategy(Enum::LESSON);
        $achievement->unlockAchievement($event->user);
    }
}
