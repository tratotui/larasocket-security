<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $time;

    public function __construct()
    {
        $this->time = microtime();
    }

    public function broadcastOn()
    {
        return ['service'];
    }

    public function broadcastWith()
    {
        return [
            'time' => microtime(),
            'version' => 0.1
        ];
    }

    public function broadcastAs()
    {
        return 'microtime';
    }
}

// service:App\Events\TestEvent
