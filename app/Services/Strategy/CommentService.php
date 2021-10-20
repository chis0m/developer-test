<?php

namespace App\Services\Strategy;

use App\Contracts\AbstractAchievement;
use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\User;
use App\Utilities\Enum;

/**
 * Class CommentService
 * @package App\Services
 */
class CommentService extends AbstractAchievement
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return Enum::COMMENT;
    }

    /**
     * @param string $title
     * @param int $size
     * @return Achievement
     */
    public function createAchievements(string $title, int $size): Achievement
    {
       return Achievement::create([
            'type' => $this->getType(),
            'title' => $title,
           'size' => $size
        ]);
    }

    /**
     * @param User $user
     */
    public function unlockAchievement(User $user): void
    {
        $totalUserComments = $user->comments->count();
        $commentAchievements = Achievement::getAchievements($this->getType());
        $achievement = $commentAchievements->filter(static function ($achievement) use ($totalUserComments) {
            return $achievement->{'size'} === $totalUserComments;
        })->first();
        if ($achievement) {
            AchievementUnlocked::dispatch($achievement, $user);
        }
    }
}
