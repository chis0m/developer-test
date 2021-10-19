<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use App\Models\Badge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BadgeUnlockedListener
{
    /**
     * Handle the event.
     *
     * @param  BadgeUnlocked  $event
     * @return void
     */
    public function handle(BadgeUnlocked $event): void
    {
        $badge = $event->badge;
        $user = $event->user;
        if(!$badge) {
            $badge = Badge::whereTitle(Badge::BEGINNER)->firstOrFail();
            $user->badges()->syncWithoutDetaching([$badge->id]);
        } else {
            $event->user->badges()->syncWithoutDetaching([$badge->id]);
        }
    }
}
