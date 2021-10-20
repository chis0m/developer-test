<?php

namespace App\Listeners;

use App\Events\LessonWatched;
use App\Services\Strategy\AchievementStrategy;
use App\Utilities\Enum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LessonWatchedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event): void
    {
        $event->user->lessons()->syncWithoutDetaching([$event->lesson->id => ['watched' => true]]);
        $achievement = new AchievementStrategy(Enum::LESSON);
        $achievement->unlockAchievement($event->user);
    }
}
