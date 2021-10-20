<?php

namespace Tests\Feature\Achievement;

use App\Contracts\AbstractAchievement;
use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use App\Listeners\AchievementUnlockedListener;
use App\Listeners\LessonWatchedListener;
use App\Models\Achievement;
use App\Models\Badge;
use App\Models\Comment;
use App\Models\Lesson;
use App\Models\User;
use App\Services\Strategy\AchievementStrategy;
use App\Utilities\Enum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

/**
 * Class ListenersTest
 * @package Tests\Feature\Achievement
 */
class ListenersTest extends TestCase
{
    private $user;
    private $lesson;

    public function setUp(): void
    {
        parent::setUp();
        $this->createResource();
    }

    private function createResource(): void
    {
        $this->user = User::factory()->create();
        $this->lesson = Lesson::factory()->create();

    }

    public function testLessonWatchedIsAttachedToUser(): void
    {
        Event::fake();
        $event = new LessonWatched($this->lesson, $this->user);
        $listener = new LessonWatchedListener();
        $listener->handle($event);
        $this->assertDatabaseHas('lesson_user', [
            'user_id' => $this->user->id,
            'lesson_id' => $this->lesson->id,
            'watched' => true
        ]);
    }

    public function testALessonWatchedCanOnlyBeAttachedOnceToAUser(): void
    {
        Event::fake();
        $event1 = new LessonWatched($this->lesson, $this->user);
        $event2 = new LessonWatched($this->lesson, $this->user);
        $listener1 = new LessonWatchedListener();
        $listener2 = new LessonWatchedListener();
        $listener1->handle($event1);
        $listener2->handle($event2);
        $this->assertDatabaseHas('lesson_user', [
            'user_id' => $this->user->id,
            'lesson_id' => $this->lesson->id,
            'watched' => true
        ]);
        $this->assertDatabaseCount('lesson_user', 1);
    }

    /**
     * AchievementUnlockedListener
     */
    public function testAchievementCanBeAttachedToAUser(): void
    {
        Event::fake();
        Comment::factory()->count(1)->create(['user_id' => $this->user->id]);
        $achievement = Achievement::getAchievement('first comment written');
        $event = new AchievementUnlocked($achievement, $this->user);
        $listener = new AchievementUnlockedListener();
        $listener->handle($event);
        $this->assertDatabaseHas('achievement_user', [
            'user_id' => $this->user->id,
            'achievement_id' => $achievement->id
        ]);
    }

    /**
     * AchievementUnlockedListener
     */
    public function testAnAchievementCanOnlyBeAddedOnceForAUser(): void
    {
        Event::fake();
        Comment::factory()->count(1)->create(['user_id' => $this->user->id]);
        $achievement = Achievement::getAchievement('first comment written');
        $event1 = new AchievementUnlocked($achievement, $this->user);
        $event2 = new AchievementUnlocked($achievement, $this->user);
        $listener = new AchievementUnlockedListener();
        $listener->handle($event1);
        $listener->handle($event2);
        $this->assertDatabaseHas('achievement_user', [
            'user_id' => $this->user->id,
            'achievement_id' => $achievement->id
        ]);
    }

}
