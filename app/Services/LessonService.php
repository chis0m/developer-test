<?php

namespace App\Services;

use App\Contracts\AbstractAchievement;
use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\User;
use App\Utilities\Enum;

class LessonService extends AbstractAchievement
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return Enum::LESSON;
    }

    /**
     * @param string $title
     */
    public function createAchievements(string $title): void
    {
        Achievement::create([
            'type' => $this->getType(),
            'title' => $title
        ]);
    }

    /**
     * @param User $user
     */
    public function unlockAchievement(User $user): void
    {
        $lessonAchievements = Achievement::getAchievements($this->getType());
        $numberOfWatched = $user->watched->count();
        $achievement = $lessonAchievements->filter(static function($achievement) use ($numberOfWatched){
            return $achievement->{'total'} === $numberOfWatched;
        })->first();
        if($achievement) {
            AchievementUnlocked::dispatch($achievement, $user);
        }
    }
}
