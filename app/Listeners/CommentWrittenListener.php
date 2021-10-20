<?php

namespace App\Listeners;

use App\Events\CommentWritten;
use App\Services\Strategy\AchievementStrategy;
use App\Utilities\Enum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CommentWrittenListener
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
     * @param  CommentWritten  $event
     * @return void
     */
    public function handle(CommentWritten $event): void
    {
        $achievement = new AchievementStrategy(Enum::COMMENT);
        $achievement->unlockAchievement($event->comment->user);
    }
}
