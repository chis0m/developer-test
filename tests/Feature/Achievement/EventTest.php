<?php

namespace Tests\Feature\Achievement;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Events\CommentWritten;
use App\Events\LessonWatched;
use App\Listeners\AchievementUnlockedListener;
use App\Listeners\BadgeUnlockedListener;
use App\Listeners\CommentWrittenListener;
use App\Listeners\LessonWatchedListener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
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
}
