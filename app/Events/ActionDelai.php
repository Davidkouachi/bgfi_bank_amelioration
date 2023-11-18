<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Action;

class ActionDelai implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $action;

    public function __construct($action)
    {
        $this->action = $action;
    }

    public function broadcastOn()
    {
        return new Channel('my-channel-action');
    }

    public function broadcastAs()
    {
        return 'my-event-action';
    }
}
