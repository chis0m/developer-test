<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Interfaces\AchievementInterface;
use App\Models\Achievement;
use App\Models\Lesson;
use App\Models\User;
use App\Utilities\Enum;

class LessonService implements AchievementInterface
{
    private string $type = Enum::LESSON;

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
        $lessonAchievements = Achievement::getAchievements($this->type);
        $numberOfWatched = $user->watched->count();
        $achievement = $lessonAchievements->filter(static function($achievement) use ($numberOfWatched){
            return $achievement->{'total'} === $numberOfWatched;
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
