<?php

namespace Tests\Feature\Achievement;

use App\Contracts\AbstractAchievement;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Listeners\AchievementUnlockedListener;
use App\Listeners\BadgeUnlockedListener;
use App\Listeners\CommentWrittenListener;
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

class EventsTest extends TestCase
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

    public function testCommentWrittenListenerIsAttachedToCommentWrittenEvent(): void
    {
        Event::fake();

        Event::assertListening(CommentWritten::class, CommentWrittenListener::class);
    }

    public function testLessonWatchedListenerIsAttachedToLessonWatchedEvent(): void
    {
        Event::fake();

        Event::assertListening(LessonWatched::class, LessonWatchedListener::class);
    }

    public function testAchievementUnlockedListenerIsAttachedToAchievementUnlockedEvent(): void
    {
        Event::fake();

        Event::assertListening(AchievementUnlocked::class, AchievementUnlockedListener::class);
    }

    public function testBadgeUnlockedListenerIsAttachedToBadgeUnlockedEvent(): void
    {
        Event::fake();

        Event::assertListening(BadgeUnlocked::class, BadgeUnlockedListener::class);
    }

    public function testLessonAchievementUnlockedIsOnlyDispatchedWhenAnAchievementIsReached(): void
    {
        Event::fake();
        $lessons = Lesson::factory()->count(5)->create();
        $ids = $lessons->pluck('id')->toArray();
        $this->user->lessons()->syncWithoutDetaching([$ids[0] => ['watched' => true]]);
        $this->user->lessons()->syncWithoutDetaching([$ids[1] => ['watched' => true]]);
        $this->user->lessons()->syncWithoutDetaching([$ids[2] => ['watched' => true]]);
        $this->user->lessons()->syncWithoutDetaching([$ids[3] => ['watched' => true]]);
        $this->user->lessons()->syncWithoutDetaching([$ids[4] => ['watched' => true]]);

        $strategy = new AchievementStrategy(Enum::LESSON);
        $strategy->unlockAchievement($this->user);

        Event::assertDispatched(AchievementUnlocked::class);
    }

    public function testLessonAchievementUnlockedIsNotDispatchedWhenAnAchievementIsShort(): void
    {
        Event::fake();
        $lessons = Lesson::factory()->count(5)->create();
        $ids = $lessons->pluck('id')->toArray();
        $this->user->lessons()->syncWithoutDetaching([$ids[0] => ['watched' => true]]);
        $this->user->lessons()->syncWithoutDetaching([$ids[1] => ['watched' => true]]);

        $strategy = new AchievementStrategy(Enum::LESSON);
        $strategy->unlockAchievement($this->user);
        Event::assertNotDispatched(AchievementUnlocked::class);
    }

    public function testCommentAchievementUnlockedIsOnlyDispatchedWhenAnAchievementIsReached(): void
    {
        Event::fake();
        Comment::factory()->count(3)->create(['user_id' => $this->user->id]);
        $strategy = new AchievementStrategy(Enum::COMMENT);
        $strategy->unlockAchievement($this->user);
        Event::assertDispatched(AchievementUnlocked::class);
    }

    public function testCommentAchievementUnlockedIsNotDispatchedWhenAnAchievementIsShort(): void
    {
        Event::fake();
        Comment::factory()->count(7)->create(['user_id' => $this->user->id]);
        $strategy = new AchievementStrategy(Enum::COMMENT);
        $strategy->unlockAchievement($this->user);
        Event::assertNotDispatched(AchievementUnlocked::class);
    }

    public function testBeginnerBadgeIsCreatedOnNoAchievement(): void
    {
        AbstractAchievement::unlockBadge($this->user);
        $badge = Badge::getBadge(Enum::BEGINNER);
        $this->assertDatabaseHas('badge_user', [
            'user_id' => $this->user->id,
            'badge_id' => $badge->id
        ]);

    }

    public function firstAchievement(): void
    {
        Comment::factory()->count(1)->create(['user_id' => $this->user->id]);
        $achievement = Achievement::getAchievement('first comment written');
        $event = new AchievementUnlocked($achievement, $this->user);
        $listener = new AchievementUnlockedListener();
        $listener->handle($event);
    }

    public function secondAchievement(): void
    {
        Comment::factory()->count(2)->create(['user_id' => $this->user->id]);
        $achievement = Achievement::getAchievement('3 comments written');
        $event = new AchievementUnlocked($achievement, $this->user);
        $listener = new AchievementUnlockedListener();
        $listener->handle($event);
    }

    public function thirdAchievement(): void
    {
        Comment::factory()->count(2)->create(['user_id' => $this->user->id]);
        $achievement = Achievement::getAchievement('5 comments written');
        $event = new AchievementUnlocked($achievement, $this->user);
        $listener = new AchievementUnlockedListener();
        $listener->handle($event);
    }

    public function fourthAchievement(): void
    {
        Comment::factory()->count(5)->create(['user_id' => $this->user->id]);
        $achievement = Achievement::getAchievement('10 comments written');
        $event = new AchievementUnlocked($achievement, $this->user);
        $listener = new AchievementUnlockedListener();
        $listener->handle($event);
    }

    public function testBadgeUnlockedIsDispatchedWhenCriteriaIsMet(): void
    {
        Event::fake();
        $this->firstAchievement();
        $this->secondAchievement();
        $this->thirdAchievement();
        $this->fourthAchievement();
        AchievementStrategy::unlockBadge($this->user);
        Event::assertDispatched(BadgeUnlocked::class);
    }

    public function testBadgeUnlockedIsNotDispatchedWhenCriteriaFails(): void
    {
        Event::fake();
        $this->firstAchievement();
        $this->secondAchievement();
        $this->thirdAchievement();
        AchievementStrategy::unlockBadge($this->user);
        Event::assertNotDispatched(BadgeUnlocked::class);
    }

    public function testABadgeCanBeAttachedToAUser(): void
    {
        $this->firstAchievement();
        $this->secondAchievement();
        $this->thirdAchievement();
        $this->fourthAchievement();

        $badge = Badge::getBadge(Enum::INTERMEDIATE);
        $event = new BadgeUnlocked($badge, $this->user);
        $listener = new BadgeUnlockedListener();
        $listener->handle($event);
        $this->assertDatabaseHas('badge_user', [
            'user_id' => $this->user->id,
            'badge_id' => $badge->id
        ]);
    }

    public function testABadgeCanOnlyBeAttachedOnceForAUser(): void
    {
        $badge = Badge::getBadge(Enum::INTERMEDIATE);
        $event1 = new BadgeUnlocked($badge, $this->user);
        $event2 = new BadgeUnlocked($badge, $this->user);
        $listener = new BadgeUnlockedListener();
        $listener->handle($event1);
        $listener->handle($event2);
        dump($this->user->badges->toArray());
        $this->assertDatabaseCount('badge_user', 1);
    }

}
