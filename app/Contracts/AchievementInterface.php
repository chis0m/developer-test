<?php

namespace App\Contracts;

use App\Models\User;

/**
 * Interface AchievementInterface
 * @package App\Interfaces
 */
interface AchievementInterface
{
    public function getType(): string;

    public function createAchievements(string $title): void;

    public function unlockAchievement(User $user): void;

    public function unlockBadge(User $user): void;
}
