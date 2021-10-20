<?php

namespace App\Services\Strategy;

use App\Contracts\AbstractAchievement;
use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\User;
use App\Utilities\Enum;

class LessonService extends AbstractAchievement
{
    public function getType(): string
    {
        return Enum::LESSON;
    }

    public function createAchievements(string $title): void
    {
        Achievement::create([
            'type' => $this->getType(),
            'title' => $title,
        ]);
    }

    public function unlockAchievement(User $user): void
    {
        $lessonAchievements = Achievement::getAchievements($this->getType());
        $numberOfWatched = $user->watched->count();
        $achievement = $lessonAchievements->filter(static function ($achievement) use ($numberOfWatched) {
            return $achievement->{'size'} === $numberOfWatched;
        })->first();
        if ($achievement) {
            AchievementUnlocked::dispatch($achievement, $user);
        }
    }
}
