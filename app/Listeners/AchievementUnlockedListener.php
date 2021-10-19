<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Services\AchievementStrategy;
use App\Utilities\Enum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AchievementUnlockedListener
{
    /**
     * Handle the event.
     *
     * @param  AchievementUnlocked  $event
     * @return void
     */
    public function handle(AchievementUnlocked $event): void
    {
        $event->user->achievements()->attach($event->achievement);
        AchievementStrategy::unlockBadge($event->user);
    }
}
