<?php

namespace App\Contracts;

use App\Events\BadgeUnlocked;
use App\Models\Badge;
use App\Models\User;
use App\Utilities\Enum;

abstract class AbstractAchievement
{
    abstract public function getType(): string;

    abstract public function createAchievements(string $title): void;

    abstract public function unlockAchievement(User $user): void;

    public static function unlockBadge(User $user): void
    {
        $totalUsersAchievements = $user->achievements->count();
        $allBadges = Badge::all();

        $newBadge = $allBadges->filter(static function ($badge) use ($totalUsersAchievements) {
            return $badge->{'size'} === $totalUsersAchievements;
        })->first();

        if ($newBadge) {
            BadgeUnlocked::dispatch($user, $newBadge);
        } else {
            $badge = Badge::whereTitle(Enum::BEGINNER)->firstOrFail();
            $user->badges()->syncWithoutDetaching([$badge->id]);
        }
    }
}