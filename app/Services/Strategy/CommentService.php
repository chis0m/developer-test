<?php

namespace App\Services\Strategy;

use App\Contracts\AbstractAchievement;
use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\User;
use App\Utilities\Enum;

/**
 * Class CommentService.
 */
class CommentService extends AbstractAchievement
{
    public function getType(): string
    {
        return Enum::COMMENT;
    }

    public function createAchievements(string $title, int $size): Achievement
    {
        return Achievement::create([
            'type' => $this->getType(),
            'title' => $title,
            'size' => $size,
        ]);
    }

    public function unlockAchievement(User $user): void
    {
        $userComments = $user->comments()->get();
        $totalUserComments = $userComments->count();
        $commentAchievements = Achievement::getAchievements($this->getType());
        $achievement = $commentAchievements->filter(static function ($achievement) use ($totalUserComments) {
            return $achievement->{'size'} === $totalUserComments;
        })->first();
        if ($achievement) {
            AchievementUnlocked::dispatch($achievement, $user);
        }
    }
}
