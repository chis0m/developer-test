<?php

namespace App\Services;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use App\Utilities\Enum;
use Illuminate\Support\Collection;

/**
 * Class AchievementService
 * @package App\Services
 */
class AchievementService
{
    /**
     * @param User $user
     * @return Collection
     */
    public static function getUnlockedAchievements(User $user): Collection
    {
        return $user->achievements->map(static function ($achievement) {
            return $achievement->title;
        });
    }

    /**
     * @param User $user
     * @return Collection
     */
    public static function getNextAvailableAchievements(User $user): Collection
    {
        $groups = Achievement::orderBy('size')->get()->groupBy('type');
        $ula = $user->lessonAchievements()->get();
        $uca = $user->commentAchievements()->get();
        return $groups->map(static function ($achievements, $key) use ($ula, $uca) {
            return $achievements->map(static function ($achievement) use ($key, $ula, $uca) {
                if (($key === Enum::LESSON) && !in_array($achievement->title, $ula->pluck('title')->toArray(), true)) {
                    return $achievement->title;
                }
                if (($key === Enum::COMMENT) && !in_array($achievement->title, $uca->pluck('title')->toArray(), true)) {
                    return $achievement->title;
                }
            })->filter(static function ($title) {
                return !is_null($title);
            });
        });
    }

    /**
     * @param User $user
     * @return null|Badge
     */
    public static function currentBadge(User $user): ?Badge
    {
        return  $user->badgesBySize->last();
    }

    /**
     * @param User $user
     * @return string
     */
    public static function getCurrentBadge(User $user): string
    {
        return self::currentBadge($user)->title ?? '';
    }


    /**
     * @param User $user
     * @return null|Badge
     */
    public static function nextBadge(User $user): ?Badge
    {
        $badges = Badge::orderBy(Enum::SIZE)->get();
        $userBadges = $user->badgesBySize;
        return $badges->filter(static function ($badge) use ($userBadges) {
            if (!in_array($badge->title, $userBadges->pluck('title')->toArray(), true)) {
                return $badge;
            }
        })->first();
    }

    /**
     * @param User $user
     * @return string
     */
    public static function getNextBadge(User $user): string
    {
        return self::nextBadge($user)->title ?? '';
    }

    /**
     * @param User $user
     * @return int
     */
    public static function getRemainingToUnlockNextBadge(User $user): int
    {
        return (self::nextBadge($user)->size ?? 0) - (self::currentBadge($user)->size ?? 0);
    }
}
