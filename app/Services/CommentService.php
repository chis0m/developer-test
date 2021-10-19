<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Interfaces\AchievementInterface;
use App\Models\Achievement;
use App\Models\User;
use App\Utilities\Enum;

class CommentService implements AchievementInterface
{
    private string $type = Enum::comment;

    public function getType(): string
    {
        return $this->type;
    }

    public function createAchievements(string $title): void
    {
        Achievement::create([
            'type' => $this->getType(),
            'title' => $title
        ]);
    }

    public function unlockAchievement(User $user): void
    {
        $totalUserComments = $user->comments->count();
        $commentAchievements = Achievement::getAchievements($this->type);
        $achievement = $commentAchievements->filter(static function($achievement) use ($totalUserComments){
            return $achievement->{'total'} === $totalUserComments;
        })->first();
        if($achievement) {
            AchievementUnlocked::dispatch($achievement, $user);
        }

    }

    public function unlockBadge(User $user): void
    {
        // TODO: Implement unlockBadge() method.
    }

}
