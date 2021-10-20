<?php

namespace Tests\Feature\Achievement;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AchievementTest extends TestCase
{
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();
    }

    private function createUser(): void
    {
        $this->user = User::factory()->create();
    }

    public function testLessonAchievementCanBeCreate(): void
    {
        $response = $this->post('/achievements/lesson', ['title' => '4 lessons watch', 'size' => 4]);

        $response->assertStatus(201);
    }

    public function testCommentAchievementCanBeCreated(): void
    {
        $response = $this->post('/achievements/lesson', ['title' => '3 comments written', 'size' => 3]);

        $response->assertStatus(201);
    }

    public function testAchievementCreationInputsAreValidated(): void
    {
        $response = $this->post('/achievements/lesson', [], ['Accept' => 'Application/json']);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'title' => [
                    'The title field is required.'
                ],
                'size' => [
                    'The size field is required.'
                ]
            ]
        ]);
    }

}
