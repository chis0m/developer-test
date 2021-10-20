<?php

namespace Tests\Feature\Achievement;

use App\Events\LessonWatched;
use App\Listeners\LessonWatchedListener;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ListenerTest extends TestCase
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

}
