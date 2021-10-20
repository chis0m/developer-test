<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\AchievementService;
use App\Traits\TResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    use TResponder;

    public function index(User $user): JsonResponse
    {
        $achievements = [
            'unlocked_achievements' => AchievementService::getUnlockedAchievements($user),
            'next_available_achievements' => AchievementService::getNextAvailableAchievements($user),
            'current_badge' => AchievementService::getCurrentBadge($user),
            'next_badge' => AchievementService::getNextBadge($user),
            'remaining_to_unlock_next_badge' => AchievementService::getRemainingToUnlockNextBadge($user)
        ];
        return $this->success($achievements);
    }

}
