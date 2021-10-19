<?php


namespace App\Services;

use App\Contracts\AbstractAchievement;
use App\Exceptions\ApplicationException;
use App\Models\User;
use App\Utilities\Enum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;

/**
 * Class AchievementStrategy
 * @package App\Services
 */
class AchievementStrategy
{
    /**
     * @var CommentService|LessonService
     */
    protected $achievement;

    /**
     * AchievementStrategy constructor.
     * @param string $achievementType
     * @throws ApplicationException
     */
    public function __construct(string $achievementType)
    {
       switch ($achievementType) {
           case Enum::LESSON:
               $this->setAchievement(new LessonService());
               break;
           case Enum::COMMENT:
               $this->setAchievement(new CommentService());
               break;
           default:
               throw new ApplicationException(
                   Lang::get('exception.achievement.invalid_type'),
                   Response::HTTP_PRECONDITION_FAILED
               );
       }

    }

    /**
     * @param CommentService|LessonService $achievement
     */
    private function setAchievement($achievement): void
    {
        $this->achievement = $achievement;
    }

    /**
     * @param User $user
     */
    public function unlockAchievement(User $user): void
    {
        $this->achievement->unlockAchievement($user);
    }

    /**
     * @param User $user
     */
    public static function unlockBadge(User $user): void
    {
        AbstractAchievement::unlockBadge($user);
    }
}
