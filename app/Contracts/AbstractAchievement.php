<?php

namespace App\Contracts;

use App\Events\BadgeUnlocked;
use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use App\Utilities\Enum;

abstract class AbstractAchievement
{
    abstract public function getType(): string;

    abstract public function createAchievements(string $title, int $size): Achievement;

    abstract public function unlockAchievement(User $user): void;

    public static function unlockBadge(User $user): void
    {
        $usersAchievements = $user->achievements()->get();
        $totalUsersAchievements = $usersAchievements->count();
        $allBadges = Badge::all();
        $newBadge = $allBadges->filter(static function ($badge) use ($totalUsersAchievements) {
            return $badge->{'size'} === $totalUsersAchievements;
        })->first();
        if ($newBadge) {
            BadgeUnlocked::dispatch($newBadge, $user);
        } else {
            $badge = Badge::whereTitle(Enum::BEGINNER)->firstOrFail();
            $user->badges()->syncWithoutDetaching([$badge->id]);
        }
    }
}
