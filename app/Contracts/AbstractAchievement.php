<?php


namespace App\Contracts;

use App\Events\BadgeUnlocked;
use App\Models\Badge;
use App\Models\User;

abstract class AbstractAchievement
{
    abstract public function getType(): string;

    abstract public function createAchievements(string $title): void;

    abstract public function unlockAchievement(User $user): void;

    public static function unlockBadge(User $user): void
    {
        $totalUsersAchievements = $user->achievements->count();
        $allBadges = Badge::all();
        $newBadge = $allBadges->filter(static function($badge) use($totalUsersAchievements) {
            return $badge->{'total'} === $totalUsersAchievements;
        });
        BadgeUnlocked::dispatch($user, $newBadge);
    }
}
