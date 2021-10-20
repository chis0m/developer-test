<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAchievementRequest;
use App\Services\Strategy\AchievementStrategy;
use App\Traits\TResponder;
use App\Utilities\Enum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class LessonAchievementController
 * @package App\Http\Controllers
 */
class LessonAchievementController extends Controller
{

    use TResponder;

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateAchievementRequest $request
     * @return JsonResponse
     */
    public function store(CreateAchievementRequest $request): JsonResponse
    {
        $lesson = new AchievementStrategy(Enum::LESSON);
        $achievement = $lesson->createAchievement($request['title'], $request['size']);
        return $this->success($achievement, 'Successful', Response::HTTP_CREATED);
    }
}
