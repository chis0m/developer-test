<?php

namespace App\Events;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BadgeUnlocked
 * @package App\Events
 */
class BadgeUnlocked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public string $badge;

    /**
     * @var User
     */
    public User $user;

    /**
     * Create a new event instance.
     *
     * @param Badge $badge
     * @param User $user
     */
    public function __construct(Badge $badge, User $user)
    {
        $this->badge = $badge;
        $this->user = $user;
    }
}
