<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Services\AchievementStrategy;
use App\Utilities\Enum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentWrittenListener
{
    /**
     * Handle the event.
     *
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event): void
    {
        $achievement = new AchievementStrategy(Enum::comment);
        $achievement->unlockAchievement($event->comment->user);

    }
}
