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

    public function createAchievements(string $title, int $size): Achievement
    {
        return Achievement::create([
            'type' => $this->getType(),
            'title' => $title,
            'size' => $size
        ]);
    }

    public function unlockAchievement(User $user): void
    {
        $lessonAchievements = Achievement::getAchievements($this->getType());
        $numberOfWatchedLessons = $user->watched->count();
        $achievement = $lessonAchievements->filter(static function ($achievement) use ($numberOfWatchedLessons) {
            return $achievement->{'size'} === $numberOfWatchedLessons;
        })->first();
        if ($achievement) {
            AchievementUnlocked::dispatch($achievement, $user);
        }
    }
}
